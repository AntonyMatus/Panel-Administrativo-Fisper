<?php
session_start();
if(!isset($_GET['id'])) exit();


$id = $_GET['id'];
include('config.php');

$query = "SELECT * FROM blog WHERE id = ?;";
$conect = $pdo->prepare($query);
$conect->execute([$id]);
$delete_img = $conect->fetch(PDO::FETCH_OBJ);


$imagen_path = 'assets/images/blogs/' . $delete_img->img;
unlink($imagen_path);


$delete = $pdo->prepare("DELETE FROM blog WHERE id = ?;");
$result = $delete->execute([$id]);

if($result){
    $_SESSION['message'] = "El blog ha sido Eliminado con exito!";
    header('location: lista_blog.php');
    exit(0);
}else {
    $_SESSION['message'] = "Algo salió mal!";
    header('location: lista_blog.php');
    exit(0);
}