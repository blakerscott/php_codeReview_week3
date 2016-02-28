<?php

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Client.php";
    require_once __DIR__."/../src/Stylist.php";

    $app = new Silex\Application();

    $server = 'mysql:host=localhost;dbname=hair_salon';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });


//////////////////////
////////STYLISTS/////////
////////////////////

    $app->get("/stylists", function() use ($app) {
        return $app['twig']->render('stylists.html.twig', array('stylist' => Stylist::getAll()));
    });

    $app->get("/stylists/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        return $app['twig']->render('stylists.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getclients()));
    });

    $app->post("/stylists", function() use ($app) {
        $stylist = new Stylist($_POST['type']);
        $stylist->save();
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->post("/delete_stylists", function() use ($app) {
       Stylist::deleteAll();
       return $app['twig']->render('index.html.twig');
   });

   $app->get("/stylists/{id}/edit", function($id) use ($app) {
        $stylist = Stylist::find($id);
        return $app['twig']->render('stylist_edit.html.twig', array('stylist' => $stylist));
    });

    $app->patch("/stylists/{id}", function($id) use ($app) {
        $type = $_POST['type'];
        $stylist = Stylist::find($id);
        $stylist->update($type);
        return $app['twig']->render('stylists.html.twig', array('stylist' => $stylist, 'client' => $stylist->getClients()));
    });

    //////////////////////
    ////CLIENTS//////
    ////////////////////

    $app->post("/clients", function() use ($app) {
        $name = $_POST['name'];
        $age = $_POST['age'];
        $hairstyle = $_POST['hairstyle'];
        $stylist_id = $_POST['stylist_id'];
        $client = new Client($id= null, $name, $age, $hairstyle, $stylist_id);
        $client->save();
        $stylist = Stylist::find($stylist_id);
        return $app['twig']->render('Stylists.html.twig', array('stylist' => $stylist, 'clients' => $client->getClients()));
    });

    $app->get("/clients/{id}/edit", function($id) use ($app) {
        $client = Client::find($id);
        return $app['twig']->render('client_edit.html.twig', array('client' => $client));
    });

    $app->patch("/client/{id}", function($id) use ($app) {
       $new_name = $_POST['name'];
       $new_happy_hour = $_POST['happy_hour'];
       $new_address = $_POST['address'];
       $client = Client::find($id);
       $client->updateClient($new_name, $new_age, $new_hairstyle);
       $stylist_id = $client->getStylistId();
       $stylist = Stylist::find($stylist_id);
       return $app['twig']->render('stylists.html.twig', array('stylist' => $cuisine, 'clients' => $stylist->getClients()));
   });

    $app->delete("/client/{id}/delete", function($id) use ($app) {
        $client = Client::find($id);
        $stylist_id = $client->getStylistId();
        $stylist = Stylist::find($stylist_id);
        $client->deleteOneClient();
        return $app['twig']->render('stylists.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
    });

    return $app;
?>
