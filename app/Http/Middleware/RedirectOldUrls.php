<?php

namespace App\Http\Middleware;

use App\Services\UrlRedirectService;
use Closure;

class RedirectOldUrls
{
    public function handle($request, Closure $next)
    {
        if (!$request->isMethod('GET') && !$request->isMethod('HEAD')) {
            return $next($request);
        }

        $target = UrlRedirectService::resolve($request->path());
        if (!$target || $target === UrlRedirectService::normalize($request->path())) {
            return $next($request);
        }

        $url = url($target);
        $query = $request->getQueryString();
        if ($query) {
            $url .= '?' . $query;
        }

        return redirect()->to($url, 301);
    }
}
