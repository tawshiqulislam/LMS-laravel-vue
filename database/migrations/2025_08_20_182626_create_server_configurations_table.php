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
        Schema::create('server_configurations', function (Blueprint $table) {
            $table->id();
            $table->string('server_name')->nullable()->comment('e.g. Main Hosting, DigitalOcean-1');
            $table->string('domain')->nullable()->comment('e.g. example.com');
            $table->string('ns1')->nullable()->comment('Name Server 1');
            $table->string('ns2')->nullable()->comment('Name Server 2');
            $table->string('root_path')->nullable()->comment('e.g. /home/username/public_html');
            $table->boolean('ssl_enabled')->nullable()->comment('HTTPS enabled or not');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('server_configurations');
    }
};
