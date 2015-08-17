<?php
  require_once __DIR__."/../vendor/autoload.php";
  require_once __DIR__."/../src/Inventory.php";

  $app = new Silex\Application();

  $server = 'mysql:host=localhost;dbname=inventory';
  $username = 'root';
  $password = 'root';
  $DB = new PDO($server, $username, $password);

  $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
  ));

  $app->get("/", function() use ($app) {
    return $app['twig']->render('index.html.twig');
  });

  $app->get("/inventories", function() use ($app) {
       return $app['twig']->render('inventories.html.twig', array('inventories' => Inventory::getAll()));
   });



$app->post("/inventories", function() use ($app) {
  $inventory = new Inventory($_POST['name']);
  $inventory->save();
  return $app['twig']->render('inventories.html.twig', array('inventories' =>Inventory::getAll()));
});

  $app->post("/delete_inventories", function() use ($app) {
    Inventory::deleteAll();
    return $app['twig']->render('index.html.twig');
});

  return $app;
?>
