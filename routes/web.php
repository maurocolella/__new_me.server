<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $routes = [];
    foreach (\Route::getRoutes()->getIterator() as $route) {
        if (strpos($route->action['middleware'], 'api') !== false) {
            $descriptor = new \stdClass;

            $descriptor->uri = $route->uri;
            $descriptor->methods = $route->methods;
            $descriptor->action = $route->action['controller'];

            $members = explode('@', $descriptor->action);
            $method = new ReflectionMethod($members[0], $members[1]);

            $descriptor->description = trim($method->getDocComment());
            $descriptor->parameters = $method->getParameters();

            $routes[] = $descriptor;
        }
    }

    return view('api', compact('routes'));
});
