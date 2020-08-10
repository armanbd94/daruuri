$(".selectpicker").selectpicker(); //bootstrap selectpicker initialized
// $('[data-toggle="kt-tooltip"]').tooltip();
/*******************************************
 ******* Start :: Show Modal Function *******
 ********************************************/
function show_modal(modal_title, btn_text) {
    $('#saveDataForm')[0].reset(); //reset form
    $('#update_id').val(''); //empty id input field
    // $('#saveDataForm .custom-file-label').text('');
    $('#saveDataForm .show-image').attr("src", 'svg/upload.svg');
    $(".error").each(function () {
        $(this).empty(); //remove error text
    });
    $("#saveDataForm").find('.is-invalid').removeClass('is-invalid'); //remover red border color

    $('#saveDataModal').modal({
        keyboard: false,
        backdrop: 'static', //make modal static
    });

    $('.selectpicker').selectpicker('refresh'); //empty selectpicker field
    $('.modal-title').html('<i class="fas fa-plus-square"></i> <span>' + modal_title + '</span>'); //set modal title
    $('#save-btn').text(btn_text); //set save button text
}
/*****************************************
 ******* End :: Show Modal Function *******
 ******************************************/

/***********************************************************
 ******* Start :: On Checked Select All Rows Of Table *******
 ************************************************************/
function select_all() {
    if ($('.selectall:checked').length == 1) {
        $('.select_data').prop('checked', $(this).prop('checked', true));
        if ($('.select_data').is(':checked')) {
            $('.select_data').closest('tr').addClass('bg-danger');
            $('.select_data').closest('tr').children('td').addClass('text-white');
        } else {
            $('.select_data').closest('tr').removeClass('bg-danger');
            $('.select_data').closest('tr').children('td').removeClass('text-white');
        }
    } else {
        $('.select_data').prop('checked', false);
        if ($('.select_data').is(':checked')) {
            $('.select_data').closest('tr').addClass('bg-danger');
            $('.select_data').closest('tr').children('td').addClass('text-white');
        } else {
            $('.select_data').closest('tr').removeClass('bg-danger');
            $('.select_data').closest('tr').children('td').removeClass('text-white');
        }
    }
}
/***********************************************************
 ******* End :: On Checked Select All Rows Of Table *******
 ************************************************************/

/***********************************************************
 ******* Start :: On Checked Select All Rows Of Table *******
 ************************************************************/
function select_single_item(id) {
    // $(document).on('change','.select_data',function(){
        var total = $('.select_data').length;
        var number = $('.select_data:checked').length;
        if($('.select_item_'+id).is(':checked'))
        {
            $('.select_item_'+id).closest('tr').addClass('bg-danger');
            $('.select_item_'+id).closest('tr').children('td').addClass('text-white');
        }
        else
        {
            $('.select_item_'+id).closest('tr').removeClass('bg-danger');
            $('.select_item_'+id).closest('tr').children('td').removeClass('text-white');
        }
        if(total == number){
            $('.selectall').prop('checked',true);
        }else{
            $('.selectall').prop('checked',false);
        }
    // });
}
/***********************************************************
 ******* End :: On Checked Select All Rows Of Table *******
 ************************************************************/

/*****************************************************************
 ******* Start :: Prevent Form Submissin On Press Enter Key *******
 ******************************************************************/
$(document).ready(function () {
    $(window).keydown(function (event) {
        if (event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });
});
/*****************************************************************
 ******* End :: Prevent Form Submissin On Press Enter Key *******
 ******************************************************************/

/*****************************************
 ******* Start :: Windows Preloader *******
 ******************************************/
function handlePreloader() {
    if ($('#preloader').length) {
        $('#preloader').delay(220).fadeOut(500);
    }
}
$(window).on('load', function () {
    handlePreloader();
});
/*****************************************
 ******* End :: Windows Preloader *******
 ******************************************/

/**************************************************
 ******* Start :: Bootstrap Notify Functions *******
 **************************************************/
function notification(message,status){
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    
    switch (status) { 
        case 'success': 
            toastr.success(message, 'SUCCESS');
            break;
        case 'error': 
            toastr.error(message, 'ERROR');
            break;
        case 'info': 
            toastr.info(message, 'INFO');
            break;		
        case 'warning': 
            toastr.warning(message, 'WARNING');
            break;
    }
}


/**************************************************
 ******* End :: Bootstrap Notify Functions *******
 **************************************************/

/*************************************
 ******* Start :: URL Generator *******
 **************************************/
function url_generator(input_value, output_id) {
    var value = input_value.toLowerCase();
    var str = value.replace(/ +(?= )/g, '');
    var name = str.split(' ').join('-')
    $("#" + output_id).val(name);
}
/*************************************
 ******* End :: URL Generator *******
 **************************************/

/*************************************
 ******* Start :: Permission Tree *******
 **************************************/

/*************************************
 ******* End :: Permission Tree *******
 **************************************/

/*************************************************
 ******* Start :: Store Form Data Function *******
 **************************************************/
function store_data(table, url, method) {
    $.ajax({
        url: url,
        type: "POST",
        data: $('#saveDataForm').serialize(),
        dataType: "JSON",
        beforeSend: function () {
            $('#save-btn').addClass('kt-spinner kt-spinner--md kt-spinner--light');
        },
        complete: function () {
            $('#save-btn').removeClass('kt-spinner kt-spinner--md kt-spinner--light');
        },
        success: function (data) {
            $("#saveDataForm").find('.is-invalid').removeClass('is-invalid');
            $("#saveDataForm").find('.error').remove();

            if (data.status) {
                notification(data.message, data.status);
                if (data.status == 'success') {
                    if (method == 'update') {
                        table.ajax.reload(null, false);
                    } else {
                        table.ajax.reload();
                    }

                    $('#saveDataModal').modal('hide');
                }
            } else {
                $.each(data.errors, function (key, value) {
                    var key = key.split('.').join("_");
                    $('#saveDataForm .form-group').find('.error_' + key).text(value);
                    $("#saveDataForm input[name='" + key + "']").addClass('is-invalid');
                    $("#saveDataForm select#" + key).parent().addClass('is-invalid');
                    $("#saveDataForm textarea[name='" + key + "']").addClass('is-invalid');
                    $("#saveDataForm input[name='" + key + "']").after('<div id="' + key + '" class="error invalid-feedback">' + value + '</div>');
                    $("#saveDataForm select#" + key).parent().after('<div id="' + key + '" class="error invalid-feedback">' + value + '</div>');
                    $("#saveDataForm textarea[name='" + key + "']").after('<div id="' + key + '" class="error invalid-feedback">' + value + '</div>');
                    $("#saveDataForm table").find("#"+key).addClass('is-invalid');
                    $("#saveDataForm table").find("#"+key).after('<div id="'+key+'" class="error invalid-feedback">'+value+'</div>');
                });
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
}

function store_with_image_data(table, url, method, form){
    $.ajax({
        url: url,
        type: "POST",
        data: new FormData(form),
        dataType: "JSON",
        contentType:false,
        cache:false,
        processData:false,
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
                    $('#saveDataModal').modal('hide');
                }
            } else {
                $.each(data.errors, function (key, value) {
                    var key = key.split('.').join("_");
                    $('#saveDataForm .form-group').find('.error_'+key).text(value); 
                    $("#saveDataForm input[name='"+key+"']").addClass('is-invalid');
                    $("#saveDataForm select#" + key).parent().addClass('is-invalid');
                    $("#saveDataForm textarea[name='" + key + "']").parent().addClass('is-invalid');
                    $("#saveDataForm input[name='"+key+"']").after('<div id="'+key+'" class="error invalid-feedback">'+value+'</div>');
                    $("#saveDataForm input[type='file']#"+key).parent().after('<div id="'+key+'" class="error invalid-feedback">'+value+'</div>');
                    $("#saveDataForm select#" + key).parent().after('<div id="'+key+'" class="error invalid-feedback">'+value+'</div>');
                    $("#saveDataForm textarea[name='"+key+"']").after('<div id="'+key+'" class="error invalid-feedback">'+value+'</div>');
                    $("#saveDataForm table").find("#"+key).addClass('is-invalid');
                    $("#saveDataForm table").find("#"+key).after('<div id="'+key+'" class="error invalid-feedback">'+value+'</div>');
                
                });
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
}
/*************************************************
 ******* End :: Store Form Data Function *******
 **************************************************/

/********************************************
 ******* Start :: Delete Data Function *******
 *********************************************/
function delete_data(table, row, id, url) {
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
                    data: { id: id},
                    dataType: 'JSON'
                })
                .done(function (response) {
                    if (response.status == 'success') {
                        Swal.fire("Deleted!", response.message, "success").then(function () {
                            // table.ajax.reload();
                            table.row(row).remove().draw(false);
                        });
                    } else if (response.status == 'error') {
                        Swal.fire('Error deleting!', response.message, 'error');
                    }
                })
                .fail(function () {
                    swal.fire('Oops...', 'Something went wrong with ajax !', 'error');
                });
        }
    })
}
/********************************************
 ******* End :: Delete Data Function *******
 *********************************************/

/********************************************************
 ******* Start :: Bulk Action Delete Data Functions *******
 *********************************************************/

function bulk_action_delete(table, url, id, rows) {
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
                    data: {
                        id: id
                    },
                    dataType: 'json'
                })
                .done(function (response) {
                    if (response.status == 'success') {
                        Swal.fire("Deleted!", response.message, "success").then(function () {
                            $('.selectall').prop('checked', false);
                            table.rows(rows).remove().draw(false);
                        });
                    } else if (response.status == 'error') {
                        Swal.fire('Error deleting!', response.message, 'error');
                    }
                })
                .fail(function () {
                    swal.fire('Oops...', 'Something went wrong with ajax !', 'error');
                });
        }
    })
}
/********************************************************
 ******* End :: Bulk Action Delete Data Functions *******
 *********************************************************/
