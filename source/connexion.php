<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/module.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <title>Connexion</title>
</head>
<body id="connexion">
     <header>
    <?php include("../source/bar-nav.php");?>
    </header>
 <main id="contconnexion">
	<?php
	session_start();
    if ( !isset($_SESSION['login']) )
    {
	    if(isset($_POST['login']) && isset($_POST['password']))
        {
   	        $connexion = mysqli_connect ("localhost", "root", "","livreor");

   	        $login = mysqli_real_escape_string($connexion,htmlspecialchars($_POST['login']));
            $password = mysqli_real_escape_string($connexion,htmlspecialchars($_POST['password']));

             if($login !== "" && $password !== "")
             {
                $requete = "SELECT count(*) FROM utilisateurs where
                login = '".$login."' ";
                $exec_requete = mysqli_query($connexion,$requete);
                $reponse  = mysqli_fetch_array($exec_requete);
                $count = $reponse['count(*)'];
                $requete4 = "SELECT * FROM utilisateurs WHERE login='".$login."'";
                $exec_requete4 = mysqli_query($connexion,$requete4);
                $reponse4 = mysqli_fetch_array($exec_requete4);
                 if( $count!=0 && password_verify($password, $reponse4['password']) )
                {
                
                $_SESSION['login'] = $_POST['login'];
                $user = $_SESSION['login'];
                $id=$_SESSION['id']=$reponse4['id'];
         
                  header('Location: index.php');
                   }
                   else
                  {
                  header('Location: connexion.php?erreur=1'); // utilisateur ou mot de passe incorrect
                   }
            }
        }
        ?>
    

                <div id="main2" class="container"> 
                    <h1 class="title">Connectez-vous !</h1>  
                    <form class="form-column d-flex justify-content-center flex-column align-items-center" name="loginform" id="loginform" action="#" method="post"> 
                    <label for="formGroupExampleInput"><b>Login</b></label>
                    <input class="form-control" type="text" id="user_login" class="input" placeholder="Votre login" value="" size="20" name="login" required/> 
                    <label for="formGroupExampleInput"><b>Mot de passe</b></label>
                    <input class="form-control" type="password" name="password" id="user_pass" class="input" placeholder="Password" value="" size="20" required/><br>
                    <input type="submit" name="submit" id="submit" class="btn btn-light" value="Connectez-vous" /><br>
                    <input type="hidden" name="redirect_to" value="#"/>
                  </form>   
         
                <?php
                if(isset($_GET['erreur'])){
                    $err = $_GET['erreur'];
                    if($err==1 || $err==2)
                        echo "<p class='erreur'><b>*Utilisateur ou mot de passe incorrect*</b></p>";
                }

                if(isset($_GET['reconnect'])){
                    $con = $_GET['reconnect'];
                    if($con==1 || $con==2)
                        echo "<p class='new'><b>*Connectez-vous avec le nouveau profil*</b></p>";
                }
                
                ?>
    
                <p>Pas encore membre ? <a style="color: white" href="inscription.php" class="btn">Inscrivez-vous gratuitement</a></p>
        
              </div>
        
                <?php
                }
                else 
                {
                ?>
                <section id="notcon">
                  <p>Vous êtes déjà connecté !!</p>
                </section>
                    <?php
                }

                
                ?>
     </main>
    
   <?php include("../include/footer.php");?>
 </body>
</html>
