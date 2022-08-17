<?php 

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
$result = $edit->execute([$name, $description, $link, $date]);
if($result === TRUE) {
    $_SESSION['message'] = "Los cambios han sido guardados con Exito!";
    header("location: lista_videos.php");
    exit(0);
} else {
    $_SESSION['message'] = "Los cambios No han sido guardados con Exito Favor de Revisar los campos!";
    header("location:lista_videos.php");
    exit(0);
}
?>