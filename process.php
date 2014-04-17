<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
 
    // CONDITIONS NOM
    if ( (isset($_POST['nom'])) && (strlen(trim($_POST['nom'])) > 0) ):
        $nom = stripslashes(strip_tags($_POST['nom']));
    else:
        echo "Merci d'écrire un nom <br />";
        $nom = '';
    endif;
 
    // CONDITIONS SUJET
    if ( (isset($_POST['sujet'])) && (strlen(trim($_POST['sujet'])) > 0) ):
        $sujet = stripslashes(strip_tags($_POST['sujet']));
    else:
        echo "Merci d'écrire un sujet <br />";
        $sujet = '';
    endif;
  
    // CONDITIONS EMAIL
    if ( (isset($_POST['email'])) && (strlen(trim($_POST['email'])) > 0) && (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) ):
        $email = stripslashes(strip_tags($_POST['email']));
    elseif (empty($_POST['email'])):
        echo "Merci d'écrire une adresse email <br />";
        $email = '';
    else:
        echo 'Email invalide :(<br />';
        $email = '';
    endif;
  
    // CONDITIONS MESSAGE
    if ( (isset($_POST['message'])) && (strlen(trim($_POST['message'])) > 0) ):
        $message = stripslashes(strip_tags($_POST['message']));
    else:
        echo "Merci d'écrire un message<br />";
        $message = '';
    endif;
  
    // Les messages d'erreurs ci-dessus s'afficheront si Javascript est désactivé
 
 
    // PREPARATION DES DONNEES
    $ip           = $_SERVER['REMOTE_ADDR'];
    $hostname     = gethostbyaddr($_SERVER['REMOTE_ADDR']);
    $destinataire = "alexandre.delienne04@gmail.com";
    $objet        = "[Site Web] ".$sujet;
    $contenu      = "Nom de l'expéditeur : ".$nom."rn";
    $contenu     .= $message."rnn";
    $contenu     .= "Adresse IP de l'expéditeur : ".$ip."rn";
    $contenu     .= "DLSAM : ".$hostname;
  
    $headers  = 'From: '.$email." "; // ici l'expediteur du mail
    $headers .= "Content-Type: text/plain; charset="ISO-8859-1"; DelSp="Yes"; format=flowed rn";
    $headers .= "Content-Disposition: inline rn";
    $headers .= "Content-Transfer-Encoding: 7bit rn";
    $headers .= "MIME-Version: 1.0";
     
 
    // SI LES CHAMPS SONT MAL REMPLIS
    if ( (empty($nom)) && (empty($sujet)) && (empty($email)) && (!filter_var($email, FILTER_VALIDATE_EMAIL)) && (empty($message)) ):
        echo 'echec :( <br /><a href="contact.html">Retour au formulaire</a>';
    // ENCAPSULATION DES DONNEES 
    else:
        mail($destinataire,$objet,$contenu,$headers);
        echo 'Formulaire envoyé';
    endif;
 
    // Les messages d'erreurs ci-dessus s'afficheront si Javascript est désactivé
?>