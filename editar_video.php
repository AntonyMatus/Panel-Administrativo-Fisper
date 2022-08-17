<?php
session_start();
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

            
            <form class="" action="edit_video.php" method="POST">
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
                    
                </div>
                
                <div class="form-group mb-0">
                    <div>
                        <button type="submit" name="edit-btn" class="btn btn-primary waves-effect waves-light mr-1">
                            Submit
                        </button>
                        <a  class="btn btn-secondary waves-effect" href="lista_videos.php">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>

            </div>
        </div>
    </div>
</div>

<?php 
include('includes/footer.php');
include('includes/scripts.php');

?>