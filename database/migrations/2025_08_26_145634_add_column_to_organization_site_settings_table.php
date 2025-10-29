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
        Schema::table('organization_site_settings', function (Blueprint $table) {
            $table->text('google_map_embed_code')->after('app_store_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('organization_site_settings', function (Blueprint $table) {
            $table->dropColumn('google_map_embed_code');
        });
    }
};
