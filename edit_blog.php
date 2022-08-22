<?php
session_start();
include('config.php');

#Salir si alguno de los datos no está presente
if(
	!isset($_POST["name"]) || 
	!isset($_POST["description"]) || 
	!isset($_POST["date"]) || 
	!isset($_POST["status"])
) exit();

$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];
$date = $_POST['date'];
$status = $_POST['status'];
$category_id = $_POST['category_id'];



$edit_blog = $pdo->prepare("UPDATE blog SET category_id = ?, name = ?, description = ?, date = ?, status = ? WHERE id = ?;");
$result = $edit_blog->execute([$category_id, $name, $description, $date, $status, $id]);

if($result === TRUE) {

    $image = $_FILES['image']['name'];
    if(!empty($image)){
        $sql_proj = "SELECT * FROM blog WHERE id= ?";
        $sql_proj_run = $pdo->prepare($sql_proj);
        $sql_proj_run->bindParam(':id', $id, PDO::PARAM_INT);
        $sql_proj_run->execute();
        $result2 = $sql_proj_run->fetch(PDO::FETCH_OBJ);

        var_dump($result2);

        $path = 'assets/images/blogs/';
        $image_name = $_FILES['image']['name'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $filename = uniqid() . '_' . $image_name;
        $storeImage = move_uploaded_file($image_tmp_name,$path . $filename);

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

    $_SESSION['message'] = "Los cambios han sido guardados con Exito!";
    header("location: lista_blog.php");
    exit(0);
} else {
    $_SESSION['message'] = "Los cambios No han sido guardados con exito!";
    header("location:lista_blog.php");
    exit(0);
}



?>