<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('auto_key');
            $table->string('code')->unique();
            $table->string('name');
            $table->string('barcode');
            $table->float('buying_price');
            $table->float('selling_price');
            $table->float('wholesale_price');
            $table->string('uom_id');// $table->unsignedBigInteger('uom_id');
            $table->string('category_id');
            $table->string('brand_id');
            $table->boolean('is_stock');
            $table->boolean('is_delete');
            $table->timestamps();
            $table->string('created_by');
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
            $table->dateTime('deleted_at')->nullable();

            // $table->foreign('uom_id')->references('uuid')->on('uoms');
            // $table->foreign('category_id')->references('uuid')->on('categories');
            // $table->foreign('brand_id')->references('uuid')->on('brands');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
}
