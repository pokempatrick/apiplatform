var element = document.getElementsByTagName("form");
var form_being_submitted = false;
var myFunction = function(e) {
		if(form_being_submitted) {
        alert("The form is being submitted, please wait a moment...");
        e.preventDefault();
        return;
      	}
      	form_being_submitted = true;
	};
for (var i = 0, c = element.length ; i < c ; i++){
	element[i].addEventListener('submit', myFunction, false);
}

var variable="#facture_motif";
var localisation="#edifice_localisation";
$(document).ready(function(){
	if($(variable).val()=="Bail"){
		$("#bail").hide("slow");
	}
	$(variable).change(function(){
		if($(variable).val()=="Bail"){
			$("#bail").hide("slow");
		}else{
			$("#bail").show("slow");
		}
	  
	});
	//Géolocalisation des édifices

	$(localisation).click(function(){
		if(navigator.geolocation){
			alert("navigateur compatible");
			navigator.geolocation.getCurrentPosition(updatePosition, codeErreur);
		}else{
			alert("navigateur incompatible 2");
		}
		/*$("#edifice_longitude").val(position.getCurrentPosition().coords.longitude);
		$("#edifice_latitude").val(position.getCurrentPosition().coords.edifice_latitude);*/
	});
	function updatePosition(position){
		$("#edifice_longitude").val(position.coords.longitude);
		$("#edifice_latitude").val(position.coords.latitude);
		alert("Erreur sur la position " +position.coords.accuracy);
	}

	function codeErreur(error){
		switch(error.code){
			case error.PERMISSION_DENIED:
				console.log("l'utilisateur refuse l'accès à la localisation");
				alert("l'utilisateur refuse l'accès à la localisation");
				break;
			case error.POSITION_UNAVAILABLE:
				console.log("Informations de localisation non disponibles");
				alert("Informations de localisation non disponibles");
				break;
			case error.TIMEOUT:
				console.log("Temps écoulé bien vouloir réessayer dans quelque minutes");
				alert("Temps écoulé bien vouloir réessayer dans quelque minutes");
				break;
			case error.UNKNOWN_ERROR:
				console.log("Une erreur d'origine inconnue est survenue");
				alert("Une erreur d'origine inconnue est survenue");
				break;
			default:
				console.log("Une erreur est survenue ");
				alert("Une erreur est survenue");

		}
	}

});
/*
var variable="#edifice_nom";
$(document).ready(function(){
	$(variable).on({
	  change: function(){
	    $(this).css("background-color", "blue");
	  },
	  
	  keyup: function(){
	    $(this).css("background-color", "yellow");
	  }
	});
});




var ptravail="#eneo_gesttransbundle_demtravail_puissance"
var ttravail="#eneo_gesttransbundle_demtravail_tensionPrimaire"
var ptest="#eneo_entreemagasinbundle_demtest_puissance"
var ttest="#eneo_entreemagasinbundle_demtest_tensionPrimaire"
var ratioId=new Array();
var ratiocId=new Array();
var tensionId=new Array();
var tensioncId=new Array();
var event= new Array();
var rad="#eneo_gesttransbundle_diag_ratio_isol_ratios_";
var radc="#eneo_gesttransbundle_qual_ratio_isol_ratios_";
var rat2="_ratioMesure";
var ten2="_tensionPrimaire";
for (var i=0; i<3;i++){
	ratioId[i]=rad+i+rat2;
	tensionId[i]=rad+i+ten2;
}
for (var i=0; i<24;i++){
	ratiocId[i]=radc+i+rat2;
	tensioncId[i]=radc+i+ten2;
}

$(document).ready(function(){
	//coloration ratio diagnostic
	for (var i = 0; i <3; i++) {
		event[i]= new RatioTest(ratioId[i], 410, $(tensionId[i]).val());
	}
	// coloration ratio contrôle qualité
	for (var i = 0; i <24; i++) {
		event[i]= new RatioTest(ratiocId[i], 410, $(tensioncId[i]).val());
	}
	$(ptravail).on({
		  change: function(){
			  if($(ptravail).val()==25){
			  	$(ttravail).val(17320);
			  }	
		  	},
		  
		});
	$(ptest).on({
		  change: function(){
			  if($(ptest).val()==25){
			  	$(ttest).val(17320);
			  }	
		  	},
		  
		});
});
class RatioTest{
	constructor( ratioId, tensionSecondaire, tensionPrimaire){
		this.ratioId=ratioId;
		$(this.ratioId).on({
		  change: function(){
			  	var ratio=new Ratio(tensionPrimaire, tensionSecondaire,$(this).val());
			  	$("#eneo_gesttransbundle_diag_ratio_isol_isolements_0_valeur").val(ratio.getRatioTheorique())
			  	if(ratio.getDecision()){
				    $(this).css("background-color", "#e6ffff");
				}else{
				  	$(this).css("background-color", "#ffe6e6");
				}  
		  	},
		  keyup: function(){
		  		var ratio=new Ratio(tensionPrimaire, tensionSecondaire,$(this).val());
		  		if(ratio.getDecision()){
				    $(this).css("background-color", "#e6ffff");
				}else{
				  	$(this).css("background-color", "#ffe6e6");
				}
			  },
		});
	}
}
class Ratio{
	constructor( tensionPrimaire, tensionSecondaire, ratioMesure ){
		this.tensionPrimaire=tensionPrimaire;
		this.tensionSecondaire=tensionSecondaire;
		this.ratioMesure=ratioMesure;
	}
	getRatioTheorique(){
		if(this.tensionPrimaire>16000 && this.tensionPrimaire<20000)
        {
            return (this.tensionPrimaire/this.tensionSecondaire);
        }else
        {
            return (this.tensionPrimaire*1.732/this.tensionSecondaire);
        }
	}
	getEcart(){
		return (Math.abs(this.getRatioTheorique()-this.ratioMesure))*100/this.getRatioTheorique();
	}
	getDecision(){
		 if(this.getEcart()<=0.5)
        {
            return true;
        } else{
            return false;
        }
	}

}*/