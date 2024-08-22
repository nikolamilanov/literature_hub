const userCreateButton = document.querySelector(".user-create-button");
const adminCreateButton = document.querySelector(".admin-create-button");
const adminUpdateButton = document.querySelector(".admin-update-button");
const adminDeleteButton = document.querySelector(".admin-delete-button");

if(userCreateButton != null){
    userCreateButton.addEventListener("click", function(){
        document.getElementById("user-create-form").classList.toggle("display-form");
    });
}
if(adminCreateButton != null){
    adminCreateButton.addEventListener("click", function(){
        document.getElementById("admin-create-form").classList.toggle("display-form");
    });
}
if(adminUpdateButton != null){
    adminUpdateButton.addEventListener("click", function(){
        document.getElementById("admin-update-form").classList.toggle("display-form");
    });
}
if(adminDeleteButton != null){
    adminDeleteButton.addEventListener("click", function(){
        document.getElementById("admin-delete-form").classList.toggle("display-form");
    });
}