<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->constrained()->cascadeOnDelete();
            $table->string('type'); // hero, text, image, cta, etc.
            $table->string('name')->nullable();
            $table->unsignedInteger('order')->default(0);
            $table->json('content')->nullable(); // flexible content per section type
            $table->json('settings')->nullable(); // layout, visibility
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_sections');
    }
};
