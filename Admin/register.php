<?php
    session_start();
    include('config.php');
    

    $is_admin = isset($_SESSION['role']) ? $_SESSION['role'] : 0;
    if(!$is_admin){
        $_SESSION['message'] = "Usted no tiene Permisos en esta pagina!";
        header('location: index.php');
        
    } 


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
                $_SESSION['message'] = "Ya existe un correo con ese mismo email";
                header("location: crear_usuario.php");
                exit(0);
            } else 
            {
                $user_query = 'INSERT INTO users (username, email, password, role) VALUE (?,?,?,?)';
                $user_query_run = $pdo->prepare($user_query);
                $user_query_run->execute(array($username,$email,$hash,$status));


                if($user_query_run){
                    $_SESSION['message'] = "Usuario Creado satisfactoriamente! ";
                    header("location: lista_usuarios.php");
                    exit(0);
                } else 
                {
                    $_SESSION['message'] = "Algo salio mal!";
                    header("location: crear_usuario.php");
                    exit(0);
                }
            }


        } else {
            $_SESSION['message'] = "Contraseña y confirmar contraseña no son iguales ";
            header("location: crear_usuario.php");
            exit(0);
        }
        
    } else {
        header("location: crear_usuario.php");
        exit(0);
    }


?>