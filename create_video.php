<?php 
session_start();
include('config.php');

if(isset($_POST['register-btn'])){


    $name = $_POST['name'];
    $description = $_POST['description'];
    $link = $_POST['link'];
    $date = $_POST['date'];

    $video_query = 'INSERT INTO videos (name, description, link, date) VALUE (?,?,?,?)';
    $video_query_run = $pdo->prepare($video_query);
    $video_query_run->execute(array($name, $description, $link, $date));

    if($video_query_run){
        $_SESSION['message'] = "Video Agregado Correctamente!";
        header('location: lista_videos.php');
        exit(0);
    }else {
        $_SESSION['message'] = "Algo salio mal verificalo Porfavor!";
        header('location: crear_video.php');
        exit(0);
    }

} else {
    header('location: crear_video.php');
    exit(0);
}


?>