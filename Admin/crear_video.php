<?php 
session_start();
include('includes/header.php');
?>

<div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Crear Vídeo</h4>
                <ol class="breadcrumb">
                </ol>
            </div>
        </div>
</div>
<div class="row">
    <div class="col-lg-12">
    <div class="card m-b-20">
        
        <div class="card-body">

            <?php include('message.php'); ?>

            
            <form class="" action="create_video.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" class="form-control"  name="name" required placeholder="Escriba el nombre"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Descripcion</label>
                            <div>
                                <input type="text"  name="description" class="form-control" required placeholder="Escriba la descripcion"/>
                            </div>
                        
                        </div>
                    </div>
                
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Link</label>
                            <div>
                                <input type="url" class="form-control" required  name="link"  placeholder="https://"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Fecha</label>
                            <div>
                                <input type="date" class="form-control" required  name="date"  placeholder=""/>
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
                        <button type="submit" name="register-btn" class="btn btn-primary waves-effect waves-light mr-1">
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