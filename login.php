<?php
    include('config.php');
    session_start();
    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['userpassword'];

        $query = $pdo->prepare("SELECT * FROM users WHERE username=:username");
        $query->bindParam('username', $username, PDO::PARAM_STR);
        $query->execute();


        $result = $query->fetch(PDO::FETCH_ASSOC);
        

        if(!$result){
            $_SESSION['message']= "Username password combination is wrong!";
        } else {
            if(password_verify($password, $result['password'])){
                $_SESSION['user_id'] = $result['username'];
                header('location:index.php');
            } else {
                $_SESSION['message']="Username password combination is wrong!";
            }
        }
    }
    
?>


<?php

include_once ('includes/header_login.php');

?>

<div class="card">
        <div class="card-body">
            <?php include('message.php') ?>
            <h3 class="text-center m-0">
                <a  class="logo logo-admin"><img src="assets/images/logo.svg" height="30" alt="logo"></a>
            </h3>

            <div class="p-3">
                <h4 class="text-muted font-18 m-b-5 text-center">Welcome Back !</h4>
                <p class="text-muted text-center">Sign in to continue to Fisper.</p>

                <form class="form-horizontal m-t-30" action="" method="POST">

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
                    </div>

                    <div class="form-group">
                        <label for="userpassword">Password</label>
                        <input type="password" class="form-control" id="userpassword" name="userpassword" placeholder="Enter password" required>
                    </div>

                    <div class="form-group row m-t-20">
                        <div class="col-6">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customControlInline">
                                <label class="custom-control-label" for="customControlInline">Remember me</label>
                            </div>
                        </div>
                        <div class="col-6 text-right">
                            <button class="btn btn-primary w-md waves-effect waves-light" type="submit" name="login">Log In</button>
                        </div>
                    </div>

                    <div class="form-group m-t-10 mb-0 row">
                        <div class="col-12 m-t-20">
                            <a href="pages-recoverpw.html" class="text-muted"><i class="mdi mdi-lock"></i> Forgot your password?</a>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

<?php

include_once ('includes/footer_login.php');
include_once ('includes/scripts.php');
?>