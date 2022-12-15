<?php
require "./Vues/layout/header.php";

if ($_POST) {
    //var_dump($_POST);
    if ($_POST["password"] === $_POST["confirm"]) {
        array_pop($_POST);
        $_POST["password"] = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $user = new User($_POST);
        $userController->add($user);
        $_SESSION["username"] = $user->getUsername();
        $_SESSION["password"] = $user->getPassword();
        $_SESSION["id"] = $user->getId();
        echo "<script>window.location.href = './index.php'</script>";
    } else {
        echo "Les mots de passe ne correspondent pas.";
    }
}

?>
<style>body{background-image: url("https://img.freepik.com/premium-vector/hand-painted-background-violet-orange-colours_23-2148427578.jpg?w=2000")}</style>
<br>
<section class="vh-100" >
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="background: hsla(0, 0%, 100%, 0.55);backdrop-filter: blur(30px);" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                                <form class="mx-1 mx-md-4" method="post" autocomplete="off">

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="text" name="username" id="username" class="form-control" />
                                            <label class="form-label" for="username">Your Name</label>
                                        </div>
                                    </div>

                                   

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="password" name="password" id="password" class="form-control" />
                                            <label class="form-label" for="password">Password</label>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="password" name="confirm" id="confirm" class="form-control" />
                                            <label class="form-label" for="confirm">Repeat your password</label>
                                        </div>
                                    </div>

                                    <div class="form-check d-flex justify-content-center mb-5">
                                        <input class="form-check-input me-2" type="checkbox" value="" id="terms" />
                                        <label class="form-check-label" for="terms">
                                            I agree all statements in <a href="./terms.html">Terms of service</a>
                                        </label>
                                    </div>

                                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                        <button type="submit" class="btn btn-primary btn-lg">Register</button>
                                    </div>

                                </form>

                            </div>
                            <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                <img src="https://thumbs.dreamstime.com/b/illustration-de-multisport-102021356.jpg" class="img-fluid" alt="Sample image">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


