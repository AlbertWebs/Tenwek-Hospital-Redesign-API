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
        Schema::table('pages', function (Blueprint $table) {
            $table->string('page_type', 24)->default('managed')->after('template');
            $table->string('listing_type', 24)->nullable()->after('page_type');
            $table->text('intro')->nullable()->after('meta_description');
        });
    }

    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn(['page_type', 'listing_type', 'intro']);
        });
    }
};
