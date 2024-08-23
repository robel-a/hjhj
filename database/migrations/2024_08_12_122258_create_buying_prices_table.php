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
            $table->json('products'); // Storing JSON data
            $table->json('product_details'); // Storing JSON data
            $table->decimal('total_product_price', 10, 2);
            $table->decimal('freight_value', 10, 2);
            $table->decimal('insurance_value', 10, 2);
            $table->decimal('converted_price', 10, 2);
             $table->decimal('amount_in_birr', 10, 2);
              $table->decimal('exchange_rate', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('buying_prices');
    }
}
