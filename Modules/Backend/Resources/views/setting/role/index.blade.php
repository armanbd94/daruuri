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
            <a href="{{route('admin.role.create')}}" type="button" class="btn btn-brand btn-icon-sm btn-sm">
                <i class="fas fa-plus-square"></i> Add New
            </a>
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
                            <div class="col-md-6 mb-3">
                                <label>Role Name</label>
                                <input type="text" class="form-control" name="role" id="role" placeholder="Enter role name" />
                            </div>
                            <div class="col-md-6 mb-3">
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
                                <th>Role Name</th>
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
    @include('backend::setting.role.modal')
    <!--End:: Modal-->
</div>
@endsection


@push('script')
<script>
let table;
let _token = "{{csrf_token()}}";
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
            "url": "{{route('admin.role.list')}}",
            "type": "POST",
            "data": function (data) {
                data.role   = $('#form-filter #role').val();
                data._token = _token;
            }
        },

        //Set column definition initialisation properties.
        "columnDefs": [
            {
                "targets": [0,3],
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
        table.ajax.reload();
    });
    /** END:: DATATABLE SEARCH FORM BUTTON TRIGGER CODE **/

    /** BEGIN:: DATATABLE APPEND DELETE ALL BUTTON **/
    let button = `<button class="btn btn-sm btn-label-danger btn-bold ml-1" type="button" id="bulk_action_delete"><i class="kt-nav__link-icon flaticon2-trash"></i> Delete All</button>`;
    $('#dataTable_wrapper .dt-buttons').append(button);
    /** END:: DATATABLE APPEND DELETE ALL BUTTON  **/


    //BEGIN: DELETE SINGLE DATA
    $(document).on('click','.delete_data',function () {
        let row = table.row( $(this).parents('tr') );
        let id  = $(this).data('id');
        let url = "{{route('admin.role.delete')}}";
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
            let url = "{{route('admin.role.bulkaction')}}";
            bulk_action_delete(table,url,id,rows);
        }
    });
    //END: DELETE MULTIPLE CODE

}); 
</script>
@endpush