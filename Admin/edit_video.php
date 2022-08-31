<?php 
session_start();
#Salir si alguno de los datos no está presente
if(
	!isset($_POST["name"]) || 
	!isset($_POST["description"]) || 
	!isset($_POST["link"]) || 
	!isset($_POST["date"])
) exit();


include('config.php');

$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];
$link = $_POST['link'];
$date = $_POST['date'];


$edit = $pdo->prepare("UPDATE videos SET name = ?, description = ?, link = ?, date = ? WHERE id = ?;");
$result = $edit->execute([$name, $description, $link, $date,$id]);
if($result === TRUE) {

    $image = $_FILES['image']['name'];
    if(!empty($image)){
        $sql_proj = "SELECT * FROM videos WHERE id= :id";
        $sql_proj_run = $pdo->prepare($sql_proj);
        $sql_proj_run->bindParam(':id', $id, PDO::PARAM_INT);
        $sql_proj_run->execute();
        $result2 = $sql_proj_run->fetch(PDO::FETCH_OBJ);

        $path = 'assets/images/videos/';
        $image_name = $_FILES['image']['name'];
        $image_tmp_name = $_FILES['image']['tmp_name'];

        $filename = uniqid() . '_' . $image_name;
        $storeImage = move_uploaded_file($image_tmp_name,$path . $filename);

        $sqlimg = "UPDATE videos SET `img` = :img WHERE `id` = :id";
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
    header("location: lista_videos.php");
    exit(0);
} else {
    $_SESSION['message'] = "Los cambios No han sido guardados con Exito Favor de Revisar los campos!";
    header("location:editar_video.php");
    exit(0);
}
?>