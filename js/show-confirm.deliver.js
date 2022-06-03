window.onload = function(){
    showPromt();
}

setInterval(function(){
    showPromt()
},9000);

function showPromt(){
    let prompt = document.querySelector('.ask-user');
    prompt.classList.toggle("hide");
}
