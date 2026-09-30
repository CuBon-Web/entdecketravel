<?php

namespace App\Http\Controllers\Api\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\blog\Blog;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function create(Request $request, Blog $blog)
    {
    	$data = $blog->saveBlog($request);
        return response()->json([
    		'message' => 'Save Success',
    		'data'=> $data
    	],200);
    }
    public function list(Request $request)
    {
    	$keyword = $request->keyword;
        if($keyword == ""){
            $data = Blog::with([
                'cate' => function ($query) {
                    $query->select('id','name','slug'); 
                }, 
                'typeCate' => function ($query) {
                    $query->select('id','name','slug'); 
                }
            ])->orderBy('id','DESC')->get(['id','title','created_at','category','type_cate','type_news','home_status']);
        }else{
            $data = Blog::where('title', 'LIKE', '%'.$keyword.'%')->orderBy('id','DESC')->get()->toArray();
        }
        return response()->json([
            'data' => $data,
            'message' => 'success'
        ]);
    }
    public function delete($id)
    {
        $query = Blog::find($id);
        $file= str_replace('http://localhost:8080','',$query->avatar);
        $filename = public_path().$file;
        if(file_exists( public_path().$file ) ){
            \File::delete($filename);
        }
        $query->delete();
        return response()->json(['message'=>'Delete Success'],200);
    }
    public function edit($id)
    {
        $data = Blog::where([
            'id'=> $id
        ])
        ->first();
        return response()->json([
            'data' => $data,
            'message' => 'success'
        ]);
    }

    public function importCsv(Request $request)
    {
        $request->validate([
            'file' => 'required|file',
        ]);

        $extension = strtolower($request->file('file')->getClientOriginalExtension());
        if (!in_array($extension, ['csv', 'txt'])) {
            return response()->json([
                'message' => 'File không đúng định dạng CSV',
                'errors' => [
                    'file' => ['validation.csv_extension'],
                ],
            ], 422);
        }

        $handle = fopen($request->file('file')->getRealPath(), 'r');
        if ($handle === false) {
            return response()->json([
                'message' => 'Không thể đọc file CSV',
            ], 422);
        }

        $header = fgetcsv($handle);
        if (!$header) {
            fclose($handle);
            return response()->json([
                'message' => 'File CSV không có dữ liệu',
            ], 422);
        }

        $headerMap = $this->normalizeHeaderMap($header);
        $imported = 0;
        $failed = 0;
        $imageDownloaded = 0;
        $imageFailed = 0;

        while (($row = fgetcsv($handle)) !== false) {
            $title = $this->getCsvValue($row, $headerMap, 'title', 1);
            $content = $this->getCsvValue($row, $headerMap, 'content', 2);
            $imageUrl = $this->resolveImageUrl($row, $headerMap);

            if ($title === '' || $content === '') {
                $failed++;
                continue;
            }

            $imagePath = $this->downloadImageFromUrl($imageUrl, $title);
            if ($imagePath !== '') {
                $imageDownloaded++;
            } elseif ($imageUrl !== '') {
                $imageFailed++;
            }
            
            $slug = to_slug($title) ?: Str::random(8);
            $baseSlug = $slug;
            $index = 1;
            while (Blog::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $index;
                $index++;
            }

            $formattedContent = $this->formatContent($content);

            $blog = new Blog();
            $blog->title = json_encode([
                ['lang_code' => 'vi', 'content' => $title],
                ['lang_code' => 'en-US', 'content' => $title],
            ], JSON_UNESCAPED_UNICODE);
            $blog->content = json_encode([
                ['lang_code' => 'vi', 'content' => $formattedContent],
                ['lang_code' => 'en-US', 'content' => $formattedContent],
            ], JSON_UNESCAPED_UNICODE);
            $blog->description = json_encode([
                ['lang_code' => 'vi', 'content' => Str::limit(strip_tags($content), 200, '')],
                ['lang_code' => 'en-US', 'content' => Str::limit(strip_tags($content), 200, '')],
            ], JSON_UNESCAPED_UNICODE);
            $blog->image = $imagePath;
            $blog->category = 'tin-tuc';
            $blog->type_cate = '0';
            $blog->type_news = null;
            $blog->cate_product = 0;
            $blog->status = 1;
            $blog->home_status = 0;
            $blog->slug = $slug;
            $blog->author = optional(auth()->user())->name ?: 'System';
            $blog->save();
            $imported++;
        }

        fclose($handle);

        return response()->json([
            'message' => 'Import thành công',
            'data' => [
                'imported' => $imported,
                'failed' => $failed,
                'image_downloaded' => $imageDownloaded,
                'image_failed' => $imageFailed,
            ],
        ], 200);
    }

    private function normalizeHeaderMap(array $header)
    {
        $map = [];
        foreach ($header as $index => $name) {
            $key = $this->normalizeCsvKey($name);
            $map[$key] = $index;
        }
        return $map;
    }

    private function getCsvValue(array $row, array $headerMap, $key, $fallbackIndex)
    {
        $normalizedKey = $this->normalizeCsvKey($key);
        $index = $headerMap[$normalizedKey] ?? $fallbackIndex;
        return isset($row[$index]) ? trim($row[$index]) : '';
    }

    private function normalizeCsvKey($key)
    {
        $normalized = strtolower(trim($key));
        $normalized = str_replace([' ', '-'], '_', $normalized);
        return $normalized;
    }

    private function resolveImageUrl(array $row, array $headerMap)
    {
        $imageUrl = $this->getCsvValue($row, $headerMap, 'image_url', 3);
        if ($imageUrl === '') {
            $imageUrl = $this->getCsvValue($row, $headerMap, 'attachment_url', 13);
        }
        return trim($imageUrl);
    }

    private function formatContent($content)
    {
        $normalizedContent = str_replace(["\r\n", "\r"], "\n", trim($content));
        return '<p>' . str_replace("\n\n", '</p><p>', $normalizedContent) . '</p>';
    }

    private function downloadImageFromUrl($url, $title)
    {
        if (!$url) {
            return '';
        }

        try {
            $url = trim($url);
            if (!filter_var($url, FILTER_VALIDATE_URL)) {
                return '';
            }

            $directory = public_path('uploads/images');
            if (!is_dir($directory)) {
                mkdir($directory, 0755, true);
            }

            $response = Http::withHeaders([
                'User-Agent' => 'Mozilla/5.0',
            ])->withOptions([
                'verify' => false,
                'allow_redirects' => true,
            ])->timeout(30)->get($url);
            if (!$response->ok()) {
                return '';
            }

            $contentType = $response->header('Content-Type', 'image/jpeg');
            $extension = pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION) ?: 'jpg';
            $extension = strtolower($extension);
            if (strpos($contentType, 'png') !== false) {
                $extension = 'png';
            } elseif (strpos($contentType, 'webp') !== false) {
                $extension = 'webp';
            } elseif (strpos($contentType, 'gif') !== false) {
                $extension = 'gif';
            } elseif (strpos($contentType, 'jpeg') !== false || strpos($contentType, 'jpg') !== false) {
                $extension = 'jpg';
            } elseif (!in_array($extension, ['jpg', 'jpeg', 'png', 'webp', 'gif'])) {
                $extension = 'jpg';
            }

            $safeTitle = Str::slug($title) ?: 'blog';
            $fileName = $safeTitle . '-' . Str::random(6) . '.' . $extension;
            $relativePath = 'uploads/images/' . $fileName;
            $written = file_put_contents(public_path($relativePath), $response->body());
            if ($written === false) {
                return '';
            }

            return '/' . $relativePath;
        } catch (\Exception $e) {
            return '';
        }
    }
}
