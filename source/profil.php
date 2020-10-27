<!DOCTYPE html>
<html>

 <head>
    
    <link rel="stylesheet" href= "../css/module.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Trade+Winds&display=swap" rel="stylesheet">
    <title>Profil</title>
    <meta sharset="utf-8">
    </head>
 <body id="bodyprofil">
    <header>
         <?php
         include("../source/bar-nav.php");
    ?> 
    </header>

<?php
session_start();
if (isset ($_SESSION['login']) && !empty($_SESSION['login'])){
$connexion = new PDO('mysql:host=localhost;dbname=livreor', 'root', '');
$resultat = $connexion->query("SELECT * FROM `utilisateurs` WHERE login='".$_SESSION['login']."'");
$resultat2 = $resultat->fetch(PDO::FETCH_ASSOC);

?>
<main id="mainprofil">
    <section id="resultatprofil">
    <h1 class="title3">IL ME MANQUE DES ÂMES <?php echo $_SESSION['login']?></h1>
    <h1 class="title3">Même si tu changes de pseudo je te retrouverai</h1><br>
    </section>

                <div id="profilform">
                    <h1 class="title3">Modifiez votre profil</h1><br>
                    <form class="form-column d-flex justify-content-center flex-column align-items-center" method="POST" action="profil.php">
                        <label style="color: red;" for="formGroupExampleInput"><b>Nouveaux Login</b></label>
                        <input class="form-control " type="text" value="<?php echo $resultat2['login']?>" placeholder="Nouvel identifiant" name="login"></input><br>
                        <label style="color: red;" for="formGroupExampleInput"><b>Nouveau mot de passe:</b></label>
                        <input class="form-control " type="password" value="<?php echo $resultat2['password']?>" placeholder="nouveau mot de passe" name="mdp"></input><br>
                        <button type="submit" class="btn btn-light" name="Modifier">Modifier</button>
                    </form>
                </div>
<?php

if (isset($_POST['Modifier']))
{

    $login = $_POST['login'];
    $passe = password_hash($_POST["mdp"], PASSWORD_DEFAULT, array('cost' => 12));
    $requete = $connexion->prepare("UPDATE utilisateurs SET login = '$login', password = '$passe' WHERE login = '".$_SESSION['login']."'");
    $requete->execute();
    

    echo "modification effectuer";
    header("location:../source/profil.php");
}
?>
</body>
<?php
}
else {
    ?>
         <?php
    echo "<p id=\"pprofil \">Pour acceder à la page il vous faut être connecté!!</p> ";
    ?>
        <form id="profil-deco" action="index.php">
        <input type="submit" name="bouton">
       </form>

        <?php

}
?>
</main>
 <?php include("../include/footer.php");?> 
    </body>
       


</html>


