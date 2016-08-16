<?php
header("Content-Type: text/html");

include __DIR__ . '/vendor/autoload.php';

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$router = new AltoRouter();
$router->setBasePath('');

// Setup the URL routing. This is production ready.
$router->map('GET','/', 'src/View/home.php', 'home');
$router->map('GET','/insert/', __DIR__.'/src/View/insert.php', 'save');
$router->map('POST','/write/', __DIR__.'/src/Model/write.php', 'write');
$router->map('GET','/data/', 'about.php', 'about');
$router->map('GET','/test/', __DIR__.'/src/Controller/template-manager.php', 'temp');

/* Match the current request */
$match = $router->match();
if($match) {
  require $match['target'];
}
else {
  header("HTTP/1.0 404 Not Found");
  // show 404 page
  require __DIR__ . '/src/View/404.php';
}
?>
