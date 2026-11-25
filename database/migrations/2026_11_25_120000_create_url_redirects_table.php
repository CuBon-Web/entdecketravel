<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUrlRedirectsTable extends Migration
{
    public function up()
    {
        if (Schema::hasTable('url_redirects')) {
            return;
        }

        Schema::create('url_redirects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('from_path', 512)->unique();
            $table->string('to_path', 512);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('url_redirects');
    }
}
