<?php

session_start();

$is_admin = isset($_SESSION['role']) ? $_SESSION['role'] : 0;
if(!$is_admin){
    $_SESSION['message'] = "Usted no tiene Permisos en esta pagina!";
    header('location: index.php');
    
} 
if(!isset($_GET['id'])) exit();

$id = $_GET['id'];
include('config.php');

$query = "DELETE FROM users WHERE `id` = :id";

$delete_users = $pdo->prepare($query);

$delete_users->bindParam(':id', $id);

$deleteUser = $delete_users->execute();

if($deleteUser){
    $_SESSION['message'] = "El Usuario ha sido Eliminado con exito!";
    header('location: lista_usuarios.php');
    exit(0);
} else {
    $_SESSION['message'] = "Algo salió mal!";
    header('location: lista_usuarios.php');
    exit(0);
}

?>