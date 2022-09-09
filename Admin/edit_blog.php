<?php
session_start();
include('config.php');

#Salir si alguno de los datos no está presente
if(
	!isset($_POST["name"]) || 
	!isset($_POST["description"]) || 
    !isset($_POST["body"]) || 
	!isset($_POST["date"]) || 
	!isset($_POST["status"])
) exit();

$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];
$body = strval($_POST['body']);
$date = $_POST['date'];
$status = $_POST['status'];
$category_id = $_POST['category_id'];


$sql = "UPDATE blog SET category_id = :category_id, name = :name, description = :description, body = :body, date = :date, status = :status WHERE id = :id;";
$edit_blog = $pdo->prepare($sql);

$edit_blog->bindParam(':category_id', $category_id, PDO::PARAM_INT);
$edit_blog->bindParam(':name', $name, PDO::PARAM_STR);
$edit_blog->bindParam(':description', $description, PDO::PARAM_STR);
$edit_blog->bindParam(':body', $body, PDO::PARAM_STR);
$edit_blog->bindParam(':date', $date, PDO::PARAM_STR);
$edit_blog->bindParam(':status', $status, PDO::PARAM_INT);
$edit_blog->bindParam(':id', $id, PDO::PARAM_INT);
$result = $edit_blog->execute();

if($result === TRUE) {

    $image = $_FILES['image']['name'];


    if(!empty($image)){


        $sql_proj = "SELECT * FROM blog WHERE id= :id";
        $sql_proj_run = $pdo->prepare($sql_proj);
        $sql_proj_run->bindParam(':id', $id, PDO::PARAM_INT);
        $sql_proj_run->execute();
        $result2 = $sql_proj_run->fetch(PDO::FETCH_OBJ);

        

        $path = 'assets/images/blogs/';
        $image_name = $_FILES['image']['name'];
        $image_tmp_name = $_FILES['image']['tmp_name'];

        $filename = uniqid() . '_' . $image_name;
        $storeImage = move_uploaded_file($image_tmp_name, $path . $filename);

        $sqlimg = "UPDATE blog SET `img` = :img WHERE `id` = :id";
        $queryimg = $pdo->prepare($sqlimg);
        $queryimg->bindParam(':id', $id, PDO::PARAM_INT);
        $queryimg->bindParam(':img', $filename, PDO::PARAM_STR);

        $imgUpdate = $queryimg->execute();
        
        if($imgUpdate){
            $image_path = $path . $result2->img;
            unlink($image_path);
        }

    }

    $_SESSION['message'] = "Los cambios han sido actualizados con Exito!";
    header("location: lista_blog.php");
    exit(0);
} else {
    $_SESSION['message'] = "Los cambios No han sido actualizados con exito!";
    header("location:lista_blog.php");
    exit(0);
}



?>