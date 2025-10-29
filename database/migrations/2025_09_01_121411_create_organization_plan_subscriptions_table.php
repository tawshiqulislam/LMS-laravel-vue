<?php

use App\Models\Organization;
use App\Models\OrganizationPlan;
use App\Models\Transaction;
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
        Schema::create('organization_plan_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Organization::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(OrganizationPlan::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Transaction::class)->constrained()->cascadeOnDelete();
            $table->timestamp('subscribed_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->boolean('is_paid')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organization_plan_subscriptions');
    }
};
