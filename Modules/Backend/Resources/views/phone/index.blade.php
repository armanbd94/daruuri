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
            @if (permission('phone-add'))
            <button type="button" id="showModal" class="btn btn-brand btn-icon-sm btn-sm">
                <i class="fas fa-plus-square"></i> Add New
            </button>
            @endif
            
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
                                <label>Phone Name</label>
                                <input type="text" class="form-control" name="phone_name" id="phone_name" placeholder="Enter phone name" />
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Brand</label>
                                <select  class="form-control selectpicker" name="brand_id" id="brand_id" data-live-search="true" data-live-search-placeholder="Search" title="Choose one of the following...">
                                    <option value="">Select please</option>
                                    @if (!empty($data['brands']))
                                    @foreach ($data['brands'] as $brand)
                                    <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
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
                            <div class="col-md-3 mb-3">
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
                                @if (permission('phone-bulk-action-delete'))
                                <th>
                                    <label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid">
                                        <input type="checkbox" class="selectall" onchange="select_all()">&nbsp;<span></span>
                                    </label>
                                </th>
                                @endif
                                <th>SR</th>
                                <th>Phone</th>
                                <th>Brand</th>
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
    @include('backend::phone.modal')
    @include('backend::phone.show-modal')
    <!--End:: Modal-->
</div>
@endsection


@push('script')
<script>
let table;
const _token = "{{csrf_token()}}";
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
            "url": "{{route('admin.phone.list')}}",
            "type": "POST",
            "data": function (data) {
                data.phone_name   = $('#form-filter #phone_name').val();
                data.brand_id     = $('#form-filter #brand_id').val();
                data.status       = $('#form-filter #status').val();
                data._token       = _token;
            }
        },

        //Set column definition initialisation properties.
        "columnDefs": [
            {
                @if (permission('phone-bulk-action-delete'))
                "targets": [0,5],
                @else
                "targets": [4],
                @endif
                "orderable": false, //set not orderable
                "className": "text-center",
            }
        ],
        @if (permission('phone-report'))
        "dom": 'lTgBfrtip',
        "buttons": [
            'colvis',
            {
                "extend": 'csv',
                "title": "{{ucwords($sub_title)}}",
                "filename": 'phone-report',
                "exportOptions": {
                     columns: ':visible'
                }
            },
            {
                "extend": 'excel',
                "title": "{{ucwords($sub_title)}}",
                "filename": 'phone-report',
                "exportOptions": {
                     columns: ':visible'
                }
            },
            {
                "extend": 'pdf',
                "title": "{{ucwords($sub_title)}}",
                "filename": 'phone-report',
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
                "filename": 'phone-report',
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
        @endif

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
    @if(permission('phone-bulk-action-delete'))
    let button = `<button class="btn btn-sm btn-danger btn-bold ml-1" type="button" id="bulk_action_delete"><i class="kt-nav__link-icon flaticon2-trash"></i> Delete All</button>`;
    $('#dataTable_wrapper .dt-buttons').append(button);
    @endif
    /** END:: DATATABLE APPEND DELETE ALL BUTTON  **/

    /** BEGIN:: SHOW ADD/UPDATE MODAL **/
    $(document).on('click','#showModal',function(){
        $('#saveDataForm')[0].reset(); //reset form
        $('#update_id').val(''); //empty id input field
        $(".error").each(function () {
            $(this).empty(); //remove error text
        });
        $("#saveDataForm").find('.is-invalid').removeClass('is-invalid'); //remover red border color
        $('#saveDataForm table .price_box').prop('disabled',false);
        $('#saveDataModal').modal({
            keyboard: false,
            backdrop: 'static', //make modal static
        });

        $('.selectpicker').selectpicker('refresh'); //empty selectpicker field
        $('.modal-title').html('<i class="fas fa-plus-square"></i> <span>Add New Phone</span>'); //set modal title
        $('#save-btn').text('Save'); //set save button text
    });
    /** END:: SHOW ADD/UPDATE MODAL **/

    /** BEGIN:: DATA ADD/UPDATE AJAX CODE **/
    $(document).on('click', '#save-btn',function(event){
        let url = "{{route('admin.phone.store')}}";
        let id  = $('#update_id').val();
        let method;
        if(id){
            method = "update";
        }else{
            method = "store";
        }
        store_data(table, url, method);
    });
    /** END:: DATA ADD/UPDATE AJAX CODE **/

     //BEGIN: FETCHING VIEW DATA CODE
     $(document).on('click','.view_data',function () {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('admin.phone.show')}}",
            type: "POST",
            data:{id:id,_token:_token},
            dataType: "JSON",
            success: function (data) {
                $('#showDataModal .modal-body').html(data.phone);
                $('#showDataModal').modal({
                    keyboard: false,
                    backdrop: 'static', //make modal static
                });
                $('.modal-title').html('<i class="fas fa-eye"></i> <span>'+data.phone_name+' Data</span>');
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
        $("#saveDataForm").find('.is-invalid').removeClass('is-invalid');//remover red border color
        $('.selectpicker').selectpicker('refresh');
        $('#saveDataForm table input[type="checkbox"]').prop('checked',false);
        $('#saveDataForm table .price_box').prop('disabled',true);
        $.ajax({
            url: "{{route('admin.phone.edit')}}",
            type: "POST",
            data:{id:id,_token:_token},
            dataType: "JSON",
            success: function (data) {
                $('#saveDataForm #update_id').val(data.phone.id);
                $('#saveDataForm #phone_name').val(data.phone.phone_name);
                $('#saveDataForm select[name="brand_id"]').val(data.phone.brand_id);
                $('#saveDataForm select[name="status"]').val(data.phone.status);
                $('#saveDataForm .selectpicker').selectpicker('refresh');
                $.each(data.phone.services, function(key, value){
                    $('#saveDataForm table #'+value.id+'_service').prop('checked',true);
                    $('#saveDataForm table #service_'+value.id+'_price').val(value.pivot.price);
                    disable_price(value.id);
                });
                $('#saveDataModal').modal({
                    keyboard: false,
                    backdrop: 'static', //make modal static
                });
                $('.modal-title').html('<i class="fas fa-edit"></i> <span>Edit '+data.phone.phone_name+' Data</span>');
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
        let url = "{{route('admin.phone.delete')}}";
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
            let url = "{{route('admin.phone.bulkaction')}}";
            bulk_action_delete(table,url,id,rows);
        }
    });
    //END: DELETE MULTIPLE CODE

     //BEGIN: SELECT ALL CHECKBOX CHECKED IF ANY ROW SELECTED CODE
     
    //END: SELECT ALL CHECKBOX CHECKED IF ANY ROW SELECTED CODE

}); 

function disable_price(id)
{
    if($("#"+id+"_service").prop("checked") == true){
        $("#service_"+id+"_price").prop("disabled",false);
        $("#service_"+id+"_price").val("0.00");
    }else{
        $("#service_"+id+"_price").prop("disabled",true);
        $("#service_"+id+"_price").val("");
    }
}
</script>
@endpush
