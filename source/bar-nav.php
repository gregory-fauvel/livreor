
  <?php
    if (isset($_SESSION['login'])==false)
    {
    ?>
  <ul class="nav justify-content-end  bg- text-white flex-sm-row">
    <li class="nav-item"><a class="nav-link text-white active" href="index.php">Home</a></li>
    <li class="nav-item"><a class="nav-link text-white active" href="livre-or.php">Livre d'or</a></li>
    <li class="nav-item"><a class="nav-link text-white active" href="connexion.php">Connexion</a></li>
    <li class="nav-item"><a class="nav-link text-white active" href="inscription.php">Inscription</a></li>
  </ul>


  
     <?php
    }
     
    else
    {   
    ?>
      <ul class="nav justify-content-end  text-white flex-sm-row">
        <li class="nav-item"><a class="nav-link text-white active" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link text-white active" href="profil.php">Profil</a></li>
        <li class="nav-item"><a class="nav-link text-white active" href="livreor.php">Livre d'or</a></li>
        <li class="nav-item"><a class="nav-link text-white active" href="index.php?deconnexion=true">Déconnexion</a></li>
      </ul>
     <?php
                
                if(isset($_GET['deconnexion']))
                { 
                   if($_GET['deconnexion']==true)
                   {  
                          session_destroy();
                          header('Location: index.php');
                   }
                }
    
    }
      
  
             
    ?>