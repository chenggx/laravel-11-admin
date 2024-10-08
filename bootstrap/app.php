<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //未登录异常
        $exceptions->render(function (AuthenticationException $e) {
            return response()->json([
                'code' => 401,
                'message' => '未登录'
            ]);
        });

        $exceptions->render(function (NotFoundHttpException $e) {
            return response()->json([
                'code' => 404,
                'message' => '当前资源不存在'
            ]);
        });

    })->create();
