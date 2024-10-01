<?php

// Di App\Http\Middleware\KategoriMiddleware.php

namespace App\Http\Middleware;

use Closure;
use App\Models\Kategori;

class KategoriMiddleware
{
    public function handle($request, Closure $next)
    {
        // Bagikan data kategori ke semua views
        view()->share('kategoris', Kategori::all());
        return $next($request);
    }
}

