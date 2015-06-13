$(document).ready(function(){
	
	$("form.uniForm").uniform({
	  prevent_submit : true
	});
	
	// Formularfelder ausblenden, die nicht benötigt werden
		
	$(".reisedaten").hide();
	$(".partner").hide();

	
	// Wenn teilweise Teilnahme gewählt wurdeAnreisedaten wählen lassen
	
	$(this).find("input:radio[name='teilnahme']").click(function() {
		var teilnahme = $("input:radio:checked[name='teilnahme']").val();

		if (teilnahme == "Teilweise") {
			$(".reisedaten").slideDown();	    
		}
		else {
			$(".reisedaten").slideUp();	    
		};
		
		if (teilnahme == "Nein") {
			$(".publizieren").slideUp();	    
		}
		else {
			$(".publizieren").slideDown();	    
		};
		
	});
	
	// Wenn Doppelzimmer gewählt wurde Zimmernachbar wählen lassen
		
	$(this).find("input:radio[name='zimmer']").click(function() {
		var zimmer = $("input:radio:checked[name='zimmer']").val();

		if (zimmer == "Doppelzimmer") {
			$(".partner").slideDown();	    
		}
		else {
			$(".partner").slideUp();	    
		};
	});

	
});