<?php

use App\Models\Organization;
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
        Schema::create('organization_site_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Organization::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('logo_id')->nullable()->constrained('media')->nullOnDelete();
            $table->foreignId('footerlogo_id')->nullable()->constrained('media')->nullOnDelete();
            $table->foreignId('favicon_id')->nullable()->constrained('media')->nullOnDelete();
            $table->foreignId('scaner_id')->nullable()->constrained('media')->nullOnDelete();
            $table->string('app_name')->nullable();
            $table->string('app_currency')->nullable();
            $table->string('app_currency_symbol')->nullable();
            $table->string('footer_text')->nullable();
            $table->string('footer_contact_number')->nullable();
            $table->string('footer_support_mail')->nullable();
            $table->longText('footer_description')->nullable();
            $table->string('play_store_url')->nullable();
            $table->string('app_store_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organization_site_settings');
    }
};
