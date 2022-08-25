<?php 
session_start();
include('config.php');

if(isset($_POST['register-btn'])){


    $path = 'assets/images/videos/';
    $image_name = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $filename = uniqid() . '_' . $image_name;
    $storeImage = move_uploaded_file($image_tmp_name, $path . $filename);

    if($storeImage){

    $name = $_POST['name'];
    $description = $_POST['description'];
    $link = $_POST['link'];
    $date = $_POST['date'];

    $video_query = 'INSERT INTO videos (name, description, link, date,img) VALUE (?,?,?,?,?)';
    $video_query_run = $pdo->prepare($video_query);
    $video_query_run->execute(array($name, $description, $link, $date, $filename));

    if($video_query_run){
        $_SESSION['message'] = "Video Agregado Correctamente!";
        header('location: lista_videos.php');
        exit(0);
    }else {
        $_SESSION['message'] = "Algo salio mal verificalo Porfavor!";
        header('location: crear_video.php');
        exit(0);
    }
}
header('location: crear_video.php');
$_SESSION['message'] = "No se pudo guardar la imagen";
exit(0);
} else {
    header('location: crear_video.php');
    exit(0);
}


?>