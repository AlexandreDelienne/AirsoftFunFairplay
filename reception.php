<?

$name=$_FILES['mon_fichier']['name'];     //Le nom original du fichier, comme sur le disque du visiteur (exemple : mon_icone.png).
$type=$_FILES['mon_fichier']['type'];     //Le type du fichier. Par exemple, cela peut être « image/png ».
$size=$_FILES['mon_fichier']['size'];     //La taille du fichier en octets.
$tmpName=$_FILES['mon_fichier']['tmp_name']; //L'adresse vers le fichier uploadé dans le répertoire temporaire.
$error=$_FILES['mon_fichier']['error'];    //Le code d'erreur, qui permet de savoir si le fichier a bien été uploadé.

if ($error>0) 
{
$erreur = "Erreur lors du transfert";
}

$extensions_valides=array('zip');
//1. strrchr renvoie l'extension avec le point (« . »).
//2. substr(chaine,1) ignore le premier caractère de chaine.
//3. strtolower met l'extension en minuscules.
$extension_upload = strtolower(  substr(  strrchr($name, '.')  ,1)  );

if ( in_array($extension_upload,$extensions_valides) )
{
//Créer un dossier 'fichiers/1/'
  mkdir('fichier/', 0777, true);
  
//Créer un identifiant difficile à deviner
  $nom = md5(uniqid(rand(), true));
  
  $nom ="{$nom}.{$extension_upload}";
  $resultat = move_uploaded_file($tmpName,$nom);
  
  if ($resultat) echo "Transfert réussi";
}


?>