<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('item');
            $table->decimal('buying_price', 15, 2)->nullable();
            $table->decimal('other_cost', 15, 2)->nullable();
            $table->decimal('total_cost', 15, 2)->nullable();
            $table->decimal('margin', 15, 2)->nullable();
            $table->decimal('selling_price', 15, 2)->nullable();
            $table->integer('qty')->nullable();
            $table->decimal('cost', 15, 2)->nullable();
            $table->decimal('amount_usd', 15, 2)->nullable();
            $table->decimal('rate', 15, 2)->nullable();
            $table->decimal('amount_birr', 15, 2)->nullable();
            $table->decimal('customs', 15, 2)->nullable();
            $table->decimal('freight_other_insurance', 15, 2)->nullable();
            $table->decimal('cif', 15, 2)->nullable();
            $table->decimal('exc_rate', 15, 2)->nullable();
            $table->decimal('dpv_in_birr', 15, 2)->nullable();
            $table->decimal('customs_rate', 15, 2)->nullable();
            $table->decimal('extax', 15, 2)->nullable();
            $table->decimal('vat', 15, 2)->nullable();
            $table->decimal('sur_tax', 15, 2)->nullable();
            $table->decimal('withholding_tax', 15, 2)->nullable();
            $table->decimal('social_welfare', 15, 2)->nullable();
            $table->decimal('total_tax', 15, 2)->nullable();
            $table->string('report_type')->nullable(); // To differentiate between "buying" and "customTax"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
