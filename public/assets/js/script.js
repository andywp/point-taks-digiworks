$(function(){

    $('.togglepublish, .bstoggle').bootstrapToggle();
    //$('.select2').select2();


    // MAterial Date picker
    $('.datepicker').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD',
        weekStart: 0,
        time: false,
        defaultDate: new Date()
    });
    $('.datepickertime').bootstrapMaterialDatePicker({
        weekStart: 0,
        time: true
    });
    $('.timepicker').bootstrapMaterialDatePicker({
        format: 'HH:mm',
        time: true,
        date: false
    });
    $('#date-format').bootstrapMaterialDatePicker({
        format: 'dddd DD MMMM YYYY - HH:mm'
    });

    $('#min-date').bootstrapMaterialDatePicker({
        format: 'DD/MM/YYYY HH:mm',
        minDate: new Date()
    });
});

let notif = (message='',type='success') =>{
    let setParam ={
        timeOut: 5e3,
        closeButton: !0,
        debug: !1,
        newestOnTop: !0,
        progressBar: !0,
        positionClass: "toast-top-right",
        preventDuplicates: !0,
        onclick: null,
        showDuration: "300",
        hideDuration: "1000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
        tapToDismiss: !1
    }

    switch(type) {
        case 'warning':
            toastr.warning(message, "Warning",setParam);
        break;
        case 'info':
        toastr.warning(message, "Info",setParam);
        break;
       
        default:
            toastr.success(message, "Success",setParam);
    }
}