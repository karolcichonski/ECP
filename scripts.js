function add_worker_selected()
{
	var AddForm=document.getElementById("Add_form");
	var UpdateForm=document.getElementById("Update_form");
	var DeleteForm=document.getElementById("Delete_form");
	var PasswordForm=document.getElementById("Password_form");
	var AddSelector=document.getElementById("worker_add");
	AddForm.style.display="block";
	UpdateForm.style.display="none";
	DeleteForm.style.display="none";
	PasswordForm.style.display="none";
	AddSelector.checked=true;
}

function update_worker_selected()
{
	var AddForm=document.getElementById("Add_form");
	var UpdateForm=document.getElementById("Update_form");
	var DeleteForm=document.getElementById("Delete_form");
	var PasswordForm=document.getElementById("Password_form");
	var UpdateSelector=document.getElementById("worker_update");
	AddForm.style.display="none";
	UpdateForm.style.display="block";
	DeleteForm.style.display="none";
	PasswordForm.style.display="none";
	UpdateSelector.checked=true;
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
	DeleteForm.style.display="block";
	PasswordForm.style.display="none";
	DeleteSelector.checked=true;
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
	PasswordForm.style.display="block";
	PassSelector.checked=true;
}

function ecp_formfield_hide(){
	var AddForm=document.getElementById("ecp_formfield");
	AddForm.style.display="none";
}
