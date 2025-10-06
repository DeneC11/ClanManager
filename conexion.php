<?php
require 'funciones.php';
$host='127.0.0.1';
$db='clanmanager';
$user='root';
$pass='';
$charset='utf8mb4';
$dsn="mysql:host=$host;dbname=$db;charset=$charset";
// dsn=data source name
$options=[
    PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC, //hace que el gestor de base de datos nos devuelva siempre arrays asociativos
    PDO::ATTR_EMULATE_PREPARES=>false, //desactiva la emulacion de sentencias preparadas
];
try{
    $pdo=new PDO($dsn,$user,$pass,$options);
}catch(PDOException $e){
    $mensaje=date("Y-m-d H:i:s")."- Error de conexion: ".$e->getMessage().PHP_EOL;
    http_response_code(500);
    if(!file_exists(__DIR__."/logs")){
        mkdir(__DIR__."/logs",0755,true);
    }
    error_log($mensaje,3,__DIR__.'/logs/errores.log');
    die('error de conexión');
}
?>