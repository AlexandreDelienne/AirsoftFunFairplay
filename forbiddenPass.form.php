<?
//include "top.php";
include "parametres.php";

if(isset($_POST['submit']) and !empty($_POST['name']) and !empty($_POST['mail']))
{
	// Sécurisation des variables
	$name=mysql_real_escape_string($_POST['name']);
	$mail=mysql_real_escape_string($_POST['mail']);
	
	// Formatage de la requête
	$query="SELECT `passwordUser` FROM `users` WHERE `nomUser` = '$name' AND `mailUser` = '$mail'"; 
	$result=mysql_query($query);

	// Recuperation des resultats
	while($row=mysql_fetch_row($result))
	{
		$pass=$row[0];
	}
	
	echo $pass;
	
     $headers ='From: "Airsoft Fun & Fairplay"<adresse@fai.fr>'."\n"; 
     $headers .='Content-Type: text/html; charset="UTF-8"'."\n"; 
     $headers .='Content-Transfer-Encoding: 8bit'; 

     $message ='

                                

                                Vous avez reçu cet email depuis le site http://www.monsite.fr



                                Votre nouveau mot de passe est : '.$pass.'



                                Veuillez le noter pour éviter de l\'égarer.

        

                                Cordialement, l\'équipe de monsite.fr';; 

	if (mail($mail,'Récupération de mot de passe',$message))
	{
	header('Location: index.php');
	exit();
	}
	
	else
	{
	header('Location: camarchepas.php');
	exit();
	}

}
?>