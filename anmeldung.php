<?php session_start(); ?>

<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="utf-8" />
	<title>Anmeldung AK Grundschule 2014 – Erfolgreich angemeldet</title>
	
	<!-- Uni-Form -->
	<link rel="stylesheet" href="css/uni-form.css" />
	<link rel="stylesheet" href="css/default.uni-form.css" />	
	
	<link rel="stylesheet" href="css/style.css" />
	
	<!-- jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script src="js/uni-form-validation.jquery.min.js"></script>
	<script src="js/de.js"></script>
	
	
	
	<script src="js/script.js"></script>
		
</head>

<body>

<header id="branding">
	<hgroup>
		<h1><a href="http://didaktik-der-mathematik.de/ak/gs/">Arbeitskreis Grundschule</a></h1>
		<h2><a href="http://didaktik-der-mathematik.de/">Gesellschaft für Didaktik der Mathematik</a></h2>
	</hgroup>
	
	<nav>
	<ul>
	<li><a href="#infos">Informationen zur Anmeldung →</a></li>
	<li><a href="angemeldete.php">Liste der angemeldeten Teilnehmer →</a></li>
	</ul>
	</nav>	
	
</header>
	
<section id="maincontent">
		<?php
				
		include_once $_SERVER['DOCUMENT_ROOT'] . '/ak/gs/anmeldung/securimage/securimage.php';
		
		
		$securimage = new Securimage();
		
		if ($securimage->check($_POST['captcha_code']) == false) {
		  // the code was incorrect
		  // you should handle the error so that the form processor doesn't continue
		
		  // or you can use the following code if there is no validation or you do not know how
		  echo "
		  <header>
		  <div class=\"header\">
		    <h2>Ihre Anmeldung ist fehlgeschlagen</h2>
		  </div>
		  </header>
		  
		  <p class=\"uniForm\">
		  ";
		  
		  echo "Sie haben einen ungültigen Sicherheitscode eingegeben.<br /><br />";
		  echo "Bitte gehen Sie <a href='javascript:history.go(-1)'>zurück</a> und versuchen Sie es erneut.";
		  exit;
		}
		
		else {

			$dz = fopen("anmeldungen.csv","a");
				if(!$dz)
					{
						echo "
						<header>
						<div class=\"header\">
						  <h2>Ihre Anmeldung ist fehlgeschlagen</h2>
						</div>
						</header>
						
						<p class=\"uniForm\">
						";
						echo "Datei konnte nicht zum Schreiben geöffnet werden. Wenden Sie sich bitte an H. Gasteiger.";
					exit;
					}
			fwrite($dz,utf8_decode($_POST["anrede"].";".$_POST["titel"].";".$_POST["nachname"].";".$_POST["vorname"].";".$_POST["email"].";".$_POST["einrichtung"].";".$_POST["strasse"].";".$_POST["ort"].";".$_POST["plz"].";".$_POST["teilnahme"].";".$_POST["anreise"].";".$_POST["abreise"].";".$_POST["zimmer"].";".$_POST["zimmerpartner"].";".$_POST["oeffentlich"].";\n"));
			
			if ($_POST["ausgebucht"] == "true") // Nur noch Warteliste frei
			{	echo "
				<header>
				<div class=\"header\">
				  <h2>Ihre Anmeldung war erfolgreich, aber Sie wurden auf die Warteliste gesetzt.</h2>
				</div>
				</header>
				
				<p class=\"uniForm\">
				";
			}
			else
			{	echo "
				<header>
				<div class=\"header\">
				  <h2>Ihre Anmeldung war erfolgreich</h2>
				</div>
				</header>
				
				<p class=\"uniForm\">
				";
			}
			
			echo "Vielen Dank für Ihre Anmeldung. Sie erhalten in Kürze eine E-Mail. <img src=\"img/ok.png\" title=\"Erfolgreich\" alt=\"OK\" />";
			
			fclose($dz);



			$names = fopen("angemeldete.csv","a");
				if(!$names)
					{
						echo "
						<header>
						<div class=\"header\">
						  <h2>Ihre Anmeldung ist fehlgeschlagen</h2>
						</div>
						</header>
						
						<p class=\"uniForm\">
						";
						echo "Datei konnte nicht zum Schreiben geöffnet werden. Wenden Sie sich bitte an H. Gasteiger.";
					exit;
					}
			
				if(($_POST["oeffentlich"] == true) and ($_POST["teilnahme"] != "Nein"))
					{		
						fwrite($names,utf8_decode($_POST["nachname"].", ".$_POST["vorname"]."\n"));
					}
				fclose($names);
			
			
			
			require("class.phpmailer.php");
			
			//Bestätigungs E-Mail
		
		
			if($_POST["anrede"] == "Frau") { 
				$anrede = "Sehr geehrte Frau";
			 };
		
			if($_POST["anrede"] == "Herr") {
				$anrede = "Sehr geehrter Herr";
			};			
		
		
			$titel = $_POST["titel"];
					
			$empfaenger = $_POST["vorname"]." ".$_POST["nachname"];
		
			$empfaengerMail = $_POST["email"];
		
			$mail = new PHPMailer();
								
			$mail->From     = "ak-gs-gdm@ph-karlsruhe.de";			
			$mail->FromName = "AK Grundschule";			
			$mail->Mailer   = "mail";			
			$mail->CharSet = 'utf-8';			
			$mail->SetLanguage ("de");			
			$mail->isHTML(true);			
			$mail->AddAddress($empfaengerMail, $empfaenger);			
			
			
			if ($_POST["teilnahme"] == "Nein")
			{
				$mail->Subject = "Anmeldung Herbsttagung AK Grundschule 2014";	
				$mail->Body = "
				<html>
				<head>
				<title>AK Grundschule 2014 </title> 
			
				</head>
				<body>
				<p>$anrede $titel $empfaenger, <br /> <br />
				vielen Dank für Ihr Interesse am Arbeitskreis Grundschule. <br />
				Wir behalten Sie in unserem Verteiler. <br />

				<br />
				Viele Grüße <br />
				AK Grundschule</p>
				</body>
				</html>
				";						
			}
			else if ($_POST["ausgebucht"] == "true") // Nur noch Warteliste frei
			{			
				$mail->Subject = "Anmeldung Herbsttagung AK Grundschule 2014 - Warteliste";	
				$mail->Body = "
				<html>
				<head>
				<title>Anmeldung Herbsttagung AK Grundschule 2014 - Warteliste</title> 
			
				</head>
				<body>
				<p>$anrede $titel $empfaenger, <br /> <br />
				vielen Dank für Ihre Anmeldung zur Herbsttagung 2014. <br />
				Sie wurden auf die Warteliste gesetzt. <br /> 
				Bitte überweisen Sie vorerst nicht die Anmeldegebühr von 15 Euro. Wenn Sie nachrücken können, benachrichtigen wir Sie per Email.
				<br />
				
				<br />
				Viele Grüße <br />
				AK Grundschule</p>
				</body>
				</html>
				";						
			}
			else
			{			
				$mail->Subject = "Anmeldung Herbsttagung AK Grundschule 2014";	
				$mail->Body = "
				<html>
				<head>
				<title>Anmeldung Herbsttagung AK Grundschule 2014</title> 
			
				</head>
				<body>
				<p>$anrede $titel $empfaenger, <br /> <br />
				vielen Dank für Ihre Anmeldung zur Herbsttagung 2014. <br />
				Beachten Sie bitte, dass Ihre Anmeldung erst gültig wird, wenn die Anmeldegebühr von 15 Euro auf das im Folgenden angegebenen Konto eingegangen ist. <br />
			
						Ak Grundschule GDM - Claudia Lack <br />
						Konto-Nummer 102017830 <br />
						Volksbank Butzbach (BLZ 51861403) <br />
						IBAN DE17 5186 1403 0102 0178 30 <br />
						BIC GENODE51BUT <br />
				Der Betrag wird bei einer Abmeldung <i>nicht</i> rückerstattet.
				<br />
				
				<br />
				Viele Grüße <br />
				AK Grundschule</p>
				</body>
				</html>
				";						
			}

			if($mail->Send()) {
				}
				
				else {
					echo "<p>Fehler beim Senden Ihrer E-Mail!<p>";
				}
			


			// E-Mail an Administrator
	$names = fopen("anmeldungen.csv","r");
	if(!$names)
	{	echo "<p>Datei konnte nicht zum Lesen geöffnet werden. Wenden Sie sich bitte an H. Gasteiger.</p>";
		exit;
	}

	$n=0;
	while(!feof($names))
	{	$zeile = fgets($names,1024);
		if(trim($zeile)!="")
		{ $n++;
		}
	}	
	fclose($names);
			
			
			$mailAdmin = new PHPMailer();
						
			$mailAdmin->From     = "ak-gs-gdm@ph-karlsruhe.de"; //"f.mundt@gmx.net";
			$mailAdmin->FromName = "AK Grundschule";			
			$mailAdmin->Mailer   = "mail";			
			$mailAdmin->CharSet = 'utf-8';			
			$mailAdmin->SetLanguage ("de");			
			$mailAdmin->isHTML(true);			
			$mailAdmin->AddAddress("hedwig.gasteiger@mathematik.uni-muenchen.de", "Hedwig Gasteiger");
			$mailAdmin->Subject = "Neue Anmeldung Herbsttagung AK Grundschule 2014";	
			$mailAdmin->Body = "
			<html>
			<head>
			<title>Neue Anmeldung Herbsttagung AK Grundschule 2014</title>
			</head>
			<body>
			<p>Sehr geehrte Frau Prof. Gasteiger, <br /> <br />
			 
			 es wurde eine neue Anmeldung für die Herbsttagung abgegeben. Es sind bisher $n Anmeldungen eingegangen.<br /> <br />
			 Sie können die ergänzte CSV-Datei (die Sie in Excel öffnen können) unter <a href=\"http://didaktik-der-mathematik.de/ak/gs/anmeldung/anmeldungen.csv\">http://didaktik-der-mathematik.de/ak/gs/anmeldung/anmeldungen.csv</a> herunterladen. Alternativ ist auch eine aktualisierte Version im Anhang dieser E-Mail. <br /> <br />
			 Viele Grüße <br />
			 AK Grundschule Anmeldung</p>			
			</body>
			</html>
			";			
			$mailAdmin->AddAttachment("anmeldungen.csv");
			
			if($mailAdmin->Send()) {
				}
				
				else {
					echo "<p>Fehler beim Senden Ihrer E-Mail!<p>";
				}
		}
				
		?>

		
			</p>	
	
	<section id="infos">
	 			<header>
	 				<div class="header">
				 	<h2>Weiterführende Informationen</h2>			 	
				 	</div>
				 </header>
			  	<p>Sie erhalten eine Bestätigung der Anmeldung als Email. Achtung: Die Versendung kann bis zu einer halben Stunde dauern.</p>
			 <!--	<p>Sollten Sie sich nicht mit Email-Adresse anmelden wollen, drucken Sie bitte diese Seite aus und schicken Sie sie per Post an folgende Adresse:</p>
			
				<div id="hcard-Christiane-Benz" class="vcard">
					 <a class="url fn" href="http://www.ph-karlsruhe.de/index.php?id=4587">Christiane Benz</a>
					 <div class="org">PH Karlsruhe</div>
					 <a class="email" href="mailto:christiane.benz@ph-karlsruhe.de">christiane.benz@ph-karlsruhe.de</a>
					 <div class="adr">
					  <div class="street-address">Bismarckstraße 10</div>
					  <span class="locality">Karlsruhe</span>
					, 
					  <span class="region">Baden-Württemberg</span>
					, 
					  <span class="postal-code">76133</span>
					
					  <span class="country-name">Deutschland</span>
					
					 </div>
					 <div class="tel">+49 721 925 3 </div>
				</div> -->
			</section>
		
		<footer>
			<a href="http://didaktik-der-mathematik.de/ak/gs/">Zurück zur Hauptseite</a>
		</footer>
	</section>

</body>
</html>