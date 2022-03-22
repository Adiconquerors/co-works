$(document).ready(function () {


    window.dtDefaultOptions = {
        retrieve: true,
        responsive: true,
        dom: 'lBfrtip<"actions">',
        columnDefs: [],
        "iDisplayLength": 10,
        "aaSorting": [],
        stateSave: true,
        buttons: [
            {
                extend: 'copy',
                text: window.copyButtonTrans,
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'csv',
                text: window.csvButtonTrans,
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'excel',
                text: window.excelButtonTrans,
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdf',
                text: window.pdfButtonTrans,
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'print',
                text: window.printButtonTrans,
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'colvis',
                text: window.colvisButtonTrans,
                exportOptions: {
                    columns: ':visible'
                }
            },
        ]
    };
    $('.datatable').each(function () {
        if ($(this).hasClass('dt-select')) {
            window.dtDefaultOptions.select = {
                style: 'multi',
                selector: 'td:first-child'
            };

            window.dtDefaultOptions.columnDefs.push({
                orderable: false,
                className: 'select-checkbox',
                targets: 0
            });
        }
        window.dtDefaultOptions.buttons = [];
        $(this).attr("style","width:100%");
        $(this).dataTable(window.dtDefaultOptions);
    });


    $(document).on( 'init.dt', function ( e, settings ) {
        if (typeof window.route_mass_crud_entries_destroy != 'undefined') {
            $('.datatable, .ajaxTable').siblings('.actions').html('<a href="' + window.route_mass_crud_entries_destroy + '" class="btn btn-xs btn-danger js-delete-selected" style="margin-top:0.755em;margin-left: 20px;">'+window.deleteButtonTrans+'</a>');
        }
    });

});

function processAjaxTables() {
    $('.ajaxTable').each(function () {
        $(this).addClass('display responsive nowrap');

        window.dtDefaultOptions.processing = true;
        window.dtDefaultOptions.serverSide = true;
        if ($(this).hasClass('dt-select')) {
            window.dtDefaultOptions.select = {
                style: 'multi',
                selector: 'td:first-child'
            };

            window.dtDefaultOptions.columnDefs.push({
                orderable: false,
                className: 'select-checkbox',
                targets: 0
            });
        }
        $(this).DataTable(window.dtDefaultOptions);
        if (typeof window.route_mass_crud_entries_destroy != 'undefined') {
            $(this).siblings('.actions').html('<a href="' + window.route_mass_crud_entries_destroy + '" class="btn btn-xs btn-danger js-delete-selected" style="margin-top:0.755em;margin-left: 20px;">'+window.deleteButtonTrans+'</a>');
        }
    });
}

window.dtDefaultOptionsNew = {
    retrieve: true,
    responsive: true,
    dom: 'lBfrtip<"actions">',
    columnDefs: [],
    "iDisplayLength": 10,
    "aaSorting": [],
    ajax:{
        'url' : '',
        'data' : ''
    },
    stateSave: true,
    buttons: [
        {
            extend: 'copy',
            text: window.copyButtonTrans,
            exportOptions: {
                columns: ':visible'
            }
        },
        {
            extend: 'csv',
            text: window.csvButtonTrans,
            exportOptions: {
                columns: ':visible'
            }
        },
        {
            extend: 'excel',
            text: window.excelButtonTrans,
            exportOptions: {
                columns: ':visible'
            }
        },
        {
            extend: 'pdf',
            text: window.pdfButtonTrans,
            exportOptions: {
                columns: ':visible'
            }
        },
        {
            extend: 'print',
            text: window.printButtonTrans,
            exportOptions: {
                columns: ':visible'
            }
        },
        {
            extend: 'colvis',
            text: window.colvisButtonTrans,
            exportOptions: {
                columns: ':visible'
            }
        },
    ]
};
var ajaxTableNew;

function processAjaxTablesNew() {
    $('.ajaxTable').each(function () {
        $(this).addClass('display responsive nowrap');

        window.dtDefaultOptionsNew.processing = true;
        window.dtDefaultOptionsNew.serverSide = true;
        if ($(this).hasClass('dt-select')) {
            window.dtDefaultOptionsNew.select = {
                style: 'multi',
                selector: 'td:first-child'
            };

            window.dtDefaultOptionsNew.columnDefs.push({
                orderable: false,
                className: 'select-checkbox',
                targets: 0
            });
        }

        window.dtDefaultOptionsNew.ajax.data = function(d) {
            d.date_filter = $('#date_filter').val();
            d.date_type = $('#date_type').val();
            d.paymentstatus = $('#paymentstatus').val();
            d.status = $('#status_id_filter').val();
            d.customer = $('#customer').val();
            d.supplier     = $('#supplier').val();
            d.employee     = $('#employee').val();
            d.invoice_no     = $('#invoice_no_filter').val();

            d.currency_id = $('#currency_id_filter').val();

            d.contact_type = $('#contact_type_id_filter').val();
            d.project_type = $('#project_type_id_filter').val();
            d.country_id   = $('#country_id_filter').val();
            d.group_id     = $('#group_id_filter').val();

            d.priority      = $('#priority').val();
            d.projectStatus = $('#project_status_id_filter').val();

        };
        ajaxTableNew = $(this).DataTable(window.dtDefaultOptionsNew);
        if (typeof window.route_mass_crud_entries_destroy != 'undefined') {
            $(this).siblings('.actions').html('<a href="' + window.route_mass_crud_entries_destroy + '" class="btn btn-xs btn-danger js-delete-selected" style="margin-top:0.755em;margin-left: 20px;">'+window.deleteButtonTrans+'</a>');
        }
    });
}

$('#search-form').on('submit', function(e) {
    ajaxTableNew.draw();
    e.preventDefault();
});

function customSearch( column, search ) {
    ajaxTableNew.columns( column ).search( search ).draw();
}




/// Customize

