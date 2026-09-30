<?php

namespace App\models\website;

use Illuminate\Database\Eloquent\Model;

class AlbumAffter extends Model
{
    protected $table = "albumafter";

    protected $fillable = ['id', 'name', 'image', 'images', 'status', 'link'];

    protected $casts = [
        'images' => 'array',
    ];

    /**
     * Danh sách URL ảnh trong album (tương thích bản ghi chỉ có image).
     */
    public function getGalleryImagesAttribute()
    {
        $imgs = $this->images;
        if (is_array($imgs) && count(array_filter($imgs))) {
            return array_values(array_filter($imgs));
        }
        if ($this->image) {
            return [$this->image];
        }

        return [];
    }
}
