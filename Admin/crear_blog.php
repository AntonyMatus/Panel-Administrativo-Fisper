
<?php 
session_start();

if(!isset($_SESSION['user_id'])){
    header('location:login.php');
    } else {
    
    }
?>
<?php
include('includes/header.php');
include('config.php');

$query = "SELECT * FROM category";
$sql = $pdo->prepare($query);
$sql->execute();
$result = $sql->fetchAll(PDO::FETCH_OBJ);


?>


<div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Crear Blog</h4>
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

            
            <form class="" action="create_blog.php" method="POST" enctype="multipart/form-data">
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
                            <label>Fecha</label>
                            <div></div>
                                <input type="date" class="form-control" required  name="date"  placeholder=""/>
                            </div>
                        </div>
                    

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Status plublicado</label>
                            <div>
                                <select name="status" class="form-control">
                                    <option value="">Seleccione el status</option>
                                    <option value="0">SI</option>
                                    <option value="1">NO</option>
                                </select>
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Categoria</label>
                            <div>
                                <select name="category_id" class="form-control">
                                    <option value="">Seleccione la categoria</option>
                                    <?php foreach($result as $dato): ?>
                                    <option value="<?php echo $dato->id ?>"><?php echo $dato->name ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
                <div class="form-group mb-0">
                    <div>
                        <button type="submit" name="register-btn" class="btn btn-brown waves-effect waves-light mr-1">
                            Submit
                        </button>
                        <a  class="btn btn-secondary waves-effect" href="lista_blog.php">
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