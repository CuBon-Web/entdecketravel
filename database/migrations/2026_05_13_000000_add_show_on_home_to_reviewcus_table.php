<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddShowOnHomeToReviewcusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reviewcus', function (Blueprint $table) {
            if (! Schema::hasColumn('reviewcus', 'show_on_home')) {
                $table->unsignedTinyInteger('show_on_home')->default(1)->after('status');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reviewcus', function (Blueprint $table) {
            if (Schema::hasColumn('reviewcus', 'show_on_home')) {
                $table->dropColumn('show_on_home');
            }
        });
    }
}
