<!DOCTYPE html>
<html>
<head>
    <title>Création utilisateur</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="cache-control" content="no-cache">
    <meta http-equiv="expires" content="0"> 
    <meta http-equiv="pragma" content="no-cache">
    <!--Biblio jQuery Mobile-->
  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.css" />
  <script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
  <script src="http://code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.js"></script>
</head>
<body>
<center><img src="./img/Logo.png"></center>
</br>
<div data="page" >
    <div data-role="header">
    <h1>Création utilisateur</h1>
    </div>
    <div role="main" calss="ui-content" data-theme="b">
    <form method="post">
        <label>Nom:</label>
        <input type="text" name="nom" required><br/>
        <label>Prenom:</label>
        <input type="text" name="prenom" required><br/>
        <label>E-Mail:</label>
        <input type="email" name="email" required><br/>
        <label>Fonction:</label>
        <input type="text" name="fonction" required><br/>
        <label>Mot de passe:</label>
        <input type="password" name="psw" required><br/>
        <select name="role">
            <option value="" disabled selected>Choix rôle</option>
            <option value="1">Role 1</option>
            <option value="2">Role 2</option>
        </select>
        <button type="submit" name="action">Enregistrer</button>-
    </form>
    <?php
    //inclusion
    include_once('params/params.inc.php');
    //Connexion BDD
    $connexionSQL = new mysqli(MYHOST, MYUSER, MYPASS, "gmao");
    //test connexion
    if(!$connexionSQL){
        die("Impossible de se connecter à la base de donnée !");
    }
    if(!empty($_POST['prenom']) 
        && !empty($_POST['nom'])
        && !empty($_POST['email'])
        && !empty($_POST['fonction'])
        && !empty($_POST['psw'])
        && !empty($_POST['role'])){
            $prenom = $connexionSQL->real_escape_string($_POST['prenom']);
            $nom = $connexionSQL->real_escape_string($_POST['nom']);
            $email = $connexionSQL->real_escape_string($_POST['email']);
            $fonction = $connexionSQL->real_escape_string($_POST['fonction']);
            $psw = $connexionSQL->real_escape_string($_POST['psw']);
            $role = $connexionSQL->real_escape_string($_POST['role']);

        //Hachage du mot de passe
        //$pass_hash = password_hash($psw, PASSWORD_DEFAULT);//NOK
        $psw = hash('sha256', $psw);

        
        $requete = "INSERT INTO utilisateur(ut_prenom, ut_nom, ut_email, ut_fonction, ut_psw, ro_index) 
                    VALUES ('$prenom', '$nom', '$email', '$fonction', '$psw', '$role')";
        
        $resultats = $connexionSQL->query($requete);

        if($resultats){
            echo "Inscription reussie";
        }
        else { echo "Inscription impossible !";
        }
        
        $connexionSQL->close();


        }
    ?>
    </div>
    <div data-role="footer">
		<h1><?php echo $societe;?></h1>
    </div>
</div>
</body>
</html>


