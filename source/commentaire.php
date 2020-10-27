<?php
session_start();
date_default_timezone_set('Europe/Paris');
if (isset($_SESSION['login'])){
  if (isset ($_POST['commenter'])){
  $connexion = new PDO('mysql:host=localhost;dbname=livreor', 'root', '');
  $resultat = $connexion->query("SELECT * FROM `utilisateurs` WHERE login='".$_SESSION['login']."'")->fetchAll();
  $requete = $connexion->prepare("INSERT INTO commentaires (commentaire, id_utilisateur, date) VALUES ('".$_POST['message']."','".$resultat[0][0]."','".date("Y-m-d H:i:s")."')");
  $requete->execute();

                    header("location:../source/livre-or.php");

 	}


?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/module.css">
  <link rel="stylesheet" href="index.css" media="screen" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Trade+Winds&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<title>Page commentaires</title>
</head>
<body id="commentaire">
  <header>
  <?php
         include("../source/bar-nav.php");
  ?> 
</header>
    <main id="maincomentaire">
          <?php
          if (isset($_SESSION['login'])==true){
          ?>
           <div id="formcom">
          	   <form id="formcommentaire" action="commentaire.php" method="post">
                  <label id="titrepost" for="msg"> Poster votre message max 50 caractères :</label><br>
                  <h1 for="exampleInputEmail1">Message</h1>
                  <textarea maxlength="50" id="msg" name="message" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                  <br>
                  <button type="submit" class="btn btn-dark" id="validcomment" name="commenter">Commenter</button>
              </form>
              </div>
      
          <?php
          }
          ?>
          <?php 
          }
          else
          
            echo "Vous n'êtes pas connecté";
           ?>
          
            <img id="sorciere" src="../img/sorciere.png">
    </main>
     <?php include("../include/footer.php");?> 
  </body>
</html>