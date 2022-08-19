<?php
session_start();
if(!isset($_GET['id'])) exit();

$id = $_GET['id'];
include('config.php');

$delete = $pdo->prepare("DELETE FROM videos WHERE id = ?;");
$result = $delete->execute([$id]);

if($result){
    $_SESSION['message'] = "El video ha sido Eliminado con exito!";
    header('location: lista_videos.php');
    exit(0);
}else {
    $_SESSION['message'] = "Algo salió mal!";
    header('location: lista_videos.php');
    exit(0);
}



?>