@extends('backend.layouts.app')

@section('title')
    {{$page_title}}
@endsection

@push('style')

@endpush

@section('content_head')
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-subheader__main">
        <div class="kt-subheader__breadcrumbs">
            <a href="javascript:void(0);" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
            <span class="kt-subheader__breadcrumbs-separator"></span>
            <a href="{{url('admin')}}" class="kt-subheader__breadcrumbs-link">Dashboard</a>
            <span class="kt-subheader__breadcrumbs-separator"></span>
            <a href="javascript:void(0);" class="kt-subheader__breadcrumbs-link">
                {{$sub_title}} </a>

            <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
        </div>
    </div>
    <div class="kt-subheader__toolbar">
        <div class="kt-subheader__wrapper">
            <button type="button" onclick="show_modal(modal_title='Add New Module', btn_text='Save')" class="btn btn-brand btn-icon-sm btn-sm">
                <i class="fas fa-plus-square"></i> Add New
            </button>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

    <!--begin::Portlet-->
    <div class="kt-portlet kt-faq-v1">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h4 class=" font-weight-bold">
                   <i class="{{$page_icon}}"></i> {{$sub_title}}
                </h4>
            </div>

        </div>
        <div class="kt-portlet__body">
            <div class="row">
                <div class="col-xl-12 order-2 order-xl-1 py-25px">
                    <form method="POST" id="form-filter" class="m-form m-form--fit m--margin-bottom-20">
                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label>Name</label>
                                <input type="text" class="form-control" name="module_name" id="module_name" placeholder="Enter module name" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="mt-25px">    
                                    <button id="btn-reset" class="btn btn-danger btn-sm btn-elevate btn-icon float-right" type="button"
                                    data-skin="dark" data-toggle="kt-tooltip" data-placement="top" title="" data-original-title="Reset">
                                    <i class="fas fa-undo-alt"></i></button>

                                    <button id="btn-filter" class="btn btn-info btn-sm btn-elevate btn-icon mr-2 float-right" type="button"
                                    data-skin="dark" data-toggle="kt-tooltip" data-placement="top" title="" data-original-title="Search">
                                    <i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <table class="table table-striped table-bordered table-hover table-checkable" id="dataTable">
                        <thead>
                            <tr>
                                <th>
                                    <label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid">
                                        <input type="checkbox" class="selectall" onchange="select_all()">&nbsp;<span></span>
                                    </label>
                                </th>
                                <th>SR</th>
                                <th>Module</th>
                                <th>Module Link</th>
                                <th>Icon</th>
                                <th>Parent</th>
                                <th>Sequence</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table> 
                </div>
            </div>
        </div>
    </div>
    <!--end::Portlet-->

    <!--Begin:: Modal-->
    @include('backend::setting.module.modal')
    <!--End:: Modal-->
</div>
@endsection


@push('script')
<script>
let table;
let _token = "{{csrf_token()}}";
$(document).ready(function () {
    get_module_list();
    /** BEGIN:: DATATABLE SERVER SIDE CODE **/
    table = $('#dataTable').DataTable({

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        "responsive": true, //make able resposive in mobile devices
        "bInfo": true, //to show the total number of data showing
        "bFilter": false, //for datatable default search box
        "lengthMenu": [
            [5, 10, 15, 25, 50, 100, -1],
            [5, 10, 15, 25, 50, 100, "All"]
        ],
        "pageLength": 25,
        "language": {
            processing: '<img src="svg/table-loading.svg" alt="Loading.."/>',
            emptyTable: '<strong class="text-danger">No Data Found</strong>',
            infoEmpty: '',
            zeroRecords: '<strong class="text-danger">No Data Found</strong>',
        },

        // Load data for the table's content from an Ajax source//
        "ajax": {
            "url": "{{route('admin.module.list')}}",
            "type": "POST",
            "data": function (data) {
                data.module_name  = $('#form-filter #module_name').val();
                data._token       = _token;
            }
        },

        //Set column definition initialisation properties.
        "columnDefs": [
            {
                "targets": [0,3,4],
                "orderable": false, //set not orderable
                "className": "text-center",
            }
        ],
        "dom": 'lTgBfrtip',
        "buttons": [
            'colvis',
            {
                "extend": 'csv',
                "title": "{{ucwords($sub_title)}}",
                "filename": 'brand-report',
                "exportOptions": {
                     columns: ':visible'
                }
            },
            {
                "extend": 'excel',
                "title": "{{ucwords($sub_title)}}",
                "filename": 'brand-report',
                "exportOptions": {
                     columns: ':visible'
                }
            },
            {
                "extend": 'pdf',
                "title": "{{ucwords($sub_title)}}",
                "filename": 'brand-report',
                "orientation": 'portrait', //landscape
                "pageSize": 'A4', //A3 , A5 , A6 , legal , letter
                "exportOptions": {
                     columns: ':visible'
                },

                customize: function (doc) {
                    doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                    var rowCount = doc.content[1].table.body.length;
                    for (i = 1; i < rowCount; i++) {
                    doc.content[1].table.body[i][i].alignment = 'left';
                    };
                },

            },

            {
                "extend": 'print',
                "title": "{{ucwords($sub_title)}}",
                "orientation": 'portrait',//'landscape', //portrait
                "pageSize": 'A4', //A3 , A5 , A6 , legal , letter
                "exportOptions": {
                     columns: ':visible'
                },
                customize: function (win) {
                    $(win.document.body).addClass('white-bg');
                    $(win.document.body).find('table').addClass('display').css('font-size', '9px');
                    $(win.document.body).find('h1').css('text-align','center');
                }
            }
        ],

    });
    /** END:: DATATABLE SERVER SIDE CODE **/

    /** BEGIN:: DATATABLE SEARCH FORM BUTTON TRIGGER CODE **/
    $('#btn-filter').click(function () {
        table.ajax.reload();
    });

    $('#btn-reset').click(function () {
        $('#form-filter')[0].reset();
        $('#form-filter .selectpicker').selectpicker('refresh');
        table.ajax.reload();
    });
    /** END:: DATATABLE SEARCH FORM BUTTON TRIGGER CODE **/

    /** BEGIN:: DATATABLE APPEND DELETE ALL BUTTON **/
    let button = `<button class="btn btn-sm btn-label-danger btn-bold ml-1" type="button" id="bulk_action_delete"><i class="kt-nav__link-icon flaticon2-trash"></i> Delete All</button>`;
    $('#dataTable_wrapper .dt-buttons').append(button);
    /** END:: DATATABLE APPEND DELETE ALL BUTTON  **/

    /** BEGIN:: DATA ADD/UPDATE AJAX CODE **/
    $(document).on('click', '#save-btn',function(event){
        let url = "{{route('admin.module.store')}}";
        let id  = $('#update_id').val();
        let method;
        if(id){
            method = "update";
        }else{
            method = "store";
        }
        $.ajax({
            url: url,
            type: "POST",
            data: $('#saveDataForm').serialize(),
            dataType: "JSON",
            beforeSend: function () {
                $('#save-btn').addClass('kt-spinner kt-spinner--md kt-spinner--light');
            },
            complete: function(){
                $('#save-btn').removeClass('kt-spinner kt-spinner--md kt-spinner--light');
            },
            success: function (data) {
                $("#saveDataForm").find('.is-invalid').removeClass('is-invalid');
                $("#saveDataForm").find('.error').remove();

                if (data.status) {
                    notification(data.message, data.status);
                    if(data.status == 'success'){
                        if(method == 'update'){
                            table.ajax.reload( null, false );
                        }else{
                            table.ajax.reload();
                        }
                        get_module_list();
                        $('.selectpicker').selectpicker('refresh');
                        $('#saveDataModal').modal('hide');

                    }
                } else {
                    $.each(data.errors, function (key, value) {
                        $("#saveDataForm input[name='"+key+"']").addClass('is-invalid');
                        $("#saveDataForm select#" + key).parent().addClass('is-invalid');
                        $("#saveDataForm textarea[name='" + key + "']").parent().addClass('is-invalid');
                        $("#saveDataForm input[name='"+key+"']").after('<div id="'+key+'" class="error invalid-feedback">'+value+'</div>');
                        $("#saveDataForm select#" + key).parent().after('<div id="'+key+'" class="error invalid-feedback">'+value+'</div>');
                        $("#saveDataForm textarea[name='"+key+"']").after('<div id="'+key+'" class="error invalid-feedback">'+value+'</div>');
                    });
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    });
    /** END:: DATA ADD/UPDATE AJAX CODE **/

    //BEGIN: FETCHING EDIT DATA CODE
    $(document).on('click','.edit_data',function () {
        var id = $(this).data('id');
        $('#saveDataForm')[0].reset(); // reset form on show modals
        $(".error").each(function () {
            $(this).empty();//remove error text
        });
        $("#saveDataForm").find('.is-invalid').removeClass('is-invalid');//remover red border color
        $('.selectpicker').selectpicker('refresh');
        $.ajax({
            url: "{{route('admin.module.edit')}}",
            type: "POST",
            data:{id:id,_token:_token},
            dataType: "JSON",
            success: function (data) {
                $('#saveDataForm #update_id').val(data.module.id);
                $('#saveDataForm #module_name').val(data.module.module_name);
                $('#saveDataForm #module_link').val(data.module.module_link);
                $('#saveDataForm #module_icon').val(data.module.module_icon);
                $('#saveDataForm #module_sequence').val(data.module.module_sequence);
                $('#saveDataForm select[name="parent_id"]').val(data.module.parent_id);
                $('#saveDataForm .selectpicker').selectpicker('refresh');
                $('#saveDataModal').modal({
                    keyboard: false,
                    backdrop: 'static', //make modal static
                });
                $('.modal-title').html('<i class="fas fa-edit"></i> <span>Edit '+data.module.module_name+' Data</span>');
                $('#save-btn').text('Update');
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    });
    //END: FETCHING EDIT DATA CODE

    //BEGIN: DELETE SINGLE DATA
    $(document).on('click','.delete_data',function () {
        let row = table.row( $(this).parents('tr') );
        let id  = $(this).data('id');
        let url = "{{route('admin.module.delete')}}";
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#6610f2',
            cancelButtonColor: '#fd397a',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {id:id},
                    dataType: 'json'
                })
                .done(function(response){
                        if (response.status == 'success') {
                        Swal.fire("Deleted!", response.message, "success" ).then(function () {
                            table.row(row).remove().draw(false);
                            get_module_list();
                        });
                    } else if (response.status == 'error') {
                        Swal.fire('Error deleting!', response.message,'error');
                    }
                })
                .fail(function(){
                    swal.fire('Oops...', 'Something went wrong with ajax !', 'error');
                });
            }
        });
    });
    //END: DELETE SINGLE DATA


    //BEGIN: DELETE MULTIPLE DATA
    $(document).on("click",'#bulk_action_delete',function() {
        let id = [];
        let rows;
        $('.select_data:checked').each(function(i){
            id.push($(this).val());
            rows = table.rows( $('.select_data:checked').parents('tr') );
        });
        if(id.length === 0) //tell us if the array is empty
        {
            Swal.fire({
                type: 'error',
                title: 'Error',
                text: 'Please checked at least one row of table!',
            });

        }else{
            let url = "{{route('admin.module.bulkaction')}}";
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#6610f2',
                cancelButtonColor: '#fd397a',
                confirmButtonText: 'Yes, delete!'
            }).then((result) => {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {id:id},
                        dataType: 'json'
                    })
                    .done(function(response){
                            if (response.status == 'success') {
                            Swal.fire("Deleted!", response.message, "success" ).then(function () {
                                $('.selectall').prop('checked',false);
                                table.rows(rows).remove().draw(false);
                                get_module_list();
                            });
                        } else if (response.status == 'error') {
                            Swal.fire('Error deleting!', response.message,'error');
                        }
                    })
                    .fail(function(){
                        swal.fire('Oops...', 'Something went wrong with ajax !', 'error');
                    });
                }
            })
        }
    });
    //END: DELETE MULTIPLE CODE

     //BEGIN: SELECT ALL CHECKBOX CHECKED IF ANY ROW SELECTED CODE
     
    //END: SELECT ALL CHECKBOX CHECKED IF ANY ROW SELECTED CODE

}); 
function get_module_list(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "{{route('admin.module.parent')}}",
        type: "POST",
        success: function (data) {
            if (data) {
                $('#saveDataForm #parent_id').html(data);
                $('.selectpicker').selectpicker('refresh');
            } 
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
}
</script>
@endpush
