
<?php 
session_start();

if(!isset($_SESSION['user_id'])){
    header('location:login.php');
    } else {
    
    }
?>

<?php 

include('config.php');

$sql_leer = 'SELECT * FROM videos';
$gsen = $pdo->prepare($sql_leer);
$gsen->execute();

$result = $gsen->fetchAll();



include('includes/header.php');
?>

<div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Lista de Vídeos</h4>
                <ol class="breadcrumb">
                    
                    
                </ol>

                <?php include('message.php'); ?>
            </div>
        </div>
</div>
<div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">

                    <a href="crear_video.php" class="btn btn-brown waves-effect waves-light float-right m-b-10 ">Crear Vídeo</a>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th width="18%">#ID</th>
                            <th width="28%">Nombre</th>
                            
                            <th width="18%">Date</th>
                            <th >options</th>
                            
                        </tr>
                        </thead>


                        <tbody>
                        <?php foreach($result as $dato): ?>
                            <tr>
                                <td><?php echo $dato['id']; ?></td>
                                <td><?php echo $dato['name']; ?></td>
                                
                                <td><?php echo $dato['date']; ?></td>
                                <td class="text-center">
                                    <a href="<?php echo "editar_video.php?id=" .$dato['id'] ?>"><i  class="fas fa-pencil-alt" style="color: violet;"></i></a>
                                     &nbsp; &nbsp;&nbsp;&nbsp;
                                    <a onclick="delete_video(<?php echo $dato['id'] ?>)" ><i class="fas fa-trash-alt" style="color: #ec536c;"></i></a>  
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
function delete_video(id){
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
                       location.href = 'delete_video.php?id='+id;
                        Swal.fire(
                            'Eliminado!',
                            'El usuario fue eliminado.',
                            'success'
                        )
                    }
               });
        }
</script>