<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('pid');
            $table->unsignedbigInteger('categoryid')->constrained('category');
            $table->foreign('categoryid')->references('cid')->on('category');
            $table->unsignedbigInteger('subcategoryid')->constrained('subcategory');
            $table->foreign('subcategoryid')->references('id')->on('subcategory');
            $table->unsignedbigInteger('puid')->constrained('product_unit');
            $table->foreign('puid')->references('puid')->on('product_unit');
            $table->string('pname');
            $table->string('pdesc');
            $table->string('pimg');
            $table->integer('pqty');
            $table->decimal('pprice',15,2);
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
        Schema::dropIfExists('products');
    }
}
