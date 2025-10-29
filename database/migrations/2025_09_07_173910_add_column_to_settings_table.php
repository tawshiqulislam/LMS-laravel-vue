<?php

use App\Models\Media;
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
        Schema::table('settings', function (Blueprint $table) {
            $table->foreignIdFor(Media::class, 'hero_thumbnail_id')->nullable()->after('favicon_id')->constrained('media')->cascadeOnDelete();
            $table->foreignIdFor(Media::class, 'about_thumbnail_id')->nullable()->after('hero_thumbnail_id')->constrained('media')->cascadeOnDelete();
            $table->foreignIdFor(Media::class, 'footer_bg_thumbnail_id')->nullable()->after('about_thumbnail_id')->constrained('media')->cascadeOnDelete();
            $table->string('hero_subtitle')->nullable();
            $table->string('hero_title')->nullable();
            $table->longText('hero_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropConstrainedForeignIdFor(Media::class, 'hero_thumbnail_id');
            $table->dropConstrainedForeignIdFor(Media::class, 'about_thumbnail_id');
            $table->dropConstrainedForeignIdFor(Media::class, 'footer_bg_thumbnail_id');
            $table->dropColumn(['hero_subtitle', 'hero_title', 'hero_description']);
        });
    }
};
