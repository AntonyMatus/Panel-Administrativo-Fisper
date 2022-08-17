<?php
    session_start();
    include('config.php');
    
    if(isset($_POST['register-btn'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $conf_password = $_POST['conf_password'];
        $status = $_POST['status_rol'];

        if($password == $conf_password){


            $hash = password_hash($password, PASSWORD_DEFAULT);
            //Check Email
            $sql_checkemail = "SELECT email FROM users WHERE email='$email'";
            $checkemail_run = $pdo->prepare($sql_checkemail);

            if( $checkemail_run == false){
                //Already Email Exists
                $_SESSION['message'] = "Already Email Exists";
                header("location: crear_usuario.php");
                exit(0);
            } else 
            {
                $user_query = 'INSERT INTO users (username, email, password, role) VALUE (?,?,?,?)';
                $user_query_run = $pdo->prepare($user_query);
                $user_query_run->execute(array($username,$email,$hash,$status));


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