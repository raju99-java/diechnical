 $('#student-add-form').submit(function (event){
        event.preventDefault();
        alert('hi');return;
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('input[name=_token]').val();
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                success_msg(resp.msg, 5000);
                $('#surl').val(resp.surl);
                $('#furl').val(resp.furl);
                $('#txnid').val(resp.txnid);
                $('#firstname').val(resp.firstname);
                $('#email').val(resp.email);
                $('#hash').val(resp.hash);
                $('#phone').val(resp.phone);
                
                // $('#signup-form')[0].reset();
                ajaxindicatorstop();
                submitPayuForm();
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $("#error-" + key).html(val[0]).closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        })
    });
    