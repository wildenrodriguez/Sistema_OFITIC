document.addEventListener('DOMContentLoaded', function () {
    // Cargar DataTables si no está disponible
    if (typeof $.fn.DataTable == 'undefined') {
        loadDataTablesDependencies().then(initializeDataTable).catch(mostrarErrorDataTables);
    } else {
        initializeDataTable();
    }

    function loadDataTablesDependencies() {
        return new Promise(function (resolve, reject) {
            const cssLink = document.createElement('link');
            cssLink.rel = 'stylesheet';
            cssLink.href = 'https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css';
            document.head.appendChild(cssLink);

            const script = document.createElement('script');
            script.src = 'https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js';
            script.onload = function () {
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

    function initializeDataTable() {
        const tablaEquipos = $('#tabla-equipos').DataTable({
            ajax: {
                url: '',
                type: 'POST',
                data: { accion: 'consultar' },
                dataSrc: 'data',
                error: mostrarErrorDatos
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

            // Cargar bienes disponibles
            //cargarBienesDisponibles();
            $('#modal-equipo').modal('show');
        });

        // Editar equipo
        // Modificar la función de edición para recargar los bienes disponibles
        $('#tabla-equipos').on('click', '.btn-editar', function () {
            const id = $(this).data('id');
            const tr = $(this).closest('tr');
            const data = tablaEquipos.row(tr).data();

            if (data) {
                // Cargar bienes disponibles (excluyendo los ya asignados, excepto este si tiene)
                $.ajax({
                    url: '',
                    type: 'POST',
                    data: {
                        accion: 'cargar_bienes',
                        excluir_bien: data.nro_bien || null
                    },
                    success: function (response) {
                        const $select = $('#nro-bien');
                        $select.empty().append('<option value="" selected>No vincular a bien</option>');

                        response.data.forEach(function (bien) {
                            $select.append(
                                `<option value="${bien.codigo_bien}" ${data.nro_bien == bien.codigo_bien ? 'selected' : ''}>
                          ${bien.codigo_bien} - ${bien.tipo_bien}
                      </option>`
                            );
                        });

                        // Continuar con el resto de la edición
                        $('#modal-equipo-label').text('Editar Equipo');
                        $('#id-equipo').val(data.id_equipo);
                        $('#serial').val(data.serial);
                        $('#tipo').val(data.tipo);
                        $('#marca').val(data.id_marca);
                        $('#dependencia').val(data.id_dependencia);
                        $('#btn-guardar').text('Actualizar');
                        $('#btn-guardar').removeClass('btn-primary').addClass('btn-success');

                        $('#modal-equipo').modal('show');
                    }
                });
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

        // Guardar equipo (registrar/actualizar)
        $('#form-equipo').submit(function (e) {
            e.preventDefault();

            const formData = $(this).serializeArray();
            const accion = $('#id-equipo').val() ? 'modificar' : 'registrar';
            const $btn = $('#btn-guardar');

            // Mostrar loading
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
                        tablaEquipos.ajax.reload();
                    } else {
                        // Mostrar errores de validación
                        if (response.errors) {
                            Object.entries(response.errors).forEach(([field, error]) => {
                                $(`#${field}`).addClass('is-invalid');
                                $(`#error-${field}`).text(error);
                            });
                        } else {
                            Swal.fire('Error', response.message, 'error');
                        }
                    }
                },
                error: function () {
                    Swal.fire('Error', 'Error al procesar la solicitud', 'error');
                },
                complete: function () {
                    $btn.prop('disabled', false).text(accion === 'registrar' ? 'Registrar' : 'Actualizar');
                }
            });
        });

        // Cargar bienes disponibles para el select
        /*function cargarBienesDisponibles(bienActual = null) {
            $.ajax({
                url: '',
                type: 'POST',
                data: { 
                    accion: 'bienes_disponibles',
                    excluir_bien: bienActual
                },
                success: function(response) {
                    const $select = $('#nro-bien');
                    $select.empty().append('<option value="">No vincular a bien</option>');
                    
                    response.forEach(bien => {
                        $select.append(
                            `<option value="${bien.codigo_bien}">${bien.codigo_bien} - ${bien.tipo_bien}</option>`
                        );
                    });
                    
                    // Seleccionar el bien actual si existe
                    if (bienActual) {
                        $select.val(bienActual);
                    }
                }
            });
        }*/
    }

    function mostrarErrorDataTables() {
        const alertDiv = document.createElement('div');
        alertDiv.className = 'alert alert-danger';
        alertDiv.innerHTML = `
          <strong>Error al cargar la tabla:</strong> 
          No se pudo cargar la librería DataTables. Por favor recarga la página.
          <button class="btn btn-sm btn-outline-danger ms-2" onclick="window.location.reload()">
              Recargar
          </button>
      `;
        document.querySelector('.card-body').prepend(alertDiv);
    }

    function mostrarErrorDatos() {
        const tabla = document.getElementById('tabla-equipos');
        const tbody = tabla.querySelector('tbody');
        tbody.innerHTML = `
          <tr>
              <td colspan="7" class="text-center text-danger">
                  <i class="bi bi-exclamation-triangle"></i> 
                  Error al cargar los datos. Por favor intente recargar la página.
                  <button class="btn btn-sm btn-outline-danger ms-2" onclick="window.location.reload()">
                      <i class="bi bi-arrow-clockwise"></i> Recargar
                  </button>
              </td>
          </tr>
      `;
    }
});