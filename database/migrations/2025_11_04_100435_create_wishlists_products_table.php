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
        Schema::create('wishlists_products', function (Blueprint $table) {
            $table->id();

            // Liaison avec la wishlist
            $table->foreignId('wishlist_id')
                ->constrained()
                ->onDelete('cascade');

            // Liaison avec le produit
            $table->foreignId('product_id')
                ->constrained()
                ->onDelete('cascade');

            // Empêcher les doublons (même produit plusieurs fois dans une wishlist)
            $table->unique(['wishlist_id', 'product_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wishlists_products');
    }
};
