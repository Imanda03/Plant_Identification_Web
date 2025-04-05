

let sideBar = document.querySelector('.side-bar');

document.querySelector('#user-menu').onclick= ()=>{
    sideBar.classList.toggle('active');
    sideBar.style.right = "0";
}
document.querySelector('#close-side-bar').onclick = () =>{
    sideBar.classList.remove('active');
    sideBar.style.right = "-2000px";
}
