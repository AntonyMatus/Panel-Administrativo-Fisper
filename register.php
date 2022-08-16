<?php
    session_start();
    include('config.php');
    
    if(isset($_POST['register-btn'])){
        $username = mysqli_real_escape_string($connection, $_POST['username']);
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);
        $conf_password = mysqli_real_escape_string($connection, $_POST['conf_password']);
        $status = mysqli_real_escape_string($connection, $_POST['status_rol']);

        if($password == $conf_password){

            //Check Email
            $checkemail = "SELECT email FROM users WHERE email='$email'";
            $checkemail_run = mysqli_query($connection, $checkemail);

            if(mysqli_num_rows($checkemail_run) > 0){
                //Already Email Exists
                $_SESSION['message'] = "Already Email Exists";
                header("location: crear_usuario.php");
                exit(0);
            } else 
            {
                $user_query = "INSERT INTO users (username, email, password, role) VALUE ('$username', '$email', '$password', '$status')";
                $user_query_run = mysqli_query($connection, $user_query);

                if($user_query_run){
                    $_SESSION['message'] = "Registered Successfully ";
                    header("location: lista_usuarios.php");
                    exit(0);
                } else 
                {
                    $_SESSION['message'] = "Something When Wrong";
                    header("location: crear_usuario.php");
                    exit(0);
                }
            }


        } else {
            $_SESSION['message'] = "Password and Confirm Password does not Match";
            header("location: crear_usuario.php");
            exit(0);
        }
        
    } else {
        header("location: crear_usuario.php");
        exit(0);
    }


?>