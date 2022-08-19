<?php
    session_start();
    include('config.php');


    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['status_rol'];

    if(isset($_POST['change_password'])){

        $password = $_POST['password'];
        $hash_pass = password_hash($password, PASSWORD_DEFAULT);

        $sql = "UPDATE users SET `username` = :username, `email` = :email, `password` = :password, `role` = :role WHERE `id` = :id";
        $query = $pdo->prepare($sql);

        $query->bindParam(':username', $username);
        $query->bindParam(':email', $email);
        $query->bindParam(':password', $hash_pass);
        $query->bindParam(':role', $role);
        $query->bindParam(':id', $id);

        $updateUser = $query->execute();
        if($updateUser){
            $_SESSION['message'] = "El usuario ha sido Actualizado junto con su contraseña nueva!";
            header('location:lista_usuarios.php');
            exit(0);
        
        }
    } else {
        $sql = "UPDATE users SET `username` = :username, `email` = :email, `role` = :role WHERE `id` = :id";
        $query = $pdo->prepare($sql);

        $query->bindParam(':username', $username);
        $query->bindParam(':email', $email);
        $query->bindParam(':role', $role);
        $query->bindParam(':id', $id);

        $updateUser = $query->execute();
        if($updateUser){
            $_SESSION['message'] = "El usuario ha sido Actualizado!";
            header('location:lista_usuarios.php');
            exit(0);
        }
    }
?>