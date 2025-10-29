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
        Schema::table('users', function (Blueprint $table) {
            $table->string('whatsapp')->nullable()->unique();
            $table->string('gender')->nullable();
            $table->date('birthday')->nullable();
            $table->longText('about')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('whatsapp');
            $table->dropColumn('gender');
            $table->dropColumn('birthday');
            $table->dropColumn('about');
        });
    }
};
