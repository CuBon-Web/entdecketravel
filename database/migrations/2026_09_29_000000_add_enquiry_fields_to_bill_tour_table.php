<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEnquiryFieldsToBillTourTable extends Migration
{
    public function up()
    {
        Schema::table('bill_tour', function (Blueprint $table) {
            if (! Schema::hasColumn('bill_tour', 'phone_code')) {
                $table->string('phone_code', 10)->nullable()->after('phone');
            }
            if (! Schema::hasColumn('bill_tour', 'hotel_category')) {
                $table->string('hotel_category', 50)->nullable()->after('email');
            }
            if (! Schema::hasColumn('bill_tour', 'travel_date')) {
                $table->date('travel_date')->nullable()->after('hotel_category');
            }
            if (! Schema::hasColumn('bill_tour', 'date_type')) {
                $table->string('date_type', 20)->nullable()->after('travel_date');
            }
            if (! Schema::hasColumn('bill_tour', 'nationality')) {
                $table->string('nationality', 100)->nullable()->after('date_type');
            }
            if (! Schema::hasColumn('bill_tour', 'request_type')) {
                $table->string('request_type', 20)->nullable()->after('nationality');
            }
        });
    }

    public function down()
    {
        Schema::table('bill_tour', function (Blueprint $table) {
            foreach (['phone_code', 'hotel_category', 'travel_date', 'date_type', 'nationality', 'request_type'] as $column) {
                if (Schema::hasColumn('bill_tour', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
}
