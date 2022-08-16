


<?php 
session_start();
include('includes/header.php');
?>


<div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">Crear Usuario</h4>
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

            
            <form class="" action="register.php" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" id="username" name="username" required placeholder=" Enter a Username"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email</label>
                            <div>
                                <input type="email" id="email" name="email" class="form-control" required placeholder="Entre a Email"/>
                            </div>
                        
                        </div>
                    </div>
                
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Password</label>
                            <div>
                                <input type="password" class="form-control" required id="password" name="password"  placeholder="Enter a password"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <div>
                                <input type="password" class="form-control" required  name="conf_password"  placeholder="Enter a password"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Rol</label>
                            <div>
                                <select name="status_rol" id="status_rol" class="form-control">
                                    <option value="0">Admin</option>
                                    <option value="1">Super Admin</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group mb-0">
                    <div>
                        <button type="submit" name="register-btn" class="btn btn-primary waves-effect waves-light mr-1">
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

<?php 
include('includes/footer.php');
include('includes/scripts.php');

?>