document.addEventListener('DOMContentLoaded', function () {
    // Verificar si jQuery está cargado
    if (typeof jQuery == 'undefined') {
        console.error('jQuery no está cargado');
        mostrarErrorDatos('jQuery no está cargado. La página necesita recargarse.');
        return;
    }

    // Función para cargar DataTables si no está disponible
    function cargarDataTables() {
        return new Promise((resolve, reject) => {
            // Verificar si DataTables ya está cargado
            if (typeof $.fn.DataTable !== 'undefined') {
                resolve();
                return;
            }

            // Cargar CSS de DataTables
            const cssLink = document.createElement('link');
            cssLink.rel = 'stylesheet';
            cssLink.href = 'https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css';
            document.head.appendChild(cssLink);

            // Cargar JavaScript de DataTables
            const script = document.createElement('script');
            script.src = 'https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js';
            script.onload = function() {
                // Cargar integración con Bootstrap
                const bsScript = document.createElement('script');
                bsScript.src = 'https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js';
                bsScript.onload = resolve;
                bsScript.onerror = reject;
                document.body.appendChild(bsScript);
            };
            script.onerror = reject;
            document.body.appendChild(script);
        });
    }

    // Función principal para inicializar la tabla
    function inicializarTabla() {
        // Verificar nuevamente que DataTables está disponible
        if (typeof $.fn.DataTable === 'undefined') {
            mostrarErrorDatos('DataTables no se pudo cargar correctamente.');
            return;
        }

        const tablaEquipos = $('#tabla-equipos').DataTable({
            ajax: {
                url: '',
                type: 'POST',
                data: { accion: 'consultar' },
                dataSrc: 'data',
                error: function(xhr, error, thrown) {
                    mostrarErrorDatos('Error al cargar los datos de la tabla.');
                }
            },
            columns: [
                { data: 'id_equipo' },
                { data: 'serial' },
                { data: 'tipo' },
                { data: 'marca' },
                {
                    data: 'nro_bien',
                    render: function (data, type, row) {
                        return data ? `${data} (${row.tipo_bien || 'Sin tipo'})` : 'No asignado';
                    }
                },
                { data: 'dependencia' },
                {
                    data: null,
                    render: function (data, type, row) {
                        return `
                            <div class="btn-group">
                                <button class="btn btn-warning btn-sm btn-editar" data-id="${row.id_equipo}" title="Editar">
                                    <i class="fa-solid fa-pencil"></i>
                                </button>
                                <button class="btn btn-danger btn-sm btn-eliminar" data-id="${row.id_equipo}" title="Eliminar">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        `;
                    },
                    orderable: false
                }
            ],
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json'
            }
        });

        // Registrar nuevo equipo
        $('#btn-registrar').click(function () {
            $('#modal-equipo-label').text('Registrar Nuevo Equipo');
            $('#form-equipo')[0].reset();
            $('#id-equipo').val('');
            $('#btn-guardar').text('Registrar').removeClass('btn-success').addClass('btn-primary');
            $('#modal-equipo').modal('show');
        });

        // Editar equipo
        $('#tabla-equipos').on('click', '.btn-editar', function () {
            const id = $(this).data('id');
            const tr = $(this).closest('tr');
            const data = tablaEquipos.row(tr).data();

            if (data) {
                $('#modal-equipo-label').text('Editar Equipo');
                $('#id-equipo').val(data.id_equipo);
                $('#serial').val(data.serial);
                $('#tipo').val(data.tipo);
                $('#marca').val(data.id_marca);
                $('#dependencia').val(data.id_dependencia);
                $('#nro-bien').val(data.nro_bien || '');
                $('#btn-guardar').text('Actualizar').removeClass('btn-primary').addClass('btn-success');
                $('#modal-equipo').modal('show');
            }
        });

        // Eliminar equipo
        $('#tabla-equipos').on('click', '.btn-eliminar', function () {
            const id = $(this).data('id');

            Swal.fire({
                title: '¿Eliminar equipo?',
                text: "Esta acción no se puede deshacer",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '',
                        type: 'POST',
                        data: { accion: 'eliminar', id: id },
                        success: function (response) {
                            if (!response.success) {
                                Swal.fire('¡Eliminado!', response.message, 'success');
                                tablaEquipos.ajax.reload();
                            } else {
                                Swal.fire('Error', response.message, 'error');
                            }
                        },
                        error: function () {
                            Swal.fire('Error', 'Error al eliminar el equipo', 'error');
                        }
                    });
                }
            });
        });

        // Guardar equipo
        $('#form-equipo').submit(function (e) {
            e.preventDefault();
            guardarEquipo(tablaEquipos);
        });
    }

    // Función para guardar equipo (registrar/actualizar)
    function guardarEquipo(tabla) {
        const formData = $('#form-equipo').serializeArray();
        const accion = $('#id-equipo').val() ? 'modificar' : 'registrar';
        const $btn = $('#btn-guardar');

        $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Procesando...');

        $.ajax({
            url: '',
            type: 'POST',
            data: {
                accion: accion,
                ...Object.fromEntries(formData.map(item => [item.name, item.value]))
            },
            success: function (response) {
                if (!response.success) {
                    Swal.fire('¡Éxito!', response.message, 'success');
                    $('#modal-equipo').modal('hide');
                    tabla.ajax.reload();
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            },
            error: function () {
                Swal.fire('Error', 'Error al procesar la solicitud', 'error');
            },
            complete: function () {
                $btn.prop('disabled', false).text(accion === 'registrar' ? 'Registrar' : 'Actualizar');
            }
        });
    }

    // Función para mostrar errores
    function mostrarErrorDatos(mensaje) {
        const tabla = document.getElementById('tabla-equipos');
        if (!tabla) return;

        const tbody = tabla.querySelector('tbody');
        if (!tbody) return;

        tbody.innerHTML = `
            <tr>
                <td colspan="7" class="text-center text-danger">
                    <i class="bi bi-exclamation-triangle"></i> 
                    ${mensaje || 'Error al cargar los datos.'}
                    <button class="btn btn-sm btn-outline-danger ms-2" onclick="window.location.reload()">
                        <i class="bi bi-arrow-clockwise"></i> Recargar
                    </button>
                </td>
            </tr>
        `;
    }

    // Cargar DataTables y luego inicializar la tabla
    cargarDataTables()
        .then(inicializarTabla)
        .catch(function(error) {
            console.error('Error al cargar DataTables:', error);
            mostrarErrorDatos('Error al cargar las dependencias necesarias.');
        });
});