function module_nav_click(mode_number, number_of_modes, session_var_name){
	
	for (i=1; i<=number_of_modes; i++){
		var elementID="mode"+i;
		if(mode_number==i){
			var jQID="#mode"+i;
			if(document.getElementById(elementID).style.display=="block"){
				$(document).ready(function(){$(jQID).slideUp(200);});
				document.getElementById("mode_butt_"+i).style.backgroundColor="";
				sessionStorage.setItem(session_var_name, "");
			}else{
				$(document).ready(function(){$(jQID).slideDown(200);});
				document.getElementById("mode_butt_"+i).style.backgroundColor="#888888";
				sessionStorage.setItem(session_var_name, mode_number);
			}
		}else{
			document.getElementById(elementID).style.display="none";
			document.getElementById("mode_butt_"+i).style="";
		}
	}
	
	var table=document.getElementById("table_container");
	if (table.style.display=="none" && sessionStorage.getItem("project_mode_number")!=4)$(document).ready(function(){$("#table_container").slideDown(200);});
}

function module_nav_hide(number_of_modes){
		for (i=1; i<=number_of_modes; i++){
		var elementID="mode"+i;
			document.getElementById(elementID).style.display="none";
			document.getElementById("mode_butt_"+i).style.backgroundColor="#595959";
	}
}

 function onload_module(number_of_modes, session_var_name){
	 
	var mode=sessionStorage.getItem(session_var_name);
	
	if(mode!=""){
		for (i=1; i<=number_of_modes; i++){
			var elementID="mode"+i;
			if(mode==i){
				document.getElementById(elementID).style.display="block";
				document.getElementById("mode_butt_"+i).style.backgroundColor="#888888";
			}else{
				document.getElementById(elementID).style.display="none";
				document.getElementById("mode_butt_"+i).style="";
			}
		} 
	}	
} 

function toggle_table(){
	var table=document.getElementById("table_container");
	var form=document.getElementById("mode4")
	if (sessionStorage.getItem("project_mode_number")==4){
		$(document).ready(function(){$("#table_container").slideUp(200);});
		$(document).ready(function(){$("#mode4").slideDown(200);});
		
	}else{
		$(document).ready(function(){$("#table_container").slideDown(200);});
		$(document).ready(function(){$("#mode4").slideUp(200);});
		/* sessionStorage.setItem("project_mode_number",0); */
	}
}

function hide_table(){
	var table=document.getElementById("table_container");
	if (sessionStorage.getItem("project_mode_number")==4){
		table.style.display="none";
	}else{
		table.style.display="block";
	}
}

function StickyNavigation()
{
	$(document).ready(function() {
	var NavY = $('.nav').offset().top;
	 
	var stickyNav = function(){
	var ScrollY = $(window).scrollTop();
		  
	if (ScrollY > NavY) { 
		$('.nav').addClass('sticky');
	} else {
		$('.nav').removeClass('sticky'); 
	}
	};
	 
	stickyNav();
	 
	$(window).scroll(function() {
		stickyNav();
	});
	});
}