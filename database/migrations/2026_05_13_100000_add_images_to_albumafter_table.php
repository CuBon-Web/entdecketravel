<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImagesToAlbumafterTable extends Migration
{
    public function up()
    {
        Schema::table('albumafter', function (Blueprint $table) {
            if (! Schema::hasColumn('albumafter', 'images')) {
                $table->text('images')->nullable()->after('image');
            }
        });
    }

    public function down()
    {
        Schema::table('albumafter', function (Blueprint $table) {
            if (Schema::hasColumn('albumafter', 'images')) {
                $table->dropColumn('images');
            }
        });
    }
}
