<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPriceNotesToProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            if (! Schema::hasColumn('products', 'price_includes')) {
                $table->longText('price_includes')->nullable()->after('price_chil');
            }
            if (! Schema::hasColumn('products', 'price_excludes')) {
                $table->longText('price_excludes')->nullable()->after('price_includes');
            }
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'price_includes')) {
                $table->dropColumn('price_includes');
            }
            if (Schema::hasColumn('products', 'price_excludes')) {
                $table->dropColumn('price_excludes');
            }
        });
    }
}
