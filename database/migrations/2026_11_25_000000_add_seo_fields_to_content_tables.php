<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSeoFieldsToContentTables extends Migration
{
    public function up()
    {
        $this->addSeoColumns('products');
        $this->addSeoColumns('blogs');
        $this->addSeoColumns('product_category');
        $this->addSeoColumns('blog_category');
        $this->addSeoColumns('settings');
    }

    public function down()
    {
        foreach (['products', 'blogs', 'product_category', 'blog_category', 'settings'] as $table) {
            Schema::table($table, function (Blueprint $blueprint) use ($table) {
                if (Schema::hasColumn($table, 'seo_title')) {
                    $blueprint->dropColumn('seo_title');
                }
                if (Schema::hasColumn($table, 'meta_description')) {
                    $blueprint->dropColumn('meta_description');
                }
            });
        }
    }

    private function addSeoColumns($table)
    {
        Schema::table($table, function (Blueprint $blueprint) use ($table) {
            if (! Schema::hasColumn($table, 'seo_title')) {
                $blueprint->string('seo_title', 255)->nullable();
            }
            if (! Schema::hasColumn($table, 'meta_description')) {
                $blueprint->string('meta_description', 320)->nullable();
            }
        });
    }
}
