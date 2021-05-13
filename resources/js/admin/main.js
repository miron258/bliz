$(document).ready(function () {


    window.notifyOk = function (message) {
        var notify = $.notify(message, { allow_dismiss: false });
    };

    window.notifyError = function (error) {
        var message = "";
        if (error.data != null)
            if (error.data.message != null)
                message = error.data.message;
        if (message == "")
            if (error.statusText != null)
                message = "Error: " + error.statusText;
        if (message == "")
            if (typeof error == "string")
                message = error;
//        $.notify({
//            message: {text: message},
//            type: 'danger'
//        }).show();

var notify = $.notify(message, { allow_dismiss: false });


        $('#loading').css('display', 'none');
    };




//notify.update({ type: 'success', '<strong>Success</strong> Your page has been saved!' });


});