<?php
/*
 * Author : Maximilien D
 * Licence : CC BY-NC-SA
 * Description : Formulaire de contact - form.php
 */

    // On inclus le code fourni par google pour faire fonctionner le captcha
    require_once('recaptchalib.php');
    $privatekey="VOTRE-CLEF-PRIVEE";
    $resp=recaptcha_check_answer($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

  // Vérification du captcha,
  if (!$resp->is_valid) {
      header('Location: http://www.monsiteweb.org/erreurdecaptcha');
      exit();
  }
  else {

	/* Cas où il a correctement été entré
	 * - Dans ce cas on envoie un mail avec la fonction au même nom.  * Les donnés du formulaire ($_POST) sont inséré dans un message brut prédéfini.
	 * Mais on peut les récuperer autrement ou les insérer autrement (BDD, mail en html...)
	 * 
	 * - avec message .= "chaine" on concatène "chaine" à la variable message
	 * htmlspecialchars() permet de transformer les caractère spéciaux types ('<','\', ...) en caractères non interprétables.
	 * Ceci nous permet de sécuriser les données qui sont envoyées .
	 */

        $to = "maximilien.douchet@gmail.com";
        $subject = "Formulaire Contact - maximiliend.fr";
        $message = "Un message a été envoyé à partir de votre site web.\n     > Nom de l'expediteur : ".htmlspecialchars($_POST['pseudo'])."\n";
		if ($_POST['mail']!="") {
			$message .= "     > Son mail : ".htmlspecialchars($_POST['mail'])."\n";
		}
		$message .="     > Sujet : ".htmlspecialchars($_POST['sujet'])."\n     > Satut : ".htmlspecialchars($_POST['statut'])."\n     > Requète :\n\n   ".htmlspecialchars($_POST['commentaire'])."\n\n";
		$message .="\n Pour d'éventuelles mises à jour, ou améliorations du code consultez ::";
        if (mail($to, $subject, $message)) {
        //Puis on renvoie sur monsiteweb.org, if permet de tester si mail() à bien fonctioné (ceci ne garanti pas que le mail sera recu, mais c'est un début)
        header('Location: http://www.monsiteweb.org/messageenvoyé');
        //Puis on termine le script
        exit();
        }
        else {
        // Si il y a erreur on renvoie sur le site
        header('Location: http://www.monsiteweb.org/erreurfonctionmail');
        exit();
        }
  }
?>
