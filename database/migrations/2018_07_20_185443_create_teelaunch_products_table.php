<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeelaunchProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teelaunch_products', function (Blueprint $table) {
            $table->string('productID');
            $table->string('parentID');
            $table->string('categoryID');
            $table->string('active');
            $table->string('productTitle')->nullable();
            $table->string('productSKU')->nullable();
            $table->integer('vendorID')->nullable();
            $table->string('defaultImage')->nullable();
            $table->string('defaultImage2')->nullable();
            $table->decimal('productPrice',7,2)->nullable();
            $table->string('colorName')->nullable();
            $table->string('swatchColor')->nullable();;
            $table->integer('thumbItem')->nullable();
            $table->dateTime('dateCreated');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teelaunch_products');
    }
}
