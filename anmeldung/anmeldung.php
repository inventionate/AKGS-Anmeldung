<?php session_start(); ?>

<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="utf-8" />
	<title>Anmeldung AK Grundschule 2015 – Anmeldewunsch eingegangen</title>

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
	</ul>
	</nav>

</header>

<section id="maincontent">
		<?php
        // CAPTCHA
        // HIER UNBEDINGT ZURÜCKSETZEN!!!
        // include_once $_SERVER['DOCUMENT_ROOT'].'/ak/gs/anmeldung/securimage/securimage.php';
        include_once '/home/www/u11142/html_www.inventionate.de/anmeldung/securimage/securimage.php';

        $securimage = new Securimage();

        if ($securimage->check($_POST['captcha_code']) == false) {
            echo '
			<header>
			<div class="header">
			    <h2>Ihre Anmeldung ist fehlgeschlagen!</h2>
			</div>
			</header>
			<p class="uniForm">
			';
            echo 'Sie haben einen ungültigen Sicherheitscode eingegeben.<br /><br />';
            echo "Bitte gehen Sie <a href='javascript:history.go(-1)'>zurück</a> und versuchen Sie es erneut.";
            exit;
        } else {
            $dz = fopen('anmeldungen.csv', 'a');
            if (!$dz) {
                echo '
						<header>
						<div class="header">
						  <h2>Ihre Anmeldung ist fehlgeschlagen</h2>
						</div>
						</header>

						<p class="uniForm">
						';
                echo 'Datei konnte nicht zum Schreiben geöffnet werden. Wenden Sie sich bitte an gdm@ph-karlsruhe.de';
                exit;
            }
            // Anmeldung in CSV Datei eintragen
            fwrite($dz, utf8_decode($_POST['anrede'].';'.$_POST['titel'].';'.$_POST['nachname'].';'.$_POST['vorname'].';'.$_POST['email'].';'.$_POST['einrichtung'].';'.$_POST['strasse'].';'.$_POST['ort'].';'.$_POST['plz'].';'.$_POST['teilnahme'].';'.$_POST['anreise'].';'.$_POST['abreise'].';'.$_POST['zimmer'].';'.$_POST['zimmerpartner'].';'.$_POST['oeffentlich'].";\n"));
            // Meldung ausgeben
            echo '
			<header>
				<div class="header">
				  <h2>Ihr Anmeldewunsch ist erfolgreich eingegangen</h2>
				</div>
			</header>
			<p class="uniForm">
			';
            echo 'Vielen Dank für Ihren Anmeldewunsch. Sie erhalten in Kürze eine E-Mail. <img src="img/ok.png" title="Erfolgreich" alt="OK" />';
            // Dateistream schließen
            fclose($dz);
            // Datei mit allen Anmeldungen
            $names = fopen('angemeldete.csv', 'a');
            // Abfragen, ob Datei exitsiert, ansonsten Fehler ausgeben
            if (!$names) {
                echo '
						<header>
						<div class="header">
						  <h2>Ihr Anmeldewunsch ist fehlgeschlagen</h2>
						</div>
						</header>

						<p class="uniForm">
						';
                echo 'Datei konnte nicht zum Schreiben geöffnet werden. Wenden Sie sich bitte an gdm@ph-karlsruhe.de';
                exit;
            }
            // Eintragen aller angemeldeten in extra CSV Datei
            if (($_POST['oeffentlich'] == true) and ($_POST['teilnahme'] != 'Nein')) {
                fwrite($names, utf8_decode($_POST['nachname'].', '.$_POST['vorname']."\n"));
            }
            // Dateistream schließen
            fclose($names);

            // BESTÄTIGUNGSMAIL
            require 'class.phpmailer.php';

            if ($_POST['anrede'] == 'Frau') {
                $anrede = 'Sehr geehrte Frau';
            };

            if ($_POST['anrede'] == 'Herr') {
                $anrede = 'Sehr geehrter Herr';
            };

            $titel = $_POST['titel'];

            $empfaenger = $_POST['vorname'].' '.$_POST['nachname'];

            $empfaengerMail = $_POST['email'];

            $mail = new PHPMailer();

            // ALLGEMEINE MAILANGABEN
            $mail->From = 'gdm@ph-karlsruhe.de';
            $mail->FromName = 'AK Grundschule';
            $mail->Mailer = 'mail';
            $mail->CharSet = 'utf-8';
            $mail->SetLanguage('de');
            $mail->isHTML(true);
            $mail->AddAddress($empfaengerMail, $empfaenger);

            // E-Mail an Personen, die *nicht* teilnehmen wollen
            if ($_POST['teilnahme'] == 'Nein') {
                $mail->Subject = 'Anmeldung Herbsttagung AK Grundschule 2015';
                $mail->Body = "
				<html>
				<head>
				<title>AK Grundschule 2015</title>

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
            } else {
                $mail->Subject = 'Anmeldung Herbsttagung AK Grundschule 2015';
                $mail->Body = "
				<html>
				<head>
					<title>Anmeldung Herbsttagung AK Grundschule 2015</title>
				</head>
				<body>
				<p>$anrede $titel $empfaenger, <br /> <br />
				Herzlichen Dank für Ihre Anmeldung.<br />
				<br />
				Sie erhalten im Juli 2015 Nachricht, ob Sie über das Losverfahren einen Platz erhalten erhalten haben oder nicht.<br />
				<br />
				Es grüßt Sie herzlich im Namen des Sprecherrates<br />
				Sebastian Wartha</p>
				</body>
				</html>
				";
            }

            if ($mail->Send()) {
            } else {
                echo '<p>Fehler beim Senden Ihrer E-Mail!<p>';
            }

            // E-MAIL AN DEN ADMINISTRATOR
            $names = fopen('anmeldungen.csv', 'r');
            if (!$names) {
                echo '<p>Datei konnte nicht zum Lesen geöffnet werden. Wenden Sie sich bitte an gdm@ph-karlsruhe.de</p>';
                exit;
            }
            $n = 0;
            while (!feof($names)) {
                $zeile = fgets($names, 1024);
                if (trim($zeile) != '') {
                    $n++;
                }
            }
            fclose($names);

            $mailAdmin = new PHPMailer();

            $mailAdmin->From = 'gdm@ph-karlsruhe.de';
            $mailAdmin->FromName = 'AK Grundschule';
            $mailAdmin->Mailer = 'mail';
            $mailAdmin->CharSet = 'utf-8';
            $mailAdmin->SetLanguage('de');
            $mailAdmin->isHTML(true);
            $mailAdmin->AddAddress('f.mundt@gmx.net', 'Fabian Mundt');
            $mailAdmin->Subject = 'Neue Anmeldung Herbsttagung AK Grundschule 2015';
            $mailAdmin->Body = "
			<html>
			<head>
			<title>Neue Anmeldung Herbsttagung AK Grundschule 2015</title>
			</head>
			<body>
			<p>Sehr geehrter Herr Prof. Wartha, <br /> <br />

			 es wurde eine neue Anmeldung für die Herbsttagung abgegeben. Es sind bisher $n Anmeldungen eingegangen.<br /> <br />
			 Sie können die ergänzte CSV-Datei (die Sie in Excel öffnen können) unter <a href=\"http://didaktik-der-mathematik.de/ak/gs/anmeldung/anmeldungen.csv\">http://didaktik-der-mathematik.de/ak/gs/anmeldung/anmeldungen.csv</a> herunterladen. Alternativ ist auch eine aktualisierte Version im Anhang dieser E-Mail. <br /> <br />
			 Viele Grüße <br />
			 AK Grundschule Anmeldung</p>
			</body>
			</html>
			";
            $mailAdmin->AddAttachment('anmeldungen.csv');

            if ($mailAdmin->Send()) {
            } else {
                echo '<p>Fehler beim Senden Ihrer E-Mail!<p>';
            }
        }
        ?>
		<!-- Schließen des p tags-->
		</p>

		<section id="infos">
			<header>
				<div class="header">
					<h2>Weiterführende Informationen</h2>
				</div>
			</header>
			<p>Sie erhalten eine Bestätigung per E-Mail. Achtung: Die Versendung kann bis zu einer halben Stunde dauern.</p>
		</section>

		<footer>
			<a href="http://didaktik-der-mathematik.de/ak/gs/">Zurück zur Hauptseite</a>
		</footer>
	</section>
</body>
</html>
