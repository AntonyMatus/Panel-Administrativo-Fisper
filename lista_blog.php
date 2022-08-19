
<?php 
session_start();
include('config.php');

$query = "SELECT * FROM blog";
$blog = $pdo->prepare($query);
$blog->execute();

$result = $blog->fetchAll();


include('includes/header.php');
?>


<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">Lista de Blog</h4>
            <ol class="breadcrumb">
                
                
            </ol>

            <?php include('message.php'); ?>
        </div>
    </div>
</div>
<!-- end row -->

<div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">

                    <a href="crear_blog.php" class="btn btn-primary waves-effect waves-light float-right m-b-10 ">Crear Blog</a>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Nombre</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>options</th>
                            
                        </tr>
                        </thead>


                        <tbody>
                            <?php foreach($result as $dato): ?>
                        <tr>
                            <td><?php echo $dato['id'] ?></td>
                            <td><?php echo $dato['name'] ?></td>
                            <td><?php echo $dato['description'] ?></td>
                            <td ><?php echo $dato['date']?></td>
                            
                            <td>
                            <a href="<?php echo "editar_blog.php?id=" .$dato['id'] ?>"><i  class="fas fa-pencil-alt" style="color: violet;"></i></a>
                                     &nbsp; &nbsp;&nbsp;&nbsp;
                            <a href="<?php echo "delete_blog.php?id=" .$dato['id']?>"><i class="fas fa-trash-alt" style="color: #ec536c;"></i></a>  
                                

                            </td>
                        </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->


<?php 
include('includes/footer.php');
include('includes/scripts.php');

?>