<?php
header("Content-Type: text/html");

include __DIR__ . '/vendor/autoload.php';

use WCal\Controller\TemplateManager;
use WCal\Controller\DataWorker;

/* Constant that enables debuging tools Whoops and Kint */
define("DEBUG", true);

/* Check if debug is eanbled */
if (DEBUG){
    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();
    
    Kint::$theme = 'solarized-dark';
} else {
    Kint::enabled(false);
}

$router = new AltoRouter();
$router->setBasePath('');

// Setup the URL routing.
// 1-http request, 2-matching url, 3-path to match, 4-name
$router->map('GET','/', function(){
    $tmanager = new TemplateManager();
    $tmanager->home();
}, 'home');

$router->map('GET', '/form/', function(){
    $tmanager = new TemplateManager();
    $tmanager->form();
}, 'form');

$router->map('GET', '/data/', function(){
    $tmanager = new TemplateManager();
    $tmanager->data();
}, 'about');

$router->map('GET', '/about/', function(){
    $tmanager = new TemplateManager();
    $tmanager->about();
});

$router->map('POST','/write/', function(){
    $worker = new DataWorker();
    $worker->saveData();
});

$router->map('GET', '/delete/[i:id]/' , function($id){
    $worker = new DataWorker();
    $worker->deleteData($id);
});

$router->map('GET', '/update/[i:id]/' , function($id){
    $tmanager = new TemplateManager();
    $tmanager->update($id);
});

$router->map('POST', '/update/' , function(){
    $worker = new DataWorker();
    $worker->update();
});

$match = $router->match();

# If a matching route is found
if( $match && is_callable( $match['target'] ) ) {
        call_user_func_array( $match['target'], $match['params']);
} else {
// no route was matched show 404 page
    header("HTTP/1.0 404 Not Found");
    require 'static/404.html';
}