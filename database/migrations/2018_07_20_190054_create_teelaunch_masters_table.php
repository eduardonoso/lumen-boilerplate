<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeelaunchMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teelaunch_masters', function (Blueprint $table) {
            $table->string('masterKey');
            $table->string('categoryID');
            $table->string('active');
            $table->string('productTitle')->nullable();
            $table->string('productSKU')->nullable();
            $table->string('vendorID')->nullable();
            $table->decimal('productPrice',7,2)->nullable();
            $table->decimal('discountPrice',7,2)->nullable();
            $table->decimal('domesticShipping',7,2)->nullable();
            $table->decimal('canadaShipping',7,2)->nullable();
            $table->decimal('ukShipping',7,2)->nullable();
            $table->decimal('auShipping',7,2)->nullable();
            $table->decimal('internationalShipping',7,2)->nullable();
            $table->decimal('additionalShipping',7,2)->nullable();
            $table->string('availableOnApp')->nullable();
            $table->string('availableOnStore')->nullable();
            $table->string('availableOnManual')->nullable();
            $table->integer('sortOrder')->nullable();
            $table->string('defaultImage')->nullable();
            $table->string('sizeArray')->nullable();
            $table->decimal('productWeight',7,3)->nullable();
            $table->string('productWeightType')->nullable();
            $table->text('description')->nullable();;
            $table->text('descriptionModal')->nullable();
            $table->text('descriptionUpload')->nullable();
            $table->text('descriptionShopify')->nullable();
            $table->dateTime('dateCreated');
            $table->text('productSettings')->nullable();
            $table->string('model_name')->nullable();
            $table->string('model_location')->nullable();
            $table->text('modelSettings')->nullable();
            $table->string('companyKey')->nullable();
            $table->string('fulfillmentCenter')->nullable();
            $table->text('discontinued')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teelaunch_masters');
    }
}
