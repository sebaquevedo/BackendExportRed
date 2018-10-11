<?php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once "vendor/autoload.php";
// Create a simple "default" Doctrine ORM configuration for Annotation Mapping
$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src/Entity"), $isDevMode);
// or if you prefer yaml or XML
//$config = Setup::createYAMLMetadataConfiguration(array(__DIR__."/config/yaml"), $isDevMode);
//$config = Setup::createXMLMetadataConfiguration(array(__DIR__."/config/xml"), $isDevMode);
// database configuration parameters
$conn = array(
	'driver'   => 'pdo_mysql',
	'host'=> '127.0.0.1',
	'port'=> 3306,
	'dbname'   => 'authentication',
	'user'     => 'root',
	'password' => '',
	
);



// obtaining the entity manager

$entityManager  = EntityManager::create($conn, $config);