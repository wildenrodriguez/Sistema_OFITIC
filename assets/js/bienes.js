$(document).ready(function () {
    if (typeof $.fn.DataTable === 'undefined') {
        console.error('DataTables no está cargado. Verifica las referencias.');
        return;
    }

    const tablaBienes = $('#tabla-bienes').DataTable({
        ajax: {
            url: '',
            type: 'POST',
            data: { accion: 'consultar' },
            dataSrc: 'data',
            error: function () {
                console.error('Error al cargar los datos de la tabla.');
            }
        },
        columns: [
            { data: 'codigo_bien' },
            { data: 'tipo_bien' },
            { data: 'estado' },
            { data: 'responsable' },
            { data: 'oficina' },
            { data: 'estatus', render: data => data == 1 ? 'Activo' : 'Inactivo' },
            {
                data: null,
                render: function (data, type, row) {
                    return `
                        <button class="btn btn-warning btn-sm btn-editar" data-id="${row.codigo_bien}">Editar</button>
                        <button class="btn btn-danger btn-sm btn-eliminar" data-id="${row.codigo_bien}">Eliminar</button>
                    `;
                }
            }
        ],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json'
        }
    });

    $('#btn-registrar').click(function () {
        $('#form-bien')[0].reset();
        $('#codigo-bien').val('');
        $('#modal-bien').modal('show');
    });

    $('#tabla-bienes').on('click', '.btn-editar', function () {
        const id = $(this).data('id');
        const data = tablaBienes.row($(this).closest('tr')).data();
        if (data) {
            $('#codigo-bien').val(data.codigo_bien);
            $('#tipo-bien').val(data.tipo_bien);
            $('#estado').val(data.estado);
            $('#ci-responsable').val(data.ci_responsable);
            $('#id-oficina').val(data.id_oficina);
            $('#estatus').val(data.estatus);
            $('#modal-bien').modal('show');
        }
    });

    $('#tabla-bienes').on('click', '.btn-eliminar', function () {
        const id = $(this).data('id');
        if (confirm('¿Está seguro de eliminar este bien?')) {
            $.post('', { accion: 'eliminar', codigo_bien: id }, function (response) {
                if (response.success) {
                    tablaBienes.ajax.reload();
                } else {
                    alert('Error al eliminar el bien.');
                }
            });
        }
    });

    $('#form-bien').submit(function (e) {
        e.preventDefault();
        const accion = $('#codigo-bien').val() ? 'modificar' : 'registrar';
        $.post('', $(this).serialize() + `&accion=${accion}`, function (response) {
            if (response.success) {
                $('#modal-bien').modal('hide');
                tablaBienes.ajax.reload();
            } else {
                alert('Error al guardar el bien.');
            }
        });
    });
});
