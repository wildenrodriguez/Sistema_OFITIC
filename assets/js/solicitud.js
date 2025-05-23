$(document).ready(function () {
    // Inicialización
    consultar();
    registrarEntrada();
    inicializarEventos();
    capaValidar();

    // Configuración del modal
    $('#solicitud').on('show.bs.modal', function (event) {
        const button = $(event.relatedTarget);
        const modal = $(this);
        const esEdicion = button.data('accion') === 'editar';

        if (esEdicion) {
            cargarDatosSolicitud(button.data('id'));
            modal.find('.modal-title').text('Editar Solicitud');
            $("#enviar2").text("Modificar");
        } else {
            limpiarFormularioModal();
            modal.find('.modal-title').text('Nueva Solicitud');
            $("#enviar2").text("Registrar");
        }
    });
});

// Función para inicializar eventos
function inicializarEventos() {
    // Evento para el botón de enviar en el modal
    $("#enviar2").on("click", function () {
        const accion = $(this).text();
        const formularioValido = validarFormularioModal();

        if (formularioValido) {
            const datos = new FormData();
            datos.append(accion.toLowerCase(), accion.toLowerCase());

            // Datos comunes
            datos.append('motivo', $("#motivo2").val());
            datos.append('area', $("#area2").val());
            datos.append('cedula', $("#solicitante2").val());
            datos.append('serial', $("#equipo2").val());
            datos.append('dependencia', $("#dependencia2").val());

            // Datos específicos para modificación
            if (accion === "Modificar") {
                datos.append('nrosol', $("#nro").val());
            }

            enviaAjax(datos);
        }
    });

    // Evento para cambio de dependencia en el modal
    $("#dependencia2").on("change", function () {
        const dependenciaId = $(this).val();
        if (dependenciaId) {
            cargarEquiposPorDependencia(dependenciaId);
            cargarSolicitantesPorDependencia(dependenciaId);
        } else {
            $("#equipo2").empty().append('<option value="" selected>Seleccionar</option>');
            $("#solicitante2").empty().append('<option value="" selected hidden>Seleccionar solicitante</option>');
        }
        habilitarBotonEnviar();
    });

    // Evento para el botón de registrar en la vista principal
    $("#btn-registrar").on("click", function () {
        limpiarFormularioPrincipal();
        $("#modalTitleId").text("Registrar Solicitud");
        $("#enviar").text("Registrar");
        $("#solicitud").modal("show");
    });
}

// Función para consultar solicitudes
function consultar() {
    const datos = new FormData();
    datos.append('consultar', 'consultar');
    enviaAjax(datos);
}

// Función para registrar entrada al módulo
function registrarEntrada() {
    const datos = new FormData();
    datos.append('entrada', 'entrada');
    enviaAjax(datos);
}

// Función para cargar datos de una solicitud específica
function cargarDatosSolicitud(id) {
    $.ajax({
        url: '',
        type: 'POST',
        data: { action: 'consultar_por_id', id: id },
        dataType: 'json',
        success: function(response) {
            if (response.resultado === "success") {
                const solicitud = response.datos;
                
                // Llenar campos básicos
                $("#nro").val(solicitud.nro_solicitud);
                $("#motivo2").val(solicitud.motivo);
                $("#sol").val(solicitud.nombre_solicitante);
                
                // Seleccionar área
                $("#area2").val(solicitud.id_area);
                
                // Cargar y seleccionar dependencia
                cargarDependenciasModal(solicitud.id_dependencia);
                
                // Cargar equipos y solicitantes después de seleccionar dependencia
                setTimeout(() => {
                    if (solicitud.id_dependencia) {
                        cargarEquiposPorDependencia(solicitud.id_dependencia, solicitud.serial_equipo);
                        cargarSolicitantesPorDependencia(solicitud.id_dependencia, solicitud.cedula_solicitante);
                    }
                }, 300);
                
                // Habilitar botón
                $('#enviar2').prop('disabled', false);
            } else {
                mensajes("error", null, "Error al cargar datos", response.mensaje);
            }
        },
        error: function(xhr, status, error) {
            mensajes("error", null, "Error al cargar datos", error);
        }
    });
}

// Función para cargar dependencias en el modal
function cargarDependenciasModal(dependenciaSeleccionada = '') {
    $.ajax({
        url: '',
        type: 'POST',
        data: { action: 'load_dependencias' },
        dataType: 'json',
        success: function(response) {
            const $select = $('#dependencia2');
            $select.empty().append('<option value="" selected hidden>Seleccionar</option>');
            
            response.forEach(dep => {
                const selected = dep.id == dependenciaSeleccionada ? 'selected' : '';
                $select.append(`<option value="${dep.id}" ${selected}>${dep.nombre}</option>`);
            });
        },
        error: function() {
            mensajes('error', null, 'Error al cargar dependencias');
        }
    });
}

// Función para cargar equipos por dependencia
function cargarEquiposPorDependencia(dependenciaId, equipoSeleccionado = '') {
    $.ajax({
        url: '',
        type: 'POST',
        data: { action: 'load_equipos', dependencia_id: dependenciaId },
        dataType: 'json',
        success: function(response) {
            const $select = $('#equipo2');
            $select.empty().append('<option value="" selected>Seleccionar</option>');
            
            response.forEach(equipo => {
                const selected = equipo.serial == equipoSeleccionado ? 'selected' : '';
                $select.append(`<option value="${equipo.serial}" ${selected}>${equipo.serial} - ${equipo.tipo}</option>`);
            });
        },
        error: function() {
            mensajes('error', null, 'Error al cargar equipos');
        }
    });
}

// Función para cargar solicitantes por dependencia
function cargarSolicitantesPorDependencia(dependenciaId, solicitanteSeleccionado = '') {
    $.ajax({
        url: '',
        type: 'POST',
        data: { action: 'load_solicitantes', dependencia_id: dependenciaId },
        dataType: 'json',
        success: function(response) {
            const $select = $('#solicitante2');
            $select.empty().append('<option value="" selected hidden>Seleccionar solicitante</option>');
            
            response.forEach(solicitante => {
                const selected = solicitante.cedula == solicitanteSeleccionado ? 'selected' : '';
                $select.append(`<option value="${solicitante.cedula}" ${selected}>${solicitante.nombre} - ${solicitante.cedula}</option>`);
            });
        },
        error: function() {
            mensajes('error', null, 'Error al cargar solicitantes');
        }
    });
}

// Capa de validación
function capaValidar() {
    // Validación para el motivo en el modal
    $("#motivo2").on("keypress", function (e) {
        validarKeyPress(/^[0-9 a-zA-ZáéíóúüñÑçÇ -.,\b]*$/, e);
    });
    
    $("#motivo2").on("keyup", function () {
        validarKeyUp(
            /^[0-9 a-zA-ZáéíóúüñÑçÇ -.,]{3,200}$/, 
            $(this), 
            $("#smotivo2"), 
            "El motivo debe tener entre 3 y 200 caracteres"
        );
        habilitarBotonEnviar();
    });
    
    // Validación para los selects en el modal
    $("#area2, #dependencia2, #equipo2, #solicitante2").on("change", function() {
        habilitarBotonEnviar();
    });
}

// Función para validar el formulario del modal
function validarFormularioModal() {
    if (validarKeyUp(
        /^[0-9 a-zA-ZáéíóúüñÑçÇ -.,]{3,200}$/, 
        $("#motivo2"), 
        $("#smotivo2"), 
        ""
    ) == 0) {
        mensajes("error", 10000, "Verifica", "El motivo debe tener entre 3 y 200 caracteres");
        return false;
    }
    
    if ($("#area2").val() === "") {
        mensajes("error", 10000, "Verifica", "Debe seleccionar un área");
        return false;
    }
    
    if ($("#dependencia2").val() === "") {
        mensajes("error", 10000, "Verifica", "Debe seleccionar una dependencia");
        return false;
    }
    
    if ($("#solicitante2").val() === "") {
        mensajes("error", 10000, "Verifica", "Debe seleccionar un solicitante");
        return false;
    }
    
    return true;
}

// Función para habilitar/deshabilitar el botón de enviar en el modal
function habilitarBotonEnviar() {
    const motivoValido = validarKeyUp(
        /^[0-9 a-zA-ZáéíóúüñÑçÇ -.,]{3,200}$/, 
        $("#motivo2"), 
        $("#smotivo2"), 
        ""
    );
    
    const selectsValidos = (
        $("#area2").val() !== "" &&
        $("#dependencia2").val() !== "" &&
        $("#solicitante2").val() !== ""
    );
    
    $("#enviar2").prop("disabled", !(motivoValido && selectsValidos));
}

// Función para enviar datos via AJAX
function enviaAjax(datos) {
    $.ajax({
        async: true,
        url: "",
        type: "POST",
        contentType: false,
        data: datos,
        processData: false,
        cache: false,
        timeout: 10000,
        beforeSend: function() {
            // Mostrar loader si es necesario
        },
        success: function(respuesta) {
            try {
                const response = JSON.parse(respuesta);
                
                switch(response.resultado) {
                    case "success":
                        $("#solicitud").modal("hide");
                        mensajes("success", 10000, response.mensaje, null);
                        consultar();
                        break;
                        
                    case "consultar":
                        crearDataTable(response.datos);
                        break;
                        
                    case "error":
                        mensajes("error", null, response.mensaje, null);
                        break;
                        
                    case "entrada":
                        // No action needed
                        break;
                        
                    default:
                        mensajes("error", null, "Respuesta no reconocida", null);
                }
            } catch (e) {
                mensajes("error", null, "Error en JSON", `${e.name}: ${e.message}`);
            }
        },
        error: function(xhr, status, error) {
            if (status === "timeout") {
                mensajes("error", null, "Servidor ocupado", "Intente de nuevo");
            } else {
                mensajes("error", null, "Error en la solicitud", error);
            }
        },
        complete: function() {
            // Ocultar loader si es necesario
        }
    });
}

// Función para crear la tabla DataTable
function crearDataTable(datos) {
    if ($.fn.DataTable.isDataTable('#tabla1')) {
        $('#tabla1').DataTable().destroy();
    }
    
    $('#tabla1').DataTable({
        data: datos,
        columns: [
            { data: 'ID' },
            { data: 'Solicitante' },
            { data: 'Cedula' },
            { data: 'Equipo' },
            { data: 'Motivo' },
            { data: 'Estado' },
            { data: 'Inicio' },
            { data: 'Resultado' },
            {
                data: null, 
                render: function(data, type, row) {
                    return `
                        <button onclick="rellenar(this, 'editar')" class="btn btn-update" title="Modificar">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                        <button onclick="rellenar(this, 'eliminar')" class="btn btn-danger" title="Eliminar">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    `;
                }
            }
        ],
        order: [[0, 'desc']],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
        }
    });
}

// Función para rellenar el formulario al editar
function rellenar(boton, accion) {
    const linea = $(boton).closest('tr');
    const id = $(linea).find('td:eq(0)').text();
    
    if (accion === 'editar') {
        // Mostrar modal con datos para editar
        $('#solicitud').modal('show');
        cargarDatosSolicitud(id);
    } else {
        // Confirmar eliminación
        confirmarEliminacion(id);
    }
}

// Función para confirmar eliminación
async function confirmarEliminacion(id) {
    const confirmado = await confirmarAccion(
        "¿Eliminar Solicitud?", 
        "¿Está seguro que desea eliminar esta solicitud?", 
        "warning"
    );
    
    if (confirmado) {
        const datos = new FormData();
        datos.append('eliminar', 'eliminar');
        datos.append('nrosol', id);
        enviaAjax(datos);
    }
}

// Función para limpiar el formulario del modal
function limpiarFormularioModal() {
    $("#nro").val("");
    $("#motivo2").val("").removeClass("is-valid is-invalid");
    $("#sol").val("");
    $("#area2").val("").removeClass("is-valid is-invalid");
    $("#dependencia2").val("").removeClass("is-valid is-invalid");
    $("#equipo2").empty().append('<option value="" selected>Seleccionar</option>');
    $("#solicitante2").empty().append('<option value="" selected hidden>Seleccionar solicitante</option>');
    $("#enviar2").prop("disabled", true);
}

// Función para limpiar el formulario principal
function limpiarFormularioPrincipal() {
    // Implementar si es necesario
}