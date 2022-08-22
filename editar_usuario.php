<?php 
session_start();

$is_admin = isset($_SESSION['role']) ? $_SESSION['role'] : 0;
if(!$is_admin){
    $_SESSION['message'] = "Usted no tiene Permisos en esta pagina!";
    header('location: index.php');
    
} 

if(!isset($_GET['id'])) exit();
$id = $_GET['id'];

include('config.php');



$sql = $pdo->prepare("SELECT * FROM users WHERE id= ?;");
$sql->execute([$id]);
$user = $sql->fetch(PDO::FETCH_OBJ);

if($user === FALSE){

    $_SESSION['message'] = "No existe algun usuario con ese ID";
    exit(0);

}

?>

<?php 
include('includes/header.php');
?>

<div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Editar Usuario</h4>
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

            
            <form class="" action="edit_user.php" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="hidden" class="form-control" name="id" value="<?php echo $user->id ?>">
                            <input type="text" class="form-control"  name="username" required value="<?php echo $user->username ?>"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email</label>
                            <div>
                                <input type="email" id="email" name="email" class="form-control" value="<?php echo $user->email ?>"/>
                            </div>
                        
                        </div>
                    </div>
                
                    <div id="password" class="col-md-6" >
                        <div class="form-group">
                            <label>Password</label>
                            <div>
                                <input  type="password" class="form-control" required  name="password"  value="<?php echo $user->password ?>"/>
                            </div>
                        </div>
                    </div>
                   
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Rol</label>
                            <div>
                                <select name="status_rol" id="status_rol" class="form-control">
                                    
                                    <option <?php if($user->role == 0):  ?> selected <?php endif ?> value="0">Admin</option>
                                    <option <?php if($user->role == 1):  ?> selected <?php endif ?>  value="1">Super Admin</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 form-check">
                        
                    <input type="checkbox" class="form-check-input" id="change_password" name="change_password" onclick="cambiar_password()" >
                    <label class="form-check-label font-16" for="exampleCheck1">Cambiar contraseña</label>
                       
                    </div>
                </div>
                
                <div class="form-group mb-0">
                    <div>
                        <button type="submit" name="edit-btn" class="btn btn-primary waves-effect waves-light mr-1">
                            Submit
                        </button>
                        <a  class="btn btn-secondary waves-effect" href="lista_usuarios.php">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>

                </div>
            </div>
        </div>
    </div>
    <script>
        function cambiar_password(){
            $password = document.getElementById('password');
            $checkbox = document.getElementById('change_password');
            if($checkbox.checked){
                $password.style.display="block";
            }else {
                $password.style.display="none";
            }
        }
    </script>
 <?= 
 include('includes/footer.php');
include('includes/scripts.php');

?>