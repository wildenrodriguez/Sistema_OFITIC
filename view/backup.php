
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
            <script>
// Pasar variable PHP a JS
const boton = document.querySelector('button[name="generar"]') || null;
const botonEliminar = document.querySelector('button[name="eliminar"]') || null;
const botonImportar = document.querySelector('button[name="importar"]') || null;

boton.addEventListener('click', function(event) {

    Swal.fire({
    title: 'Procesando',
    html: 'Por favor espera...',
    allowOutsideClick: false,
    didOpen: () => {
        Swal.showLoading();
    }
});

// Simular una operación que tarda 2 segundos
setTimeout(() => {
    Swal.fire({
        title: '¡Completado!',
        text: 'La operación se realizó con éxito',
        icon: 'success'
    });
}, 200);
});

botonEliminar.addEventListener('click', function(event) {

    Swal.fire({
    title: 'Procesando',
    html: 'Por favor espera...',
    allowOutsideClick: false,
    didOpen: () => {
        Swal.showLoading();
    }
});

// Simular una operación que tarda 2 segundos
setTimeout(() => {
    Swal.fire({
        title: '¡Completado!',
        text: 'La operación se realizó con éxito',
        icon: 'success'
    });
}, 200);
});

botonImportar.addEventListener('click', function(event) {

    Swal.fire({
    title: 'Procesando',
    html: 'Por favor espera...',
    allowOutsideClick: false,
    didOpen: () => {
        Swal.showLoading();
    }
});

// Simular una operación que tarda 2 segundos
setTimeout(() => {
    Swal.fire({
        title: '¡Completado!',
        text: 'La operación se realizó con éxito',
        icon: 'success'
    });
}, 1500);
});
</script>
</body>

</html>