<?php
require_once ('template.php');

class SignupView extends template{
 

    public function index(){

       $this->main();
         /**afficher les informations du contact */
       $this->show_signUpForm();


    }
    
   
    public function show_signUpForm()
    {
       $signCntr = new SignupController();
        ?>
        <link rel="stylesheet" type="text/css" href="styles/signup.css">
        
        <div id="signupContainer">
        <h2>Sign Up</h2>
        <div id="userexist" hidden> Essayez avec une autre adresse mail ! </div>
        <!-- Formulaire d'inscription -->
        <form id="signupForm" action='' method="post">
            <!-- Champs d'inscription (e.g., nom, prénom, sexe, date de naissance, password) -->
           
            <label for="firstName">Nom :</label>
            <input type="text" id="firstName" name="firstName" required>

            <label for="lastName">Prenom :</label>
            <input type="text" id="lastName" name="lastName" required>
            
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>
            

            <label for="gender">Sexe :</label>
            <select id="gender" name="gender" required>
                <option value="M">Homme</option>
                <option value="F">Femme</option>
            </select>

            <label for="dob">Date De Naissance:</label>
            <input type="date" id="dob" name="dob" required>

            <label for="signupPassword">Mot de passe:</label>
            <input type="password" id="signupPassword" name="signupPassword" required>

            <label for="confirm_password">Confirmez votre mot de Passe:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
    </br>
            <!--button type="button" onclick="showLoginForm()">S'inscrire</button-->
            <button type="submit">S'inscrire</button>
            <div class="pas-encore">Avez-vous déja un compte? <a href="/Tidjelabine/SignIn">Connectez-vous ici!</a></div>
        </form>
    </div>





        <?php
        if($_SERVER['REQUEST_METHOD'] == "POST"){//traitement formulaire d'inscription
            
            $firstName=$_POST['firstName'];
            $lasName=$_POST['lastName'];
            $sexe=$_POST['gender'];
            $ddn=$_POST['dob'];
            $psw=$_POST['signupPassword'];
            //$hashedPassword = password_hash($psw, PASSWORD_DEFAULT);//inserer le haché du mot de passe mais pas le pzsswd dans la bdd
            $email=$_POST['email'];
               //verifier si l'email n'existe pas deja par appel a la mthode du controller qui appelle celle de model
            $emailExists=$signCntr->checkUser_byEmail($email);
            if ($emailExists){

                echo '<script>document.getElementById("userexist").hidden = false;</script>';

            }else{//insertion dans la bdd inscription réussie!
                $signCntr->insertUser($firstName,$lasName,$email,$sexe,$ddn,$psw);
                echo"<script type='text/javascript'>location.href = '/Tidjelabine/SignIn';</script>";
    
            }
           
             

        }

    }

}
?>
