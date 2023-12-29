<?php
require_once ('template.php');

class SigninView extends template{
 

    public function index(){

       $this->main();
         /**afficher les informations du contact */
       $this->show_signinForm();


    }
    
   
    public function show_signinForm()
    {
        $signIncntr=new SignInController();
        ?>
        <link rel="stylesheet" type="text/css" href="styles/signin.css">
        <div id="signinContainer">
            <h2>Sign In</h2>
            <div id="wrong" hidden>Email ou Mot de passe incorrecte !</div>
            <!-- Formulaire d'authentification -->
            <form id="signinForm" action='' method="post">
            
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required>

                <label for="signinPassword">Mot de passe :</label>
                <input type="password" id="signinPassword" name="signinPassword" required>
                
                <!-- Bouton de soumission du formulaire -->
                <button type="submit">Se Connecter</button>
            
                <!-- Lien pour les utilisateurs non inscrits -->
                <div class="pas-encore">Vous n'avez pas de compte? <a href="/Tidjelabine/SignUp">Inscrivez-vous ici!</a></div>
            </form>
        </div>

        <?php
         if($_SERVER['REQUEST_METHOD'] == "POST"){//traiement formulaire d'authentification
            
            $email=$_POST['email'];
            $signinPassword=$_POST['signinPassword'];
           
            $userExists=$signIncntr->login($email,$signinPassword);//appeler la fct de cnx du controller
              
            if ($userExists){//cnx réussie du user
                $_SESSION["loggedIn"]=true;
                $_SESSION["email"]=$email;
                
                $_SESSION["user"]=$signIncntr->getUserIDbyEmail($email);
                
                $_SESSION["role"]="user";//dans le cas d'un utilisateur normal non admin
                echo"<script type='text/javascript'>location.href = '/Tidjelabine/';</script>";
                

            }else{//informations de cnx incorectes!
                
                echo '<script>document.getElementById("wrong").hidden = false;</script>';
    
            }
           
             

        }

    
    }
}
?>
