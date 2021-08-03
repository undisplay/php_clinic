<?php
require_once("./core/Router.php");
require_once("./core/Template.php");

require_once("./controllers/patient.php");
require_once("./controllers/medecin.php");
require_once("./controllers/consultation.php");

$router = new Core\Router();

$router->connect("GET","/",function(){Core\Template::redirect("./patient");});

$router->connect("POST","/patient","patient_create");
$router->connect("GET","/patient","patient_liste");
$router->connect("GET","/patient/:id","patient_details");
$router->connect("POST","/patient/:id","patient_update");
$router->connect("POST","/patient/delete/:id","patient_delete");


$router->connect("POST","/medecin","medecin_create");
$router->connect("GET","/medecin","medecin_liste");
$router->connect("GET","/medecin/:id","medecin_details");
$router->connect("POST","/medecin/:id","medecin_update");
$router->connect("POST","/medecin/delete/:id","medecin_delete");


$router->connect("POST","/consultation","consultation_create");
$router->connect("GET","/consultation","consultation_liste");
$router->connect("GET","/consultation/:id","consultation_details");


$router->execute();
?>