<?php
//require "./Vues/layout/header.php";
?>
<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./all.css">
    <link rel="text/javascript" href="../../script.js">
    <script type="text/javascript" src="../../script.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Reseau</title>
</head>
<?php

    function loadClass(string $class)
    {
        if (strpos($class, "Controller")) {

            require "./Controller/$class.php";
        } else {
            require "./Entity/$class.php";
        }
    }

    spl_autoload_register("loadClass");

    $postController = new PostController();
    $commentController = new CommentController();
    $userController = new UserController();
    
session_start();
    

    ?>
<body>
    <br>
    <?php

    if ($_POST) {
        //var_dump($_POST);
        $userData = [
            "username" => $_POST['username'],
            "password" => $_POST['password'],
            //"email" => $_POST['email']
        ];
        $usermanager = new UserController();
        $users = $usermanager->getAll();
        foreach ($users as $user) {
            if ($_POST["username"] === $user->getUsername() && password_verify($_POST["password"], $user->getPassword())) {
                $_SESSION["username"] = $user->getUsername();
                
                $_SESSION["password"] = $_POST["password"];
                $_SESSION["id"] = $user->getId();


                echo "<script>window.location.href= './index.php'</script>";
            }
        }
    }

    ?>
    <style>
        body {
            background-image: url("https://img.freepik.com/premium-vector/hand-painted-background-violet-orange-colours_23-2148427578.jpg?w=2000")
        }
    </style>
    <br>
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <!--<div class="col-md-9 col-lg-6 col-xl-5">
                <img src="https://thumbs.dreamstime.com/b/illustration-de-multisport-102021356.jpg" class="img-fluid" alt="Sample image">
            </div>-->
                <div style="text-align: center;">
                    <h2>Bienvenue sur le site officiel de Feucherolles Biathlon</h2><br>
                    <h5>Connetez vous avec votre nom d'utilisateur et mot de passe pour accéder au site </h5>
                    <h5>Si vous n'en avez pas encore merci de me contacter : thocel03@gmail.com</h5>
                    <br>
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form method="POST">

                        <div class="form-outline mb-4">
                            <label class="form-label" for="username">Nom d'utilisateur</label>
                            <input type="text" id="username" class="form-control form-control-lg" placeholder="Entrer votre nom d'utilisateur" name="username" />

                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-3">
                            <label class="form-label" for="password">Mot de passe</label>
                            <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Entrer votre mot de passe" />
                        </div>

                        <div class="d-flex justify-content-between align-items-center">

                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Se connecter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>