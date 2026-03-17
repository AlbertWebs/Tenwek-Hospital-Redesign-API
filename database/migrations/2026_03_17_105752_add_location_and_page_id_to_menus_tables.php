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
        Schema::table('menus', function (Blueprint $table) {
            $table->string('location', 32)->nullable()->after('key');
        });
        Schema::table('menu_items', function (Blueprint $table) {
            $table->foreignId('page_id')->nullable()->after('url')->constrained()->nullOnDelete();
            $table->string('icon', 64)->nullable()->after('open_in_new_tab');
        });
        // Backfill location from key
        \DB::table('menus')->where('key', 'header')->update(['location' => 'header']);
        \DB::table('menus')->where('key', 'footer')->update(['location' => 'footer']);
        \DB::table('menus')->whereNull('location')->update(['location' => 'header']);
    }

    public function down(): void
    {
        Schema::table('menu_items', function (Blueprint $table) {
            $table->dropForeign(['page_id']);
            $table->dropColumn('icon');
        });
        Schema::table('menus', function (Blueprint $table) {
            $table->dropColumn('location');
        });
    }
};
