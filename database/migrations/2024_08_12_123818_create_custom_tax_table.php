<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomTaxTable extends Migration
{
    public function up()
    {
        Schema::create('custom_tax', function (Blueprint $table) {
            $table->id();
            $table->decimal('total_product_price', 15, 2);
            $table->decimal('freight_value', 15, 2);
            $table->decimal('insurance_value', 15, 2);
            $table->decimal('exchange_rate', 10, 4);
            $table->decimal('duty_value', 5, 2);
            $table->decimal('sur_value', 5, 2);
            $table->decimal('vat_value', 5, 2);
            $table->decimal('excise_value', 5, 2);
            $table->decimal('withholding_value', 5, 2);
            $table->decimal('social_value', 5, 2);
            $table->decimal('total_freight', 15, 2);
            $table->decimal('total_insurance', 15, 2);
            $table->decimal('total_duties', 15, 2);
            $table->decimal('total_excise', 15, 2);
            $table->decimal('total_vat', 15, 2);
            $table->decimal('total_sur', 15, 2);
            $table->decimal('total_withholding', 15, 2);
            $table->decimal('total_social', 15, 2);
            $table->decimal('total_tax', 15, 2);
            $table->decimal('cif', 15, 2);
            $table->json('products'); // Storing JSON data
            $table->json('product_details'); // Storing JSON data
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('custom_tax');
    }
}
