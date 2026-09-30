<?php

namespace App\Http\Controllers\Api\Bill;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\BillTour;
use App\models\product\Product;
use App\models\Services;

class BillTourController extends Controller
{
    public function list(Request $request)
    {
        $query = BillTour::query()->orderBy('id', 'DESC');
        if ($request->filled('keyword')) {
            $keyword = trim((string) $request->keyword);
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'LIKE', "%{$keyword}%")
                    ->orWhere('phone', 'LIKE', "%{$keyword}%")
                    ->orWhere('email', 'LIKE', "%{$keyword}%")
                    ->orWhere('address', 'LIKE', "%{$keyword}%")
                    ->orWhere('nationality', 'LIKE', "%{$keyword}%")
                    ->orWhere('hotel_category', 'LIKE', "%{$keyword}%")
                    ->orWhere('note', 'LIKE', "%{$keyword}%")
                    ->orWhere('request_type', 'LIKE', "%{$keyword}%");
            });
        }
        $perPage = (int) ($request->get('per_page', 20));
        $data = $query->paginate($perPage);
        return response()->json([
            'data' => $data,
            'message' => 'success'
        ]);
    }

    public function detail($id)
    {
        $bill = BillTour::findOrFail($id);
        $tour = null;
        if (!empty($bill->tour_id)) {
            $tour = Product::where('id', $bill->tour_id)->first(['id', 'name', 'slug', 'images', 'price', 'discount']);
        }
        $services = [];
        if (!empty($bill->service_id)) {
            $serviceIds = $bill->service_id;
            if (is_string($serviceIds)) {
                $decoded = json_decode($serviceIds, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $serviceIds = $decoded;
                }
            }
            if (!is_array($serviceIds)) {
                $serviceIds = [$serviceIds];
            }
            $services = Services::whereIn('id', $serviceIds)->get(['id', 'name', 'price']);
        }
        return response()->json([
            'data' => [
                'bill' => $bill,
                'tour' => $tour,
                'services' => $services
            ],
            'message' => 'success'
        ]);
    }

    public function delete($id)
    {
        $bill = BillTour::findOrFail($id);
        $bill->delete();
        return response()->json([
            'data' => true,
            'message' => 'success'
        ]);
    }
}

