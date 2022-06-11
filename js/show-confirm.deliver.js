window.onload = function(){
    showPromt();
}

setInterval(function(){
    showPromt()
},5000);

function showPromt(){
    let prompt = document.querySelector('.ask-user');
    prompt.classList.toggle("hide");
}
