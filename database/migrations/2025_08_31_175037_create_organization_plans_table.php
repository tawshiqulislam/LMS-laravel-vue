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
        Schema::create('organization_plans', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('plan_type');
            $table->integer('duration')->nullable();
            $table->decimal('price', 8, 2);
            $table->longText('description')->nullable();
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organization_plans');
    }
};
