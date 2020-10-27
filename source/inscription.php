
<html>
<head>
	<meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../css/module.css">
	<title>Inscription</title>
</head>
<body id="inscription">
     <header>
    <?php include("../source/bar-nav.php");?>
    </header>

	<?php
    include("../include/functions.php");
     $connexion = new PDO('mysql:host=localhost;dbname=livreor', 'root', '');
     
    ?>
    <main id="continscription">

        <div id="main">

                <form class="form-column d-flex justify-content-center flex-column align-items-center"  method="post">
                    <h1 id="title2">Inscrivez-vous !</h1>
                    <label for="formGroupExampleInput"><b>Login</b></label>
                    <input class="form-control col-6" type="text" name="login" required placeholder="Login"/>
                    <small class="exemplescript" class="form-text text-muted">(Exemple: Login)</small><br>
                    <label for="formGroupExampleInput"><b>Mot de passe</b></label>
                    <input class="form-control col-6" type="password" name="pass1" required placeholder="Mot de passe"/>
                    <label for="formGroupExampleInput"><b>Confirmer mot de passe</b></label>
                    <input class="form-control col-6" type="password" name="pass2" required placeholder="Confirmer votre mot de passe"/><br>
                    <input class="btn btn-light" type="submit" name="signin" required value="S'inscrire"/>

                    <?php
                    if (isset($_POST['signin'])) {
                        $user = new userpdo;
                        $user_sign = $user->register($_POST['login'], $_POST['pass1'], $_POST['pass2']);
                        
                             
                            if ($user_sign == "ok") 
                            {

                                header ("Refresh: 1;URL=connexion.php");
                            } 
                            else 
                            {
                            echo $user_sign;
                            }
                    }
                    ?>
                </form>
            </div>


        <?php
    
    ?>
</main>
 <footer class="headeri">
    <?php include("../include/footer.php");?>
    </footer>

 </body>
</html>