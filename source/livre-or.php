<?php
session_start();
date_default_timezone_set('Europe/Paris');
?>

<html>
    <head>
       <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
       <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="../css/module.css">
        <link href="https://fonts.googleapis.com/css?family=Trade+Winds&display=swap" rel="stylesheet">
        <title>page livre d or</title>
    </head>
    <body id="livreor">
      <header>
          <?php
            include 'bar-nav.php';
            ?>  
     </header>

     <main id="maincomment">
         <a id="poster" href="commentaire.php">Cliquer pour écrire un commentaire ici!</a> 
    

      <table id="tableau">
                    <tr>
                      <th id="tablecomment">Nom:</th>
                      <th id="tablecomment">Commentaires:</th>
                      <th id="tablecomment">Date:</th>
                   </tr>
            <?php
                $connexion = mysqli_connect("localhost","root","","livreor");
                $requete3="SELECT login, commentaire,date FROM utilisateurs LEFT JOIN commentaires ON utilisateurs.id = commentaires.id_utilisateur ORDER BY commentaires.id DESC";
                $query3=mysqli_query($connexion, $requete3);
                $data4 = mysqli_fetch_all($query3,MYSQLI_ASSOC);
                $taille = sizeof($data4);

                  $i = 0;
                    while($i < $taille)
                  {
                    $dateold= $data4[$i]['date'];
                    $datenew = date('d/m/Y à H:i:s',strtotime($dateold));
             ?>
                      <tr>
                      <td class= "comment">Par:&nbsp;<?php echo $data4[$i]['login']?></td>
                      <td class="comment"><?php echo $data4[$i]['commentaire']?></td>
                      <td class="comment">Posté le:&nbsp;<?php echo $datenew?></td>
                    </tr>
            <?php
              $i++;
                  }
            ?>
      </table>
      </main>
  </body>
</html>
