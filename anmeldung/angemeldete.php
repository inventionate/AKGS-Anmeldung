<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="utf-8" />
	<title>Anmeldung AK Grundschule 2014 – Angemeldete Teilnehmer</title>
	
	<link rel="icon" type="image/png" href="img/icon.png">
	
	
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
	<li><a href="../anmeldung.php">Zurück zur Anmeldung →</a></li>
	</ul>
	</nav>	
	
</header>
	
<section id="maincontent">
	<header>
		  <div class="header">
		    <h2>Bisher angemeldete Teilnehmer</h2>
		  </div>
		  </header>
		  
		  <div class="uniForm">

		  	<?php 		  			  	
		  	$names = fopen("angemeldete.csv","r");
		  		if(!$names)
		  			{
		  				echo "<p>Datei konnte nicht zum Schreiben geöffnet werden. Wenden Sie sich bitte an den C. Benz.</p>";
		  			exit;
		  			}
		  		echo "<ul>";
		  		while(!feof($names))
		  		   {
		  		   $zeile = fgets($names,1024);
		  		    $contentline = utf8_encode($zeile); 
		  		   echo "<li>$contentline</li>";
		  		   }	
		  		echo "</ul>";	
		  					  		
		  		fclose($names);
		  	
		  	
		  	?>
		  	
		  </div>	
	
	<section id="infos">
	 			<header>
	 				<div class="header">
				 	<h2>Weiterführende Informationen</h2>			 	
				 	</div>
				 </header>
			  	<p>Sie erhalten eine Bestätigung der Anmeldung als Email. Achtung: Die Versendung kann bis zu einer halben Stunde dauern.</p>
<!--			 	<p>Sollten Sie sich nicht mit Email-Adresse anmelden wollen, drucken Sie bitte diese Seite aus und schicken Sie sie per Post an folgende Adresse:</p>
			
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
				</div>
-->			</section>
		
		<footer>
			<a href="http://didaktik-der-mathematik.de/ak/gs/">Zurück zur Hauptseite</a>
		</footer>
	</section>

</body>
</html>