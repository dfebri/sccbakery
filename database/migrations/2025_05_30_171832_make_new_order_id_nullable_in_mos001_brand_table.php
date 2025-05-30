<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeNewOrderIdNullableInMos001BrandTable extends Migration {

	 public function up()
    {
        Schema::table('mos001_brand', function (Blueprint $table) {
            $table->integer('order_id')->nullable()->change();
		});
    }

    public function down()
    {
        Schema::table('mos001_brand', function (Blueprint $table) {
            $table->integer('order_id')->nullable(false)->change();
        });
    }

}
