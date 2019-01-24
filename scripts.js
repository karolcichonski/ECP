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

function ecp_formfield_hide(){
	var AddForm=document.getElementById("ecp_formfield");
	AddForm.style.display="none";
}

function add_click()
{
	var AddForm=document.getElementById("Add_form");
	var UpdateForm=document.getElementById("Update_form");
	var DeleteForm=document.getElementById("Delete_form");
		$(document).ready(function(){$("#Update_form").slideUp(200);});
		$(document).ready(function(){$("#Delete_form").slideUp(200);});
		$(document).ready(function(){$("#Add_form").slideDown(200);});
}

function update_click(){
	var AddForm=document.getElementById("Add_form");
	var UpdateForm=document.getElementById("Update_form");
	var DeleteForm=document.getElementById("Delete_form");
		$(document).ready(function(){$("#Add_form").slideUp(200);});
		$(document).ready(function(){$("#Delete_form").slideUp(200);});
		$(document).ready(function(){$("#Update_form").slideDown(200);});
}

function delete_click()
{
	var AddForm=document.getElementById("Add_form");
	var UpdateForm=document.getElementById("Update_form");
	var DeleteForm=document.getElementById("Delete_form");
		$(document).ready(function(){$("#Add_form").slideUp(200);});
		$(document).ready(function(){$("#Update_form").slideUp(200);});
		$(document).ready(function(){$("#Delete_form").slideDown(200);});
}

function hide_click()
{
	var AddForm=document.getElementById("Add_form");
	var UpdateForm=document.getElementById("Update_form");
	var DeleteForm=document.getElementById("Delete_form");
		$(document).ready(function(){$("#Add_form").slideUp(200);});
		$(document).ready(function(){$("#Update_form").slideUp(200);});
		$(document).ready(function(){$("#Delete_form").slideUp(200);});
}

function show_add_form()
{
	var AddForm=document.getElementById("Add_form");
	var UpdateForm=document.getElementById("Update_form");
	var DeleteForm=document.getElementById("Delete_form");
		
		AddForm.style.display="block";
		UpdateForm.style.display="none";
		DeleteForm.style.display="none";
}

function active_module()
{
	var AddSelector=document.getElementById("add_module");
	var UpdateSelector=document.getElementById("update_module");
	var DeleteSelector=document.getElementById("delete_module");
	
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