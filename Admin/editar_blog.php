<?php
session_start();
if(!isset($_GET['id'])) exit();

$id = $_GET['id'];

include('config.php');

$sql = $pdo->prepare("SELECT * FROM blog WHERE id= ?;");
$sql->execute([$id]);
$blog = $sql->fetch(PDO::FETCH_OBJ);
if($blog === FALSE){
    echo "No existe alguna persna con ese ID";
    exit(0);
}


$query = "SELECT * FROM category";
$sql_2 = $pdo->prepare($query);
$sql_2->execute();
$result = $sql_2->fetchAll(PDO::FETCH_OBJ);


?>

<?php 
include('includes/header.php');
?>



<div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Editar Blog</h4>
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

            
            <form class="" action="edit_blog.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="hidden" name="id" value="<?php echo $blog->id ?>">
                            <input type="text" class="form-control"  name="name" required placeholder="Escriba el nombre" value="<?php echo $blog->name?>"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Descripcion</label>
                            <div>
                                <input type="text"  name="description" class="form-control" required placeholder="Escriba la descripcion" value="<?php echo $blog->description?>"/>
                            </div>
                        
                        </div>
                    </div>
                
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Fecha</label>
                            <div></div>
                                <input type="date" class="form-control" required  name="date"  placeholder="" value="<?php echo $blog->date?>"/>
                            </div>
                        </div>
                    

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Status plublicado</label>
                            <div>
                                <select name="status" class="form-control">
                                    <option value="">Seleccione el status</option>
                                    <option <?php if($blog->status == 0): ?> selected <?php endif ?> value="0" >SI</option>
                                    <option <?php if($blog->status == 1): ?> selected <?php endif ?> value="1">NO</option>
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
                                    <option <?php if($dato->id === $blog->category_id): ?> selected <?php endif ?> value="<?php echo $dato->id ?>"><?php echo $dato->name ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
                <div class="form-group mb-0">
                    <div>
                        <button type="submit" name="edit-btn" class="btn btn-brown waves-effect waves-light mr-1">
                            Submit
                        </button>
                        <a  class="btn btn-secondary waves-effect" href="lista_blog.php">
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
                    <img loading="lazy" src="assets/images/blogs/<?php echo $blog->img  ?>" />
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