function add_worker_selected()
{
	var AddForm=document.getElementById("Add_form");
	var UpdateForm=document.getElementById("Update_form");
	var DeleteForm=document.getElementById("Delete_form");
	AddForm.style.display="block";
	UpdateForm.style.display="none";
	DeleteForm.style.display="none";
}

function update_worker_selected()
{
	var AddForm=document.getElementById("Add_form");
	var UpdateForm=document.getElementById("Update_form");
	var DeleteForm=document.getElementById("Delete_form");
	AddForm.style.display="none";
	UpdateForm.style.display="block";
	DeleteForm.style.display="none";
}

function delete_worker_selected()
{
	var AddForm=document.getElementById("Add_form");
	var UpdateForm=document.getElementById("Update_form");
	var DeleteForm=document.getElementById("Delete_form");
	AddForm.style.display="none";
	UpdateForm.style.display="none";
	DeleteForm.style.display="block";
}
