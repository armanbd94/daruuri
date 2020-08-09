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
            <button type="button" id="showModal" class="btn btn-brand btn-icon-sm btn-sm">
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
                            <div class="col-md-3 mb-3">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" />
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Email</label>
                                <input type="text" class="form-control" name="email" id="email" placeholder="Enter email" />
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Role</label>
                                <select  class="form-control selectpicker" name="role_id" id="role_id" data-live-search="true" data-live-search-placeholder="Search" title="Choose one of the following...">
                                    @if (!empty($data['roles']))
                                    @foreach ($data['roles'] as $role)
                                    <option value="{{$role->id}}">{{$role->role}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Status</label>
                                <select  class="form-control selectpicker" name="status" id="status" data-live-search="true" data-live-search-placeholder="Search" title="Choose one of the following...">
                                    <option value="">Select please</option>
                                    @foreach (TEXT_STATUS as $id => $text)
                                    <option value="{{$id}}">{{$text}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
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
                                <th>Avatar</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Email</th>
                                <th>Status</th>
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
    @include('backend::user.modal')
    @include('backend::user.show-modal')
    @include('backend::user.change-password')
    <!--End:: Modal-->
</div>
@endsection


@push('script')
<script>
let table;
let _token = "{{csrf_token()}}";
loadFile = function(event, target_id) {
    var output = document.getElementById(target_id);
    output.src = URL.createObjectURL(event.target.files[0]);
};
$(document).ready(function () {
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
            "url": "{{route('admin.user.list')}}",
            "type": "POST",
            "data": function (data) {
                data.name         = $('#form-filter #name').val();
                data.email        = $('#form-filter #email').val();
                data.role_id      = $('#form-filter #role_id').val();
                data.status       = $('#form-filter #status').val();
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

     /** BEGIN:: SHOW ADD/UPDATE MODAL **/
    $(document).on('click','#showModal',function(){
        $('#saveDataForm')[0].reset(); //reset form
        $('#update_id').val(''); //empty id input field
        $(".error").each(function () {
            $(this).empty(); //remove error text
        });
        $('#saveDataForm .show-image').attr("src", 'svg/upload.svg');
        $("#saveDataForm").find('.is-invalid').removeClass('is-invalid'); //remover red border color
        $("#password,#password_confirmation").parent().show();
        $('#saveDataModal').modal({
            keyboard: false,
            backdrop: 'static', //make modal static
        });

        $('.selectpicker').selectpicker('refresh'); //empty selectpicker field
        $('.modal-title').html('<i class="fas fa-plus-square"></i> <span>Add New User</span>'); //set modal title
        $('#save-btn').text('Save'); //set save button text
    });
    /** END:: SHOW ADD/UPDATE MODAL **/

    /** BEGIN:: DATA ADD/UPDATE AJAX CODE **/
    $('#saveDataForm').on('submit', function(event){
        event.preventDefault();
        let id  = $('#update_id').val();
        let url = "{{route('admin.user.store')}}";
        let method;
        if(id){
            method = "update";
        }else{
            method = "store";
        }
        store_with_image_data(table, url, method, this);
    });
    /** END:: DATA ADD/UPDATE AJAX CODE **/

    //BEGIN: FETCHING VIEW DATA CODE
    $(document).on('click','.view_data',function () {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('admin.user.show')}}",
            type: "POST",
            data:{id:id,_token:_token},
            dataType: "JSON",
            success: function (data) {
                $('#showDataModal .modal-body').html(data.user);
                $('#showDataModal').modal({
                    keyboard: false,
                    backdrop: 'static', //make modal static
                });
                $('.modal-title').html('<i class="fas fa-eye"></i> <span>'+data.name+' Data</span>');
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    });
    //END: FETCHING VIEW DATA CODE

    //BEGIN: FETCHING EDIT DATA CODE
    $(document).on('click','.edit_data',function () {
        var id = $(this).data('id');
        $('#saveDataForm')[0].reset(); // reset form on show modals
        $(".error").each(function () {
            $(this).empty();//remove error text
        });
        $("#password,#password_confirmation").parent().hide();
        $("#saveDataForm").find('.is-invalid').removeClass('is-invalid');//remover red border color
        $('.selectpicker').selectpicker('refresh');
        $.ajax({
            url: "{{route('admin.user.edit')}}",
            type: "POST",
            data:{id:id,_token:_token},
            dataType: "JSON",
            success: function (data) {
                $('#saveDataForm #update_id').val(data.user.id);
                $('#saveDataForm #name').val(data.user.name);
                $('#saveDataForm #email').val(data.user.email);
                $('#saveDataForm select[name="role_id"]').val(data.user.role_id);
                $('#saveDataForm select[name="status"]').val(data.user.status);
                $('#saveDataForm .selectpicker').selectpicker('refresh');
                if(data.user.avatar){
                    let file = "{{'storage/'.USER}}"+data.user.avatar;
                    $('#saveDataForm #avatar-image').attr('src',file);
                }
                
                $('#saveDataForm #old_avatar').val(data.user.avatar);
                $('#saveDataModal').modal({
                    keyboard: false,
                    backdrop: 'static', //make modal static
                });
                $('.modal-title').html('<i class="fas fa-edit"></i> <span>Edit '+data.user.name+' Data</span>');
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
        let url = "{{route('admin.user.delete')}}";
        delete_data(table,row,id,url);
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
            let url = "{{route('admin.user.bulkaction')}}";
            bulk_action_delete(table,url,id,rows);
        }
    });
    //END: DELETE MULTIPLE CODE

     //BEGIN: SHOW CHANGE PASSWORD MODAL FORM
     $(document).on('click','.change_password_data',function () {
        
        $('#changePasswordForm')[0].reset(); // reset form on show modals
        $(".error").each(function () {
            $(this).empty();//remove error text
        });
        $("#changePasswordForm").find('.is-invalid').removeClass('is-invalid');//remover red border color
        $('#changePasswordForm #update_id').val($(this).data('id'));
        $('#changePasswordModal').modal({
            keyboard: false,
            backdrop: 'static', //make modal static
        });
        $('#changePasswordModal .modal-title').html('<i class="kt-nav__link-icon flaticon2-lock"></i></i> <span>Change '+$(this).data('name')+' Password</span>'); //set modal title
        $('#changePasswordModal #change-password-btn').text('Change Password');

    });
    //END: SHOW CHANGE PASSWORD MODAL FORM

     /** BEGIN:: PASSWORD CHANGE AJAX CODE **/
     $(document).on('click', '#change-password-btn',function(event){
        $.ajax({
            url: "{{route('admin.user.change.password')}}",
            type: "POST",
            data: $('#changePasswordForm').serialize(),
            dataType: "JSON",
            beforeSend: function () {
                $('#change-password-btn').addClass('kt-spinner kt-spinner--md kt-spinner--light');
            },
            complete: function(){
                $('#change-password-btn').removeClass('kt-spinner kt-spinner--md kt-spinner--light');
            },
            success: function (data) {
                $("#changePasswordForm").find('.is-invalid').removeClass('is-invalid');
                $("#changePasswordForm").find('.error').remove();

                if (data.status) {
                    notification(data.message, data.status);
                    if(data.status == 'success'){
                        table.ajax.reload( null, false );
                        $('#changePasswordModal').modal('hide');
                    }
                } else {
                    $.each(data.errors, function (key, value) {
                        $("#changePasswordForm input[name='"+key+"']").addClass('is-invalid');
                        $("#changePasswordForm input[name='"+key+"']").parent().append('<div id="'+key+'" class="error invalid-feedback">'+value+'</div>');
                        
                    });
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    });
    /** END:: PASSWORD CHANGE AJAX CODE **/

}); 
</script>
@endpush
