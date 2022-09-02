<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header('location:login.php');
    } else {
    
    }
?>
<?
    if(!isset($_GET['id'])) exit();

    $id = $_GET['id'];

    include('config.php');

    $sql = $pdo->prepare("SELECT * FROM videos WHERE id= ?;");
    $sql->execute([$id]);
    $video = $sql->fetch(PDO::FETCH_OBJ);
    if($video === FALSE){
        echo "No existe alguna persna con ese ID";
        exit(0);
    }


?>

<?php 
include('includes/header.php');
?>


<div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Editar Video</h4>
                <ol class="breadcrumb">
                </ol>
                <?php include('message.php') ?>
            </div>
        </div>
</div>
<div class="row">
    <div class="col-lg-12">
    <div class="card m-b-20">
        
        <div class="card-body">

            <?php include('message.php'); ?>

            
            <form class="" action="../../backend/videos/edit_video.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?php echo $video->id; ?>">
                            <label>Nombre</label>
                            <input type="text" class="form-control"  name="name" required placeholder="Escriba el nombre" value="<?php echo $video->name ?>"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Descripcion</label>
                            <div>
                                <input type="text"  name="description" class="form-control" required placeholder="Escriba la descripcion" value="<?php echo $video->description ?>"/>
                            </div>
                        
                        </div>
                    </div>
                
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Link</label>
                            <div>
                                <input type="url" class="form-control" required  name="link"  placeholder="https://" value="<?php echo $video->link ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Fecha</label>
                            <div>
                                <input type="date" class="form-control" required  name="date"  placeholder="" value="<?php echo $video->date ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Imagen</label>
                            <div>
                            <input type="file" class="filestyle" name="image" data-buttonname="btn-secondary">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group mb-0">
                    <div>
                        <button type="submit" name="edit-btn" class="btn btn-brown waves-effect waves-light mr-1">
                            Submit
                        </button>
                        <a  class="btn btn-secondary waves-effect" href="lista_videos.php">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
                                    <br><br>
            <div class="p-6 mb-8 bg-white rounded-lg shadow-md">
                <div class="flex justify-center">
                    <div style="position: relative;">
                    <div class="mt-2 ml-2" style="display: flex; position: absolute;">
                        <a
                        class="flex items-center justify-between px-2 py-2 mr-2 text-md font-medium leading-5 text-purple-600 rounded-lg focus:outline-none focus:shadow-outline-gray bg-white"
                        aria-label="Edit"
                        title="Imagen de portada"
                        >
                        Imagen de portada
                        </a>
                    </div>
                    <img loading="lazy" src="assets/images/videos/<?php echo $video->img  ?>" />
                    </div>
                </div>
            </div>


            </div>
        </div>
    </div>
</div>

<?php 
include('includes/footer.php');
include('includes/scripts.php');

?>