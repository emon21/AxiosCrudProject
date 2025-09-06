<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price', 8, 2);
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            // $table->id();
            // $table->string('name');
            // $table->string('slug');
            // $table->string('description');
            // $table->string('image');
            // $table->string('price');
            // $table->string('category_id');
            // $table->string('status');
            // $table->string('stock');
            // $table->string('brand');
            
            // $table->timestamps();

            // $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
           
            // relationship
            // $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            // $table->foreignId('category_id')
            //     ->constrained('categories')
            //     ->onDelete('cascade');
            


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
