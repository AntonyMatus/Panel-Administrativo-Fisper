
<?php 
session_start();

$is_admin = isset($_SESSION['role']) ? $_SESSION['role'] : 0;
if(!$is_admin){
    $_SESSION['message'] = "Usted no tiene Permisos en esta pagina!";
    header('location:index.php');
    exit(0);
    
} 

include('config.php');

$sql_leer = 'SELECT * FROM users';
$gsen = $pdo->prepare($sql_leer);
$gsen->execute();

$result = $gsen->fetchAll();

?>


<?php 

include('includes/header.php');
?>


    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Lista de Usuarios</h4>
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

                    <a href="crear_usuario.php" class="btn btn-brown waves-effect waves-light float-right m-b-10 ">Crear Usuario</a>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Usermane</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>options</th>
                            
                        </tr>
                        </thead>


                        <tbody>
                            <?php foreach($result as $dato): ?>
                        <tr>
                            <td><?php echo $dato['id'] ?></td>
                            <td><?php echo $dato['username'] ?></td>
                            <td><?php echo $dato['email'] ?></td>
                            <td class="text-center"><?php if($dato['role'] == 1){ echo '<span class="badge badge-pill badge-success">Super Admin</span>'; }else {
                                echo '<span class="badge badge-pill badge-info">Admin</span>';
                            }; ?></td>
                            
                            <td>
                            <a href="<?php echo "editar_usuario.php?id=" .$dato['id'] ?>"><i  class="fas fa-pencil-alt" style="color: violet;"></i></a>
                                     &nbsp; &nbsp;&nbsp;&nbsp;
                            <a onclick="delete_user(<?php echo $dato['id'] ?>)"><i class="fas fa-trash-alt" style="color: #ec536c;"></i></a>  
                                

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
    function delete_user(id){
        Swal.fire({
                title: "Estas seguro de eliminar este Usuario?",
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
                       location.href = 'delete_users.php?id='+id;
                        Swal.fire(
                            'Eliminado!',
                            'El usuario fue eliminado.',
                            'success'
                        )
                    }
               });
    }
</script>