function izenaBalidatu(){
       //IZENA balidatzeko

	var izen =document.getElementById("Izena");
	//var expresioa= /^[A-Za-z]+\s[A-Za-z]+\s[A-Za-z]+/g;
	var expresioa =/^[A-Za-z]/g;
	if(!expresioa.test(izen.value)){
		alert("ERROREA: Izena jartzea derrigorrezkoa duzu");
                return false;
	}else{
           return true;
        }
};

function abizenakBalidatu(){
         
        //ABIZENAK BALIDATZEKO
	var abizen=document.getElementById("abizenak");
	expresioa= /^[A-Za-z]+\s[A-Za-z]/g;
	if(!expresioa.test(abizen.value)){
                abizen.style.backgroundColor = "#FF0000";
                abizen.focus();
		alert("ERROREA: Abizenak jartzea derrigorrezkoa duzu");
                return false;
	}else{
           return true;
        }
};

function emailaBalidatu(){

        //EMAILA balidatzeko
	var emaila=document.getElementById("emaila");
	expresioa= /^[a-z]+\d{3}\@(ikasle\.)?ehu\.(eus|es)/g;
	if(!expresioa.test(emaila.value) ){
                emaila.style.backgroundColor = "#FF0000";
                //emaila.focus();	
		//alert("ERROREA: " + emaila.value+ " helbidea ez da zuzena");
              
             return false;	
	}else{
            emaila.style.backgroundColor = "#66cc66";
            //emaila.focus();	
            return true;
        }

};

function telefonoaBalidatu(){

        //TELEFONOA balidatzeko
	var telefonoa=document.getElementById("telefonoa").value;
        //expresioa=/^\d{9}/g;
	if(telefonoa.length==0){
		telefonoa.style.backgroundColor = "#FF0000";
                telefonoa.focus();
		alert("ERROREA: Telefono zenbakia adieraztea derrigorrezkoa da");
             
             return false;
				
	}else if(telefonoa.length<9 || telefonoa.length>9){           //}else if(!(expresioa.test(telefonoa))){    
		telefonoa.style.backgroundColor = "#FF0000";
                telefonoa.focus();	
		alert("ERROREA: Telefonoz zenbakiak 9 digitu izan behar ditu");	
                return false;
	}else{
            return true;
        }
};

function espezialitateaBalidatu(){

         //ESPEZIALITATEAREN Balidazioa
	var espe= document.getElementById("espezialitatea").value;
	var beste= document.getElementById("besterik").value;
   	if (espe=="Aukeratu" || (espe=="Besterik" && beste=="")){
		espe.style.backgroundColor = "#FF0000";
                espe.focus();	
		alert("ERROREA: Espezialitate bat hautatu behar duzu derrigorrez.");
                return false;      
	}
};

function pasahitzaBerdinak(){

        //PASAHITZA balidatzeko
	var pass1= document.getElementById("pasahitza");
	var pass2= document.getElementById("pasahitza2");
	var mezua = document.getElementById('emaitza1');
        expresioa= /^\w{6}(\w*)/g;

	if(pass1.length==0){									
		alert("ERROREA: Pasahitzaren bat jartzea derrigorrezkoa da");
                return false;
	}else if(pass1.length<"6"){         //}else if(!expresioa.test(pass1)){			
		
                alert( "ERROREA: Pasahitzak 6ko luzera izan behar du gutxienez");
	        return false;
        }

       if(pass1.value == pass2.value && expresioa.test(pass1.value)){
             pass2.style.backgroundColor = "#66cc66";
             mezua.style.color = "#66cc66";
             mezua.innerHTML = "Pasahitzak berdinak dira"
           return true;
       }else{
             pass2.style.backgroundColor = "#FF0000";
             mezua.style.color = "##FF0000";
             mezua.innerHTML = "Pasahitzak EZ dira berdinak";
             pass2.focus();
            return false;
       }	
};

function erregistroOsoaBalidatu(){	
		

	if(izenaBalidatu() && abizenakBalidatu() && emailaBalidatu() && pasahitzaBerdinak() && telefonoaBalidatu() && espezialitateaBalidatu()){
		
                //BALIOAK IKUSI
                var sAux="";
		var frm=document.getElementById("erregistro");
		for (i=0;i<frm.elements.length;i++){	
			sAux +="IZENA: " + frm.elements[i].name+"";
			sAux +="BALIOA: " + frm.elements[i].value+"\n";
		}
		alert(sAux);
		return true;
	
        }else{
            return false;
	}   	
};

function GalderaBalidatu(){	
	var zuzena = 1;						
	
	//GALDERA balidatzeko
	var galdera= document.getElementById("galderatestua").value;
	if(galdera==""){
		zuzena = 0;
		alert("ERROREA: Galdera idaztea derrigorrezkoa duzu");
	}
	
	//ERANTZUNA balidatzeko
	var erantzuna= document.getElementById("eranZuzena").value;
	if(erantzuna==""){
		zuzena = 0;
		alert("ERROREA: Erantzuna idaztea derrigorrezkoa duzu");
	}

	//EMAILA balidatzeko
	var emaila= document.getElementById("egilePosta");
	expresioa= /^[a-z]+\d{3}\@(ikasle\.)?ehu\.(eus|es)/g;
	if(!expresioa.test(emaila.value) ){
		zuzena = 0;
		alert("ERROREA: " + emaila.value + " helbidea ez da zuzena!");		
	}
	
   	//BALIOAK IKUSI
	if (zuzena == 1){
		var sAux="";
		var frm=document.getElementById("erregistro");
		for (i=0;i<frm.elements.length;i++){	
			sAux +="IZENA: " + frm.elements[i].name+"";
			sAux +="BALIOA: " + frm.elements[i].value+"\n";
		}
		alert(sAux);
		return true;
	}
	return false;
};

///*
//function egiaztatu_luzapena() { 
//   var fitxategi = document.getElementById("argazkiaIgo").value;
//   luzapenak = new Array(".png", ".jpg",); //".doc", ".pdf"); 
//   errorea= ""; 
//   //fitxategiaren luzapena lortu 
//   luzapen = (fitxategi.substring(fitxategi.lastIndexOf("."))).toLowerCase(); 
//   //zihurtatu luzapena onartuaetako bat dela. 
//   onartuta = false; 
//    for (var i = 0; i < luzapenak.length; i++) { 
//       if (luzapenak[i] == luzapen) { 
//         onartuta = true; 
//         break; 
//        } 
//    } 
//    if (!onartuta) { 
//       errorea = "Zihurtatu fitxategien luzapena, hauetako bat izan beharko du:" + luzapenak.join(); 
//	   return 0;
//	}else{
//		  alert("Luzapena zuzena da");
//	  	  return 1;
//	}
//}*/

function espezialitateaSelect(){
	document.getElementById("BesterikLabel").style.display = 'block';
	document.getElementById("besterik").style.display = 'block';
};



function DeSelect(){
	document.getElementById("BesterikLabel").style.display = 'none';
	document.getElementById("besterik").style.display = 'none';
};

/*function argazkiaAurreikusi(fitxategi) {
    if (fitxategi.files && fitxategi.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('aurreikusi').src=e.target.result;
        }
        reader.readAsDataURL(fitxategiBox.files[0]);
                    document.getElementById("aurreikusi").style.display = "block";

    }
}*/

//function argazkiaAurreikusi(input) {
//    if (input.files && input.files[0]) {
//        var reader = new FileReader();
//        reader.onload = function (e) {
//            $('#profile').remove();
//            $('#argazkizatia').append("<img id='profile'  src='" + e.target.result + "' heigth='15%' width='15%' >");
//        }
//        reader.readAsDataURL(input.files[0]);
//    }
//}

           
//$("#argazkia").change(function () {
//    argazkiaAurreikusi(this);
//});