<?php 

require_once 'vendor/autoload.php';
require_once 'src/controllers/passwordByDefault.php';
include 'src/controllers/autenticacionController.php';
use Doctrine\ORM\EntityManager;


$app = new \Slim\Slim();

//$db = new mysqli('192.168.88.215', 'root', 'root', 'Export_Full_OSS13');

//base de datos prueba extraccion de datos
//$db = new mysqli('localhost', 'root', '', 'ecommerce');

//base de datos de autenticacion
$db = new mysqli('localhost', 'root', '', 'authentication');


// Configuración de cabeceras
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS") {
    die();
}


$app->get("/tablas", function() use($db,$app){
	echo "Hola Mundo desde Slim PHP";
	//$prueba = new autenticacionController($entityManager);
	//$prueba->traerTablas();
		//$sql = 'SELECT * FROM productos ORDER BY id DESC;';

		$sql = "SELECT TABLE_SCHEMA,TABLE_NAME,COLUMN_NAME ".
		"FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='Export_Full_OSS13' ".
		"and COLUMN_NAME='Qrxlevmin' and TABLE_NAME='EUtranCellFDD' ";
		$query = $db->query($sql);

		$tablas = array();

		while ($tabla = $query->fetch_assoc()) {
			$tablas[] = $tabla;
		}

		$result = array(
				'status' => 'success',
				'code'	 => 200,
				'data' => $tablas
			);

		echo json_encode($result);
	

});


// registrar usuarios
$app->post('/register', function() use($app, $db){
	$json = $app->request->post('json');
	$data = json_decode($json, true);

	if(!isset($data['email'])){
		$data['email']=null;
	}

	if(!isset($data['password'])){
		$data['password']=null;
	}

	$queryExiste = "SELECT * FROM autenticacion".
	" where username = "."'{$data['email']}'".
	" and password = "."'{$data['password']}'";

	$existe = $db->query($queryExiste);

	$dataExiste = array();

	while($row = mysqli_fetch_assoc($existe)){
    	$dataExiste[] = $row; 
	}

	if(empty($dataExiste)) {
     // data esta vacio.
		//deberia registrar
		

		if(empty($data['password'])){
			$passDefault = passwordByDefault::singleton();
			$pass = $passDefault->getPasswordByDefault();
			$data['password'] = $pass;

			$app->response->setStatus(200);
			$result = array(
				'status' => 'success',
				'code'	 => 200,
				'message' => 'Usuario registrado correctamente',
				'data' => $data['password']
				);
			$existe->close();
			$db->close();
			echo json_encode($result);
		}

		// $query = "INSERT INTO autenticacion(username, password, correo, nombre, apellido, rut, telefono) VALUES (".
		// 	 "'{$data['email']}',".
		// 	 "'{$data['password']}',".
		// 	 "'{$data['email']}',".
		// 	 "'{$data['nombre']}',".
		// 	 "'{$data['apellido']}',".
		// 	 "'{$data['rut']}',".
		// 	 "'{$data['telefono']}'".
		// 	 ");";

		// $insert = $db->query($query);

		
		// if($insert){

		// 	$app->response->setStatus(200);
		// 	unset($data["password"]);
		// 	$result = array(
		// 		'status' => 'success',
		// 		'code'	 => 200,
		// 		'message' => 'Usuario registrado correctamente',
		// 		'data' => $data
		// 		);
		// }
		// else{
		// 	//aca debe devolver error porque el usuario ya esta registrado
		// 	$app->response->setStatus(404);
		// 	$result = array(
		// 		'status' => 'error',
		// 		'code'	 => 404,
		// 		'message' => 'Se produjo un problema para registrar al usuario'
		// 		);
		// 	}
		}
		else
		{
			$app->response->setStatus(404);
			$result = array(
				'status' => 'error',
				'code'	 => 404,
				'message' => 'Usuario ya esta registrado'
				);
		}
		
		
	//$existe->close();
	echo json_encode($result);
	//$db->close();
});


$app->post('/login', function() use($app, $db){

	$json = $app->request->post('json');
	$data = json_decode($json, true);

	$queryExiste = "SELECT * FROM autenticacion".
	" where username ="."'{$data['email']}'".
	" and password ="."'{$data['password']}'";

		/* comprobar la conexión */
	if ($db->connect_errno) {
	    printf("Falló la conexión: %s\n", $db->connect_error);
	    exit();
	}

	$resultadoQuery = $db->query($queryExiste);

	$data = array();

	while($row = mysqli_fetch_assoc($resultadoQuery)){
    	$data[] = $row; 
    
	}
	
	if (empty($data)) {
     // data esta vacio.
		$app->response->setStatus(404);
		$resultResponse = array(
			'status' => 'error',
			'code'	 => 404,
			'message' => 'Usuario o contraseña incorrectos'
		);
	}else{
		unset($data['password']);
		$app->response->setStatus(200);
		$resultResponse = array(
			'status' => 'success',
			'code'	 => 200,
			'message' => 'Usuario correctamente logeado',
			'data' => $data
		);
	}


	$resultadoQuery->close();
	echo json_encode($resultResponse);
	$db->close();
});


$app->run();