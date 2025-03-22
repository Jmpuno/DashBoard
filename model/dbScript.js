const open1 = document.querySelectorAll(".dAct-status-btn"), open2 = document.querySelectorAll(".act-status-btn");
const close1 = document.querySelectorAll(".close1-btn"),close2 = document.querySelectorAll(".close2-btn");
const modalCont1 = document.getElementById("deactivation_mod"), modalCont2 = document.getElementById("activation_mod");
const open3 = document.querySelectorAll(".updt-btn");
const updateModal = document.getElementById("updt_mod");
const close3 = document.querySelectorAll(".close3-btn");
const cancelUpdate = document.querySelectorAll(".cancelUpdt-Btn");
const noBtn = document.querySelectorAll(".no-btn");
const selectedPic = document.getElementById("profilePic");
const picContainer = document.getElementById("picture");

function open(doc, modal){  // for opening modal
    doc.forEach(button => {
        button.addEventListener("click", function(){
            let studentID = this.getAttribute("data-studentid");
            let studentName = this.getAttribute("data-studentname");
            
            let homeAddress = this.getAttribute("data-homeadd");
            let contact = this.getAttribute("data-contact");
            let emergencyContact = this.getAttribute("data-emergencynum");
            let profilePic = this.getAttribute("data-profilePic");
            document.getElementById("modalStudentID").textContent = studentID;
            document.getElementById("modalStudentName").textContent = studentName;
         
            document.getElementById("updt-Add").textContent = homeAddress;
            document.getElementById("updtContactNum").value = contact;
            document.getElementById("updtEmergencyNum").value = emergencyContact;
            document.getElementById("studentId").value = studentID;
            document.getElementById("picture").src = "http://localhost/matthew/pictures/" + profilePic;
           
            //preview the profile pic before uploading
            selectedPic.addEventListener("change", function(event){
                picContainer.src = URL.createObjectURL(event.target.files[0]);
            });

           


            modal.style.opacity = 1;
            modal.style.display = "block";
            modal.style.pointerEvents = "auto";
        })
    })
};


function close(doc, modal){ // for closing modal
    doc.forEach(button => {
        button.addEventListener("click", function(){
            modal.style.opacity = 0;
            modal.style.display = "none";
            modal.style.pointerEvents = "none";
        })
    })
}
function noButton(doc, modal1, modal2){  // for no respond in status change modal
    doc.forEach(button => {
        button.addEventListener("click", function(){
            alert("Status Change Canceled");
            modal1.style.opacity = 0;
            modal1.style.display = "none";
            modal2.style.opacity = 0;
            modal2.style.display = "none";
        })
    })
}
function updateCancellation(doc, modal1){  // for no respond in status change modal
    doc.forEach(button => {
        button.addEventListener("click", function(){
            alert("Update information has been Cancel");
            modal1.style.opacity = 0;
            modal1.style.display = "none";
            
        })
    })
}

//  STATUS CHANGE FUNCTIONALITIES:

// on-click of act/deact button, open status change modal:
open1.forEach(button => {
    button.addEventListener("click", open(open1, modalCont1))
});
open2.forEach(button => {
    button.addEventListener("click", open(open2, modalCont2))
});

// on-click of act/deact button, close status change modal:
close1.forEach(button => {
    button.addEventListener("click", close(close1, modalCont1))
});
close2.forEach(button => {
    button.addEventListener("click", close(close2, modalCont2))
});

// if user respond or click no-button in status change modal
noButton(noBtn, modalCont1, modalCont2);

open3.forEach(button => {
    button.addEventListener("click", open(open3, updateModal))
});

cancelUpdate.forEach(button =>{
    button.addEventListener("click", updateCancellation(cancelUpdate,updateModal));
});

close3.forEach(button => {
    button.addEventListener("click", close(close3, updateModal))
});












