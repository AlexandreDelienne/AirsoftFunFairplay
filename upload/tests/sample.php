<?php
// Chargement de la classe
require_once('../upload.class.php');

/**
 * Fonction utilitaire pour présenter un tableau PHP dans une page web.
 *
 * @param array $array
 */
function pArray($array) {
	print '<pre style="background:#faebd7">';
	print_r($array);
	print '</pre>';
}


// Instanciation d'un nouvel objet "upload"
$Upload = new Upload();


// GESTION DES UPLOADS APRES SOUMISSION DU FORMULAIRE
if (!Empty($_POST['submit'])) {
    
    // Pour forcer l'analyse des entêtes via PHP et non le navigateur :
    // CST_UPL_HEADER_BROWSER  => utilisation des entêtes envoyés par le navigateur,
    // CST_UPL_HEADER_MIMETYPE => utilisation de la librairie "mime_magic",
    // CST_UPL_HEADER_FILEINFO => utilisation de la librairie "fileinfo"
    //$Upload->phpDetectMimeType = Upload::CST_UPL_HEADER_BROWSER;
    
    // Pour renommer un fichier...
    //$Upload->Filename = 'nouveau_nom';
    
    // Pour ajouter un préfixe au nom du fichier...
    //$Upload->Prefixe = 'pre_';
    
    // Pour ajouter un suffixe au nom du fichier...
    //$Upload->Suffixe = '_suf';
    
    // Pour changer le mode d'écriture (CST_UPL_WRITE_ERASE, CST_UPL_WRITE_COPY, CST_UPL_WRITE_IGNORE)
    //$Upload->WriteMode = self::CST_UPL_WRITE_ERASE;
    
    // Pour filtrer les documents par extension
    //$Upload->Extension = '.gif;.jpg;.jpeg;.bmp;.png';
    
    // Pour filtrer les documents par entête de fichier (CST_UPL_HEADER_BROWSER, CST_UPL_HEADER_MIMETYPE, CST_UPL_HEADER_FILEINFO)
    //$Upload->$phpDetectMimeType = Upload::CST_UPL_HEADER_BROWSER;
    //$Upload->MimeType = 'image/gif;image/pjpeg;image/bmp;image/x-png'; 
    
    // Pour tester les dimensions maxi/mini d'une image.
    //$Upload->ImgMaxHeight = 200;
    //$Upload->ImgMaxWidth  = 200;
    //$Upload->ImgMinHeight = 100;
    //$Upload->ImgMinWidth  = 100;
    
    // Ou plus simplement :
    //$Upload->SetImgDim(200, 100, 200, 100);
    
    // Pour générer une erreur si les champs sont obligatoires
    //$Upload->Required = true;
    
    // Définition du répertoire de destination (chemin absolu ou relatif)
    //$Upload-> DirUpload = './docs/';
    
    // Pour modifier un message d'erreur sur l'échec d'une upload.
    //$Upload->setErrorMsg(Upload::CST_UPL_ERR_WRONG_EXTENSION, 'Extension interdite pour le document %%FILENAME%.');
    
    // Lance et teste le bon déroulement d'une upload.
    if (!$Upload->Execute()) {
        print 'Il y a eu une erreur :'; 
        pArray($Upload-> GetError());
        print '<a href="sample.php">Retourner au formulaire</a>';
        exit;
    }
    
    print 'Upload effectuée avec succès :';
    pArray($Upload-> GetSummary());
    print '<a href="sample.php">Retourner au formulaire</a>';
    exit;
}



// GESTION DU FORMULAIRE D'UPLOAD

// Pour limiter la taille d'un fichier (exprimée en ko)
$Upload->MaxFilesize = 1024;

// Pour ajouter des attributs aux champs de type file
$Upload->FieldOptions = 'style="border:1px solid black"';

// Pour indiquer le nombre de champs souhaités
$Upload->Fields = 2;

// Initialisation du formulaire
$Upload->InitForm();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Utilisation de la classe UPLOAD</title>
</head>

<body>

<form method="post" enctype="multipart/form-data" name="formulaire" action="sample.php">
  <?php
  // Affichage du champ MAX_FILE_SIZE
  print $Upload->Field[0];
  
  // Affichage du premier champ de type FILE
  print $Upload->Field[1] . '<br/>';
  
  // Affichage du second champ de type FILE
  print $Upload->Field[2];
  ?>
  <br/>
  <input type="submit" value="Envoyer" name="submit"/>
</form>

</body>
</html>