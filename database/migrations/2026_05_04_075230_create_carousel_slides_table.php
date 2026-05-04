<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carousel_slides', function (Blueprint $table) {
            $table->id();
            $table->foreignId('carousel_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('sort_order')->default(0);
            $table->string('image_path');
            $table->string('disk')->default('public');
            $table->string('alt_text', 500)->nullable();
            $table->timestamps();

            $table->index(['carousel_id', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carousel_slides');
    }
};
