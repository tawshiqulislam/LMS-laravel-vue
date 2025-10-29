<?php

namespace App\Repositories;

use Abedin\Maker\Repositories\Repository;
use App\Models\ServerConfiguration;

class ServerConfigurationRepository extends Repository
{
    public static function model()
    {
        return ServerConfiguration::class;
    }

    public static function updateOrCreate($request)
    {
        $server = self::query()->first();
        $sslEnabled = $request->ssl_enabled == 'true' ? true : false;

        return self::query()->updateOrCreate(
            ['id' => $server ? $server->id : null],
            [
                'server_name' => $request->server_name ?? $server->server_name,
                'domain' => $request->domain ?? $server->domain,
                'ns1' => $request->ns1 ?? $server->ns1,
                'ns2' => $request->ns2 ?? $server->ns2,
                'root_path' => $request->root_path ?? $server->root_path,
                'ssl_enabled' => $sslEnabled ?? $server->ssl_enabled,
            ]
        );
    }
}
