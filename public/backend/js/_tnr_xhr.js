$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

class TnrXHR {
    loadMailerFormFields(obj) {
        Tnr.block();

        $.ajax({
            url: obj.data('route'),
            type: 'POST',
            data: 'mailer=' + obj.val(),
            success: function(response) {
                $("#" + obj.data('target')).html(response);

                Tnr.unblock();
            },
            error: function(xhr, status, error) {
                Tnr.unblock();

                Tnr.errorAlert(xhr.responseJSON.message, error);
            }
        });
    }
}

let _tnr_xhr  = new TnrXHR;
