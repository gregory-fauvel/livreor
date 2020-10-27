<?php

session_start();


// PARTIE UTILISATEURS

class userpdo
{

    private $id     = '';
    public  $login  = '';
    public  $pass1  = '';
    public  $pass2  = '';
   


    function connectdb()
    {

        $base = new PDO('mysql:host=localhost;dbname=livreor', 'root', '');
        return $base;
    }

    public function register($login, $pass1, $pass2)
    {
        
        $user = $this->connectdb()->query("SELECT *FROM utilisateurs WHERE login='$login'");
        $etat = $user->rowCount();
        

        if ($pass1 != $pass2 || strlen($pass1) < 5)
        {
            if ($pass1 != $pass2)
            {
                $msg = "Mots de passes rentrés différents";
                
            }
            if (strlen($pass1) < 5)
            {
                $msg = "Mot de passe trop court";
            }

        }
        else
        {
            if ($etat == 0)
            {
                
                $hash = password_hash($pass1, PASSWORD_BCRYPT, ['cost' => 12]);
                $requser = $this->connectdb()->query("INSERT INTO utilisateurs VALUES(NULL, '$login','$hash')");
                
                $msg = "ok";
            }
            else
            {
                $msg = "login déjà existant";
            }
        }

        return $msg;
    }


    public function connect($login, $pass1)
    {
        $user = $this->connectdb()->query("SELECT *FROM utilisateurs WHERE login='$login'");
        $donnees = $user->fetch();

        if (password_verify($pass1, $donnees['password']))
        {
            $this->id = $donnees['id'];
            $this->login = $login;
            $this->pass1 = $donnees['pass1'];
          
            $_SESSION['login'] = $login;
            $_SESSION['pass1'] = $pass1;
            $msg = "ok";
        }
        else
        {
            $msg = "Login ou mot de passe incorrect";
        }

        return $msg;
    }

    public function disconnect()
    {
        session_destroy();
        header('location: index.php');
    }

    public function delete()
    {
        if (isset($_SESSION['login']))
        {
            include('connect.php');
            $login = $_SESSION['login'];
            $del = $this->connectdb()->query("DELETE FROM utilisateurs WHERE login='$login'");
            session_destroy();
        }

    }

    public function update($login, $pass1)
    {


        $log = $_POST['login'];
        $log2 = $_SESSION['login'];
        

       
            $user = $this->connectdb()->query("SELECT *FROM utilisateurs WHERE login='$log2'");

            $etat = $user->rowCount();
        
            
            if ($etat > 0)
            {
                $msg = "erreur";
            }
        
            if (strlen($pass1) >= 5 &&  $etat == 1)
            {
                
                $verif= $this->connectdb()->query("SELECT login FROM utilisateurs WHERE login='$log'");
                $verif2 = $verif->rowCount();
                

                if ($verif2 == 0)
                {

                

                
                $hash= password_hash($_POST["pass"], PASSWORD_DEFAULT, array('cost' => 12));
                $update = $this->connectdb()->query("UPDATE utilisateurs SET login='$login', password='$hash' WHERE login='$log2'");
                var_dump($update);

                $this->login = $log;
                $this->password = $pass1;
            
                echo "Le changement a bien été effectué!";

                session_unset();
                header('location:index.php');

                }

                else
                {
                    echo "Le login est déjà existant";
                }

                

                
            }
            else
            {
                $msg = "erreur2";
            }

        
        return $msg;
    }


    /**
     * @return array|string
     */
    public function getAllInfos()
    {
        if (isset($_SESSION['login']))
        {
            $tab = [];
            $login = $_SESSION['login'];
            $infos = $this->connectdb()->query("SELECT *FROM utilisateurs WHERE login='$login'");

            while ($parameter = $infos->fetch())
            {
                array_push($tab, $parameter);
            }


            return $tab;
        }
        else
        {

            return "Aucun utilisateur n'est connecté";
        }
    }

    public function refresh()
    {


        $login = $_SESSION['login'];
        $queryuser = $this->connectdb()->query("SELECT * FROM utilisateurs WHERE login='$login'");
        $donnees = $queryuser->fetch();

        $this->id = $donnees['id'];
        $this->login = $donnees['login'];
        $this->pass1 = $donnees['pass1'];


    }


}