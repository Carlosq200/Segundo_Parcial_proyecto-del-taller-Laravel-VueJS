<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use App\Models\Tenant;

class ResolveTenant
{
    public function handle(Request $request, Closure $next)
    {
        $host = $request->getHost();           // p.ej. empresa1.local
        $sub  = explode('.', $host)[0] ?? null;

        if ($sub) {
            $tenant = Tenant::where('subdomain', $sub)->first();

            if (! $tenant) {
                abort(404, 'Tenant no encontrado');
            }

            // apuntar SOLO la conexión 'tenant' al sqlite del tenant
            Config::set('database.connections.tenant.database', database_path('tenants/'.$tenant->database));
            DB::purge('tenant');
            DB::reconnect('tenant');

            // ¡No cambies el default! Sanctum y el login usan la BD central.
            // Config::set('database.default', 'tenant');
        }

        return $next($request);
    }
}