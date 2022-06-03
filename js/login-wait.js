let btn = document.querySelector(".btn")

btn.addEventListener("click",()=>{
    let p = document.querySelector("p");
    p.classList.add("wait")
    p.classList.remove("hide");
})

let btn1 = document.querySelector(".btn")
btn1.addEventListener("click",()=>{
    let p = document.createElement("p")
    p.innerText = "updating username and password.."
    let div = document.querySelector(".update-box");
    div.appendChild(p);
})