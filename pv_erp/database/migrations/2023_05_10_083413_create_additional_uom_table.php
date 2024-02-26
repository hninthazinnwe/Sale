<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdditionalUomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('additional_uoms', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('auto_key');
            $table->string('stock_id');
            $table->string('uom_id');
            $table->string('barcode');
            $table->boolean('is_delete');
            $table->timestamps();
            $table->string('created_by');
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
            $table->dateTime('deleted_at')->nullable();

            // $table->foreign('stock_id')->references('uuid')->on('stocks');
            // $table->foreign('uom_id')->references('uuid')->on('uoms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('additional_uom');
    }
}
