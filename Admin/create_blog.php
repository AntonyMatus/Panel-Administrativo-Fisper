<?php
session_start();
include('config.php');

if(isset($_POST['register-btn'])){

    $path = 'assets/images/blogs/';
    $image_name = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $filename = uniqid() . '_' . $image_name;
    $storeImage = move_uploaded_file($image_tmp_name, $path . $filename);

    if($storeImage){
        $name = $_POST['name'];
        $description = $_POST['description'];
        $body = strval($_POST['body']);
        $date = $_POST['date'];
        $status = $_POST['status'];
        $category_id = $_POST['category_id'];

        
        

        $blog_query = "INSERT INTO blog (category_id, name, description, body, date, status, img) VALUE (:category_id, :name, :description, :body, :date, :status, :img);";
        $blog_query_run = $pdo->prepare($blog_query);

        
        $blog_query_run->bindParam(':category_id', $category_id);
        $blog_query_run->bindParam(':name', $name);
        $blog_query_run->bindParam(':description', $description);
        $blog_query_run->bindParam(':body', $body);
        $blog_query_run->bindParam(':date', $date);
        $blog_query_run->bindParam(':status', $status);
        $blog_query_run->bindParam(':img', $filename);

        $blog_execute = $blog_query_run->execute();


        if($blog_execute){
            $_SESSION['message'] = "Blog Agregado Correctamente!";
            header('location: lista_blog.php');
            exit(0);
        } else {
            $_SESSION['message'] = "Algo salio mal!";
            header('location: lista_blog.php');
            exit(0);
        }
    }
    header('location: crear_blog.php');
    $_SESSION['message'] = "No se pudo guardar la imagen";
    exit(0);
}  else {
    header('location: crear_blog.php');
    exit(0);
}

?>