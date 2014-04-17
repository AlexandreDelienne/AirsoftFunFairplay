<?

$TO = "alexandre.delienne04@gmail.com";

$h  = "From: " . $TO;

$message = "";

while (list($key, $val) = each($_POST)) {
  $message .= "$key : $val\n";
}

mail($TO, $subject, $message, $h);

Header("Location: http://<URL de la page de remerciement>");


?>

	<form method="POST" action="formmail.php" >
		
		<input type="hidden" name="subject" value="formmail">
		
		<table>
			
			<tr><td>Votre Nom :</td>
				<td><input type="text" name="realname" size=30></td></tr>

			<tr><td>Votre Email :</td>
				<td><input type="text" name="email" size=30></td></tr>

			<tr><td>Sujet :</td>
				<td><input type="text" name="title" size=30></td></tr>

			<tr><td colspan=2>Message :<br>
				<textarea COLS=50 ROWS=6 name="comments"></textarea>
			</td></tr>
		
		</table>

		<br> <input type="submit" value="Envoyer"> -
			 <input type="reset" value="Annuler">
	</form>