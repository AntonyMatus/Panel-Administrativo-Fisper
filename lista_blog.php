
<?php 
session_start();
include('config.php');

$query = "SELECT P.id, P.name, P.date, C.name AS category FROM blog P JOIN category C ON P.category_id = C.id";
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
                        <tr class="text-center">
                            <th>#ID</th>
                            <th>Nombre</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>options</th>
                            
                        </tr>
                        </thead>


                        <tbody>
                            <?php foreach($result as $dato): ?>
                        <tr class="text-center">
                            <td class="text-center"><?php echo $dato['id'] ?></td>
                            <td><?php echo $dato['name'] ?></td>
                            <td><?php echo $dato['category'] ?></td>
                            <td ><?php echo $dato['date']?></td>
                            
                            <td class="text-center">
                            <a href="<?php echo "editar_blog.php?id=" .$dato['id'] ?>"><i  class="fas fa-pencil-alt" style="color: violet;"></i></a>
                                     &nbsp; &nbsp;&nbsp;&nbsp;
                            <a onclick="delete_blog(<?php echo $dato['id'] ?>)"><i class="fas fa-trash-alt" style="color: #ec536c;"></i></a>  
                                

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

<script>
    function delete_blog(id){
            Swal.fire({
                title: "Estas seguro de eliminar este video?",
                text: "!No podrás revertir esto!!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#58db83",
                cancelButtonColor: "#ec536c",
                confirmButtonText: "Si, eliminar!",
                cancelButtonText: 'Cancelar!',
              }).then(function (result) {
                    
                    if(result.value)
                    {
                       location.href = 'delete_blog.php?id='+id;
                        Swal.fire(
                            'Eliminado!',
                            'El usuario fue eliminado.',
                            'success'
                        )
                    }
               });
        }
</script>