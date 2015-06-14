<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="utf-8" />
	<title>Anmeldung AK Grundschule 2015</title>

	<link rel="icon" type="image/png" href="img/icon.png">


	<!-- Uni-Form -->
	<link rel="stylesheet" href="anmeldung/css/uni-form.css" />
	<link rel="stylesheet" href="anmeldung/css/default.uni-form.css" />

	<link rel="stylesheet" href="anmeldung/css/style.css" />

	<!-- jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script src="anmeldung/js/uni-form-validation.jquery.min.js"></script>
	<script src="anmeldung/js/de.js"></script>

	<!--[if lte IE 8]>
	<script src="html5.js" type="text/javascript"></script>
	<![endif]-->

	<script src="anmeldung/js/script.js"></script>

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
	<header>
	<div class="header">
	  <h2>Anmeldung Herbsttagung 2015 in Tabarz</h2>
	</div>
	</header>

		<form action="anmeldung/anmeldung.php" method="post" class="uniForm">
		  <fieldset class="inlineLabels">

		   <div class="ctrlHolder">
		      <p class="label">Teilnahme</p>
		      <ul class="blockLabels">
		        <li><label for="teilnahmeJa"><input type="radio" id="teilnahmeJa" name="teilnahme" class="required" value="Ja"> Ich nehme teil.</label></li>
		        <li><label for="teilnahmeTeilweise"><input type="radio" id="teilnahmeTeilweise" name="teilnahme" class="required" value="Teilweise">
		        	Ich nehme nur teilweise teil.</label></li>
		        <li><label for="teilnahmeNein"><input type="radio" id="teilnahmeNein" name="teilnahme" class="required" value="Nein"> Ich nehme nicht teil, möchte aber weiterhin Informationen erhalten.</label></li>
		      </ul>
		      <p class="formHint">Bitte wählen Sie die Art Ihrer Teilnahme</p>
		    </div>

		    <div class="ctrlHolder reisedaten">
		      <label for="anreise">Anreisetag</label>
				<select name="anreise" id="anreise">
				  <option value="">Anreisedatum wählen</option>
				  <option value="06.11.2015">06.11.2015</option>
				  <option value="07.11.2015">07.11.2015</option>
				  <option value="08.11.2015">08.11.2015</option>
				</select>
		      <p class="formHint">Bitte geben Sie an, wann Sie anreisen werden</p>
		    </div>

		    <div class="ctrlHolder reisedaten">
		      <label for="abreise">Abreisetag</label>
				<select name="abreise" id="abreise">
				  <option value="">Abreisedatum wählen</option>
				  <option value="06.11.2015">06.11.2015</option>
				  <option value="07.11.2015">07.11.2015</option>
				  <option value="08.11.2015">08.11.2015</option>
				</select>
		      <p class="formHint">Bitte geben Sie an, wann Sie abreisen werden</p>
		    </div>

		    <div class="ctrlHolder">
		      <p class="label">Übernachtung</p>
		      <ul class="blockLabels">
		        <li><label for="einzelzimmer"><input type="radio" id="einzelzimmer" name="zimmer" class="required" value="Einzelzimmer"> Ich möchte ein Einzelzimmer.</label></li>
		        <li><label for="doppelzimmer"><input type="radio" id="doppelzimmer" name="zimmer" class="required" value="Doppelzimmer"> Ich möchte ein Doppelzimmer.</label></li>
		        <li><label for="keinZimmer"><input type="radio" id="keinZimmer" name="zimmer" class="required" value="Keines"> Ich benötige keine Übernachtung im Hotel.</label></li>
		      </ul>
		      <p class="formHint">Bitte wählen Sie Ihre gewünschte Übernachtungsart.</p>
		    </div>

		    <div class="ctrlHolder partner">
		      <label for="zimmerpartner">Zimmerpartner</label>
		      <input type="text" id="zimmerpartner" name="zimmerpartner" value="" size="35" class="textInput">
		      <p class="formHint">Bitte geben Sie hier ihren gewünschten Zimmerpartner an.</p>
		    </div>

		    <div class="ctrlHolder">
		      <label for="anrede">Anrede</label>
		      <select id="anrede" name="anrede">
		        <option value="Herr">Herr</option>
		        <option value="Frau">Frau</option>
		      </select>
		      <p class="formHint"></p>
		    </div>

		    <div class="ctrlHolder">
		      <label for="titel">Titel</label>
		      <select id="titel" name="titel">
		        <option value=" "></option>
		        <option value="Dr.">Dr.</option>
		        <option value="Prof.">Prof.</option>
		        <option value="Prof. Dr.">Prof. Dr.</option>
		      </select>
		      <p class="formHint"></p>
		    </div>

		    <div class="ctrlHolder">
		      <label for="vorname">Vorname</label>
		      <input type="text" id="vorname" name="vorname" value="" size="35" class="textInput required">
		      <p class="formHint"></p>
		    </div>

		    <div class="ctrlHolder">
		      <label for="nachname">Nachname</label>
		      <input type="text" id="nachname" name="nachname" value="" size="35" class="textInput required">
		      <p class="formHint"></p>
		    </div>

		    <div class="ctrlHolder">
		      <label for="email">E-Mail</label>
		      <input type="text" id="email" name="email" value="" size="35" class="textInput required validateEmail">
		      <p class="formHint">Bitte geben Sie eine gültige E-Mail an.</p>
		    </div>

		    <div class="ctrlHolder">
		      <label for="einrichtung">Einrichtung</label>
		      <input type="text" id="einrichtung" name="einrichtung" value="" size="35" class="textInput">
		      <p class="formHint">Die aktuelle Instutution, an der Sie tätig sind.</p>
		    </div>

		    <div class="ctrlHolder">
		      <label for="strasse">Straße, Hausnummer (dienstl.)</label>
		      <input type="text" id="strasse" name="strasse" value="" size="35" class="textInput">
		    </div>

		    <div class="ctrlHolder">
		      <label for="ort">Ort (dienstl.)</label>
		      <input type="text" id="ort" name="ort" value="" size="35" class="textInput">
		    </div>

		    <div class="ctrlHolder">
		      <label for="plz">PLZ (dienstl.)</label>
		      <input type="text" id="plz" name="plz" value="" size="35" class="textInput">
		    </div>


			  <div class="ctrlHolder publizieren">
			      <p class="label"></p>
			      <ul class="blockLabels">
			        <li><label for="oeffentlich"><input type="checkbox" id="oeffentlich" name="oeffentlich"> Veröffentlichung meines Namens erlauben</label></li>
			      </ul>
			      <p class="formHint">Ihr Name wird in der Onlineliste der Teilnehmer veröffentlicht.</p>
			    </div>

			<div class="ctrlHolder">

				<label for="captcha_code"><img id="captcha" src="anmeldung/securimage/securimage_show.php" alt="CAPTCHA Sicherheitsbild" /></label>
				<input type="text" id="captcha_code" name="captcha_code" size="35" maxlength="6" class="textInput" />

				<p class="formHint">Die Sicherheitsfrage dient dem Spamschutz. <a href="#" onclick="document.getElementById('captcha').src = 'anmeldung/securimage/securimage_show.php?' + Math.random(); return false">Neues Bild generieren</a>.</p>

			</div>
			<br />
		<div class="disclaimer">
			Sollten Sie einen Platz über das Losverfahren erhalten, wird Ende Juli eine Anmeldegebühr fällig.
		</div>

		<div class="buttonHolder">
			<button type="reset" class="secondaryAction">← Abbrechen</button>
		    <button type="submit" class="primaryAction">Anmelden</button>
		</div>

		  </fieldset>
		</form>
 		<section id="infos">
 			<header>
 				<div class="header">
			 	<h2>Weiterführende Informationen</h2>
			 	</div>
			 </header>
			<p>Sie erhalten eine Bestätigung Ihres Teilnahmewunsches per E-Mail. Achtung: Die Versendung kann bis zu einer halben Stunde dauern.</p>
		</section>

	<footer>
		<a href="http://didaktik-der-mathematik.de/ak/gs/">Zurück zur Hauptseite</a>
	</footer>
</section>

</body>
</html>
