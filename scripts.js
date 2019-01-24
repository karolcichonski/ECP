function add_worker_click()
{
		var AddForm=document.getElementById("Add_form");
		var UpdateForm=document.getElementById("Update_form");
		var DeleteForm=document.getElementById("Delete_form");
		var PasswordForm=document.getElementById("Password_form");
		var AddSelector=document.getElementById("worker_add");
		
		UpdateForm.style.display="none";
		DeleteForm.style.display="none";
		PasswordForm.style.display="none";
		AddSelector.checked=true;

		$(document).ready(function(){
			$("#Add_form").slideToggle(200);
			});
}

function update_worker_click()
{
	var AddForm=document.getElementById("Add_form");
	var UpdateForm=document.getElementById("Update_form");
	var DeleteForm=document.getElementById("Delete_form");
	var PasswordForm=document.getElementById("Password_form");
	var UpdateSelector=document.getElementById("worker_update");
	AddForm.style.display="none";
	/* UpdateForm.style.display="block"; */
	DeleteForm.style.display="none";
	PasswordForm.style.display="none";
	UpdateSelector.style.borderBottomLeftRadius="15px";
	
	$(document).ready(function(){
		$("#Update_form").slideToggle(200);
		});
}

function delete_worker_click()
{
	var AddForm=document.getElementById("Add_form");
	var UpdateForm=document.getElementById("Update_form");
	var DeleteForm=document.getElementById("Delete_form");
	var PasswordForm=document.getElementById("Password_form");
	var DeleteSelector=document.getElementById("worker_delete");
	AddForm.style.display="none";
	UpdateForm.style.display="none";
	/* DeleteForm.style.display="block"; */
	PasswordForm.style.display="none";
	DeleteSelector.checked=true;
	
	$(document).ready(function(){
		$("#Delete_form").slideToggle(200);
		});
}

function change_password_click()
{
	var AddForm=document.getElementById("Add_form");
	var UpdateForm=document.getElementById("Update_form");
	var DeleteForm=document.getElementById("Delete_form");
	var PasswordForm=document.getElementById("Password_form");
	var PassSelector=document.getElementById("change_password");
	AddForm.style.display="none";
	UpdateForm.style.display="none";
	DeleteForm.style.display="none";
	/* PasswordForm.style.display="block"; */
	PassSelector.checked=true;
	
	$(document).ready(function(){
		$("#Password_form").slideToggle(200);
		});
}

function add_worker_selected()
{
		var AddForm=document.getElementById("Add_form");
		var UpdateForm=document.getElementById("Update_form");
		var DeleteForm=document.getElementById("Delete_form");
		var PasswordForm=document.getElementById("Password_form");
		var AddSelector=document.getElementById("worker_add");
		
		UpdateForm.style.display="none";
		DeleteForm.style.display="none";
		PasswordForm.style.display="none";
		//AddSelector.checked=true;

		$(document).ready(function(){
			$("#Add_form").slideToggle("slow");
			});
}

function update_worker_selected()
{
	var AddForm=document.getElementById("Add_form");
	var UpdateForm=document.getElementById("Update_form");
	var DeleteForm=document.getElementById("Delete_form");
	var PasswordForm=document.getElementById("Password_form");
	var UpdateSelector=document.getElementById("worker_update");
	AddForm.style.display="none";
	/* UpdateForm.style.display="block"; */
	DeleteForm.style.display="none";
	PasswordForm.style.display="none";
	UpdateSelector.checked=true;
	
	$(document).ready(function(){
		$("#Update_form").slideToggle("slow");
		});
}

function delete_worker_selected()
{
	var AddForm=document.getElementById("Add_form");
	var UpdateForm=document.getElementById("Update_form");
	var DeleteForm=document.getElementById("Delete_form");
	var PasswordForm=document.getElementById("Password_form");
	var DeleteSelector=document.getElementById("worker_delete");
	AddForm.style.display="none";
	UpdateForm.style.display="none";
	/* DeleteForm.style.display="block"; */
	PasswordForm.style.display="none";
	DeleteSelector.checked=true;
	
	$(document).ready(function(){
		$("#Delete_form").slideToggle("slow");
		});
}

function change_password_selected()
{
	var AddForm=document.getElementById("Add_form");
	var UpdateForm=document.getElementById("Update_form");
	var DeleteForm=document.getElementById("Delete_form");
	var PasswordForm=document.getElementById("Password_form");
	var PassSelector=document.getElementById("change_password");
	AddForm.style.display="none";
	UpdateForm.style.display="none";
	DeleteForm.style.display="none";
	/* PasswordForm.style.display="block"; */
	PassSelector.checked=true;
	
	$(document).ready(function(){
		$("#Password_form").slideToggle("slow");
		});
}

function ecp_formfield_hide(){
	var AddForm=document.getElementById("ecp_formfield");
	AddForm.style.display="none";
}

function add_click()
{
	var AddForm=document.getElementById("Add_form");
	var UpdateForm=document.getElementById("Update_form").style.display="none";
	var DeleteForm=document.getElementById("Delete_form").style.display="none";
		$(document).ready(function(){
			$("#Add_form").slideToggle(200);
			});
}

function update_click(){
	var AddForm=document.getElementById("Add_form").style.display="none";
	var UpdateForm=document.getElementById("Update_form");
	var DeleteForm=document.getElementById("Delete_form").style.display="none";
		$(document).ready(function(){
			$("#Update_form").slideToggle(200);
			});
}

function delete_click()
{
	var AddForm=document.getElementById("Add_form").style.display="none";
	var UpdateForm=document.getElementById("Update_form").style.display="none";
	var DeleteForm=document.getElementById("Delete_form");
		$(document).ready(function(){
			$("#Delete_form").slideToggle(200);
			});
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