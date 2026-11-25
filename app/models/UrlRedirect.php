<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class UrlRedirect extends Model
{
    protected $table = 'url_redirects';

    protected $fillable = ['from_path', 'to_path'];
}
