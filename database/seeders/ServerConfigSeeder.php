<?php

namespace Database\Seeders;

use App\Repositories\ServerConfigurationRepository;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServerConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ServerConfigurationRepository::create([
            "server_name" => "Demo Server",
            "domain" => "https://example.com",
            "ns1" => "ns1.example.com",
            "ns2" => "ns2.example.com",
            "root_path" => "/home/username/public_html",
            "ssl_enabled" => false,
        ]);
    }
}
