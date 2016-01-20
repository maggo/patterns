<?php

use Silex\Application;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Symfony\Component\HttpFoundation\Response;

$app = new Application();
$app->register(new UrlGeneratorServiceProvider());
$app->register(new ValidatorServiceProvider());
$app->register(new ServiceControllerServiceProvider());
$app->register(new TwigServiceProvider(), array(
    'twig.path'    => array(__DIR__.'/../templates', __DIR__.'/../templates/patterns'),
    'twig.options' => array('cache' => __DIR__.'/cache/twig'),
));

$app['debug'] = true;


function getFiles($path, $base_path = null) {
  $path_files = array_diff(scandir($path), array('..', '.'));
  $files = array();

  foreach($path_files as $file) {
    $file_path = $path . '/' . $file;

    if($file[0] == '.') continue;

    if(is_dir($file_path)) {
      $files = array_merge($files, getFiles($file_path, $base_path ?: $path));
    } else {
      $files[] = $base_path ? str_replace($base_path . '/', '', $file_path) : $file_path;
    }
  }

  return $files;
}

$app->get('/page/{path}', function ($path) use ($app) {
  $path = rtrim($path, '/');

  if($path && file_exists($app['twig.path'][0] . '/pages/' . $path . '.html.twig')) {
    return $app['twig']->render('/pages/'.$path.'.html.twig');
  }

  return new Response('Page not found', 404);
})
  ->assert('path', '.*');

$app->get('/{path}', function ($path) use ($app) {
  $path = rtrim($path, '/');
  /** @var Twig_Environment $twig */
  $twig = $app['twig'];

  if($path) {
    return $twig->render('patterns.html.twig', array('patterns' => array($path => $path.'.html.twig')));
  }
  else {
    $files = getFiles($app['twig.path'][0] . '/patterns');
    return $twig->render('patterns.html.twig', array('patterns' => $files));
  }
})
  ->assert('path', '.*');

return $app;
