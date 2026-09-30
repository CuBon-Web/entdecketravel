<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\models\website\AlbumAffter;

class AlbumAffterController extends Controller
{
    public function createOrUpdateAlbumAffter(Request $request)
    {
        if ($request->data) {
            AlbumAffter::truncate();
            foreach ($request->data as $value) {
                $images = [];
                if (isset($value['images']) && is_array($value['images'])) {
                    $images = array_values(array_filter($value['images'], function ($p) {
                        return $p !== null && $p !== '';
                    }));
                }
                if (count($images) === 0 && ! empty($value['image'])) {
                    $images = [$value['image']];
                }

                $row = new AlbumAffter();
                $row->name = $value['name'] ?? '';
                $row->link = $value['link'] ?? '';
                $row->status = $value['status'] ?? 0;
                $row->images = $images;
                $row->image = $images[0] ?? '';
                $row->save();
            }
        }

        return response()->json([
            'messenge' => 'success',
        ], 200);
    }
    public function listAlbumAfftero()
    {
    	$data = AlbumAffter::get();
    	return response()->json([
            'messenge' => 'success',
            'data' => $data
        ],200);
	}
}
