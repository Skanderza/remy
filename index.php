<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
  <title>Connexion </title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="cache-control" content="no-cache">
  <meta http-equiv="expires" content="0"> <!--préciser une date d'expiration pour la page-->
  <meta http-equiv="pragma" content="no-cache"><!--la page ne doit pas être sauvegardée dans la cache du navigateur-->
  <!--Appel jQuery Mobile-->
  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.css" />
  <script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
  <script src="http://code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.js"></script>
</head>

<body>
<div role="page">
<div data-role="header">
<h2>Connexion</h2>
</div>
<div role="main" class="ui-content">

<center><img src="./img/Logo.png"></center>
</br>
<form method="post">
<input type="email" id="email" name="email" placeholder="E-Mail" 
value="<?php if(!empty($email))echo $email; ?>" required>
</br>
<input type="password" name="psw" id="psw" placeholder="Mot de Passe"
value="<?php if(!empty($pwd))echo $pwd; ?>" required>
</br>
<input type="submit" name="action" value="Valider">
</form>
<a style="float : right;" href="#">mot de passe oublié?</a>
</div>

<?php

//inclusion
include_once('params/params.inc.php');
//connexion BDD
$connexionSQL = new mysqli(MYHOST, MYUSER, MYPASS, "gmao");
//Test connexion
if(!$connexionSQL){
  die("Impossible de se connecter à la base de donnée !");
}
if(!empty($_POST['email']) && !empty($_POST['psw'])){
  $email = $connexionSQL->real_escape_string($_POST['email']);
  $psw = $connexionSQL->real_escape_string($_POST['psw']);

  $hpsw = hash('sha256', $psw );
  
  $requete = "SELECT ut_index, ut_prenom, ut_nom, ut_email, ut_psw, ro_index 
              FROM utilisateur WHERE ut_email = '$email' AND ut_psw = '$hpsw'";

  $resultats = $connexionSQL->query($requete);
  

  $coord = $resultats->fetch_row();
  
  
  if($coord[4] == $hpsw){
   
    $_SESSION['psw'] = $coord[4];
    $_SESSION['ut_index'] = $coord[0];
    $_SESSION['prenom'] = $coord[1];
    $_SESSION['nom'] = $coord[2];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['role'] = $coord[5];
    var_dump($_SESSION['email'] );
    
    //echo'inscription ok';
    header("Location: http://localhost:8888/gmao-upperside/test.php");exit;
  }else {
    echo "Le nom d'utilisateur ou le mot de passe est incorrect";
  }
}
$connexionSQL->close();
?>
<div data-role="footer">
		<h1><?php echo $societe;?></h1>
</div>
</div>
</body>
</html>

