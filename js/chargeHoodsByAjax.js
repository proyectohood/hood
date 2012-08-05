
$(document).ready(function(){

/*
	////////////////////////////////////////
	/ Example of pointers 
	////////////////////////////////////////	
	/		position // value			   /
	////////////////////////////////////////
	/		13		//	"Hood de prueba"   /	<---- iStartHoods								
	////////////////////////////////////////
	////////////////////////////////////////
	/		14		//"Otro hood de prueba"/					
	////////////////////////////////////////
	////////////////////////////////////////
	/		15		//	"probando"		   /					
	////////////////////////////////////////
	////////////////////////////////////////
	/		16		//	"ultimo ingresado" /    <---- iEndHoods				
	////////////////////////////////////////			
	/
	/
	////////////////////////////////////////

	The Last hood in the BD is the firs hood that has to be shown

*/
	(function ($, window) {

		// ------------------------------ Var Definitions ------------------------------------------
		const hoodsViewPerPage = 15; // This is a constant with the quantity of hoods that will be showed per page
		var countHoods = 0;// This var has the amount of Hoods
		var iStartHoods = 0; // This var is a pointer
		var iEndHoods = 0; // This var is a pointer
		var counterStart = hoodsViewPerPage; // This var is a pointer
		var counterEnd = 0; // This var is a pointer
		var page = window.location.pathname;
		
		// ------------------------------ Initial Function ----------------------------------------
		function start(){
			getCountHoods(); // This function is called at start

		// ------------------------------ Events Functions ------------------------------------------

			$(".btnVerMas").click(function(){
				getMoreHoods();
			});

			$("#btnInsertHood").click(function(e){
				e.preventDefault();
				countHoods++;
				iStartHoods = countHoods - hoodsViewPerPage;
				iEndHoods = countHoods;
				$('iframe').contents().find('input[name="upload"]').click();
				setHood();
				$("#inputTextHood").val("");
				if(countHoods > hoodsViewPerPage){
					$(".btnVerMas").show();
				}
				updateCountHoodsByUSer();
				updateCountAttachmentsByUser();
			});
		}
		function getMoreHoods(){
			if(countHoods > hoodsViewPerPage && (iStartHoods > 0 && iEndHoods > 0)){
				getCountHoods();
			}
			else{
				$(".btnVerMas").hide();
			}
		}
		function updateCountHoodsByUSer(){

			var url_encoded = window.location.protocol +"//"+ window.location.host +"/"+ (window.location.pathname).split("/")[1] +"/hood/getCountHoodByUser";

			$.ajax({
				type: 'POST',
				url : url_encoded,
				success : function(response){
					var result = jQuery.parseJSON(response);
					$(".hoodsAmount").html(result["COUNT(*)"]);
						
				}
			});
		}
		function updateCountAttachmentsByUser(){
			var url_encoded = window.location.protocol +"//"+ window.location.host +"/"+ (window.location.pathname).split("/")[1] +"/hood/getCountAttachmentsByUser";

			$.ajax({
				type: 'POST',
				url : url_encoded,
				success : function(response){
					var result = jQuery.parseJSON(response);
					$(".attachmentsAmount").html(result["COUNT(*)"]);
						
				}
			});
		}
		function infiteScroll(){
			$(window).scroll(function () { 
				var scrollHeight = $(window).scrollTop() + 1;
				var windowHeight = ($(document).height() - $(window).height());
				//console.log(scrollHeight + " --- " + windowHeight);
				if((scrollHeight >= windowHeight-10) && (scrollHeight <= windowHeight+10)){
					getMoreHoods();
				}
			});
		}
	// ------------------------------ Print Function ------------------------------------------

		function printHoodsInPoste(response,option){
			var result = JSON.parse(response);
			currentUser = result.currentUsername;
			result = result.records;
			var html = "";
			$.each(result,function(index,value){
				html += "<div>";
				if(value.username == currentUser)
	            	html += "<a href='"+ window.location.protocol +"//"+ window.location.host +"/index.php/perfil/'>";
	            else
	            	html += "<a href='"+ window.location.protocol +"//"+ window.location.host +"/index.php/perfil/show/user/"+value.username+"'>";
	            html += "<img src='"+ window.location.protocol +"//"+ window.location.host +"/img/userImages/"+value.url_img+"'/>";
	            html += "<h1>"+value.user+ ' ' +value.last_name+"</h1>";
	            html += "<span>@"+ value.username +"</span>";
	            html += "</a>";
	            html += "<p>"+value.text+"</p>";
	            html += "<div>";
	            html += "<span>"+value.time+"</span>";
	            html += "<span>"+ value.date + "</span>";
	            if(value.filename != null){
	            	html += "<a href='"+ window.location.protocol +"//"+ window.location.host +"/files/"+value.filename+"'>"+value.filename+"</a>";
	            }
	            html += "</div>";
	          	html += "</div>";
			});
			if(option == "newHood"){
				$(".hoodsContainer").html(html);
			}
			else{
				$(html).appendTo(".hoodsContainer");
			}	
		}
		// ------------------------------ Set Functions ------------------------------------------
		function setHood(){
			if(!($("#inputTextHood").val() == "")){
				var parametros = {
				"textHood" : $("#inputTextHood").val()
				};
				var url_encoded = window.location.protocol +"//"+ window.location.host +"/"+ (window.location.pathname).split("/")[1] +"/hood/setHood";		
				
				$.ajax({
					type: 'POST',
					data: parametros,
					url : url_encoded,
					success : function(response){
					},
					complete : function(){
						$('iframe').contents().find('input[name="upload"]').click();
						//Reset Pointers
						counterStart = hoodsViewPerPage + hoodsViewPerPage; // This var is a pointer
						counterEnd = hoodsViewPerPage; // This var is a pointer
						getHoods("newHood");	
					}
				});
			}
		}

		// ------------------------------ Get Functions ------------------------------------------
		/* Paramater : 
			option : "newHood" or ""
			If is "newHood" = insert the new hood and show the first 15 hoods
			If is "" = show the next 15 hoods

		*/

		function getHoods(option){
			var url_encoded = window.location.protocol +"//"+ window.location.host +"/"+ (window.location.pathname).split("/")[1] + "/hood/getAllHoods";
			var parametros = {};
			if(page.indexOf('perfil') != -1){
				
				if((window.location.pathname).split("/")[(window.location.pathname).split("/").length - 2] == "user"){
					parametros.username = (window.location.pathname).split("/")[(window.location.pathname).split("/").length - 1];
					var url_encoded = window.location.protocol +"//"+ window.location.host +"/"+ (window.location.pathname).split("/")[1] + "/hood/getHoodsByUsername";
				}
				else{
					var url_encoded = window.location.protocol +"//"+ window.location.host +"/"+ (window.location.pathname).split("/")[1] + "/hood/getHoodsByUser";
				}
			}
			else if(page.indexOf('poste') != -1){
				var url_encoded = window.location.protocol +"//"+ window.location.host +"/"+ (window.location.pathname).split("/")[1] + "/hood/getAllHoods";
			}
		
			parametros.iStart = iStartHoods;
			parametros.iEnd = iEndHoods;
			
			$.ajax({
				type: 'POST',
				data: parametros,
				url : url_encoded,
				success : function(response){
					printHoodsInPoste(response,option);
				}
			});
		}
		// This function count the hoods in the DB and get the Hoods in the range of 15 hoods per page
		function getCountHoods(){
			var url_encoded = window.location.protocol +"//"+ window.location.host +"/"+ (window.location.pathname).split("/")[1] +"/hood/getCountHoods";
			
			if(page.indexOf('perfil') != -1){
				var url_encoded = window.location.protocol +"//"+ window.location.host +"/"+ (window.location.pathname).split("/")[1] +"/hood/getCountHoodByUser";
			}
			else if(page.indexOf('poste') != -1){
				var url_encoded = window.location.protocol +"//"+ window.location.host +"/"+ (window.location.pathname).split("/")[1] +"/hood/getCountHoods";
			}
			
			$.ajax({
				type: 'POST',
				url : url_encoded,
				success : function(response){
					var result = jQuery.parseJSON(response);
					countHoods = parseInt(result["COUNT(*)"]);
					if(countHoods >= hoodsViewPerPage){
						//$(".btnVerMas").show();
						iStartHoods = countHoods - counterStart;
						iEndHoods = countHoods - counterEnd;
						getHoods("");
						counterEnd += hoodsViewPerPage; // Define a Range of 15
						counterStart += hoodsViewPerPage; // Define a Range of 15
						console.log("iStartHoods " +iStartHoods + " iEndHoods " + iEndHoods + " counterEnd " + counterEnd+ "counterStart " + counterStart);
					}
					else{
						//$(".btnVerMas").hide();
						//Reset Pointers
						iStartHoods = 0;
						iEndHoods = countHoods;
						getHoods(""); 
					}
					
				}
			});
		}
		

		// Begin Module Public Section
        return {
            init: (function () {
              start();
             //if(page.indexOf('poste') != -1){
              	infiteScroll();
         	 //}
            })()
        };
	})(jQuery, window);
});