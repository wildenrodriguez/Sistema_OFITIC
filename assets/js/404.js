const back = () => window.history.go(-1);

const button = document.getElementById('back');

button.addEventListener("click",back);