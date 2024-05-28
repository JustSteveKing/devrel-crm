<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Response;

final class DeviceIdentifier
{
    public function handle(Request $request, Closure $next): Response
    {
        if ( ! $request->hasHeader('X-DEVICE-ID')) {
            throw new BadRequestException(
                message: 'You need to send the X-DEVICE-ID header.',
            );
        }

        return $next($request);
    }
}
