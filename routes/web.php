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
    $factory  = \phpDocumentor\Reflection\DocBlockFactory::createInstance();
    $iterator = \Route::getRoutes()->getIterator();
    $iterator->asort();

    foreach ($iterator as $route) {
        if (in_array('api', $route->action['middleware']) !== false) {
            $descriptor = new \stdClass;

            // Parse uri, http methods, controller mapping
            $descriptor->uri = $route->uri;
            $descriptor->methods = $route->methods;
            $descriptor->action = $route->action['controller'];

            // Parse controller method
            $members = explode('@', $descriptor->action);
            $method = new ReflectionMethod($members[0], $members[1]);

            // Parse docblock
            $docblock = $factory->create($method);
            $description = $docblock->getTags();
            array_unshift($description, $docblock->getSummary());
            $descriptor->descriptions = $description;

            // Parse parameters
            $parameters = $method->getParameters();
            $formattedParams = array();

            foreach($parameters as $parameter){
                $type = $parameter->getType()->__toString();
                $dummy = new $type;
                if(is_a($dummy, 'Illuminate\Database\Eloquent\Model')){
                    $formattedParams[$dummy->getRouteKeyName()] = $parameter;
                }
                else {
                    $formattedParams[] = $parameter;
                }
            }

            $descriptor->parameters = $formattedParams;

            $routes[] = $descriptor;
        }
    }

    return view('api', compact('routes'));
});
