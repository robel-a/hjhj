<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuyingPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buying_prices', function (Blueprint $table) {
            $table->id();
            $table->json('products'); // Store product details as JSON
            $table->decimal('total_product_price', 10, 2);
            $table->decimal('freight_value', 10, 2);
            $table->decimal('insurance_value', 10, 2);
            $table->decimal('converted_price', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('buying_prices');
    }
}
