const btnmod = document.querySelectorAll('#btnmod');
const btnreg = document.querySelector('#btnreg');
const serial = document.getElementById('serial');
const nro_bien = document.getElementById('nro_bien');
const marca = document.getElementById('marca');
const tipo = document.getElementById('tipo');
const submit = document.getElementById('submit');

for(i=0;i<btnmod.length;i++){
  btnmod[i].addEventListener('click',function(e){
    e = e.target;
    while (e.tagName != 'TR') {
      e = e.parentNode;
    }
    
    serial.value = e.children[1].textContent;
    nro_bien.value = e.children[4].textContent;
    marca.value = e.children[3].textContent;
    tipo.value = e.children[2].textContent;
    submit.name = "modificar";
    submit.textContent = "Guardar Cambios";
    submit.value = e.children[1].textContent;

  });
}

btnreg.addEventListener('click',function(){
  submit.name = "registrar";
  submit.textContent = "Registrar Equipo";
  serial.value = "";
  nro_bien.value = "";
  marca.value = "";
  tipo.value = "";
  submit.removeAttribute('value');
});