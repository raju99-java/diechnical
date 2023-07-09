$(document).on('submit', '#post-full_name-form', function (e) {
    e.preventDefault();
    loader_start();
    $('.has-error').removeClass('has-error');
    $('.help-block').html('');
    $.post($(this).attr('action'), $(this).serialize(), function (resp) {
        loader_stop();
        if (resp.type == "success") {
            window.location.href = resp.url;
        } else if (resp.type == "validation") {
            $.each(resp.message, function (index, elem) {
                $("#" + index).closest(".form-group").addClass('has-error');
                $("#" + index).closest(".form-group").find('.help-block').html(elem);
            })
        } else if (resp.type == "warning") {
            error_msg(resp.message.full_name);
        }
    }, 'json');
});
$(document).on('submit', '#post-email-form', function (e) {
    e.preventDefault();
    loader_start();
    $('.has-error').removeClass('has-error');
    $('.help-block').html('');
    $('.login-indicator').addClass('hide');
    $.post($(this).attr('action'), $(this).serialize(), function (resp) {
        loader_stop();
        if (resp.type == "success") {
            window.location.href = resp.url;
        } else if (resp.type == "validation") {
            $.each(resp.message, function (index, elem) {
                $("#" + index).closest(".form-group").addClass('has-error');
                $("#" + index).closest(".form-group").find('.help-block').html(elem);
            })
        } else if (resp.type == "warning") {
            error_msg(resp.message.email);
            if ('You are already a verified user. Please login to your account.' === resp.message.email) {
                setTimeout(function () {
                    $('.login-indicator').removeClass('hide');
                }, 5000);
            }
        }
    }, 'json');
});
$(document).on('submit', '#post-password-form', function (e) {
    e.preventDefault();
    loader_start();
    $('.has-error').removeClass('has-error');
    $('.help-block').html('');
    $.post($(this).attr('action'), $(this).serialize(), function (resp) {
        loader_stop();
        if (resp.type == "success") {
            window.location.href = resp.url;
        } else if (resp.type == "validation") {
            $.each(resp.message, function (index, elem) {
                $("#" + index).closest(".form-group").addClass('has-error');
                $("#" + index).closest(".form-group").find('.help-block').html(elem);
            })
        } else if (resp.type == "warning") {
            if (resp.message.password) {
                error_msg(resp.message.password);
            } else if (resp.message.password_confirmation) {
                error_msg(resp.message.password_confirmation);
            }
        }
    }, 'json');
});
$(document).on('submit', '#post-login-form', function (e) {
    e.preventDefault();
    loader_start();
    $('.has-error').removeClass('has-error');
    $('.help-block').html('');
    $.post($(this).attr('action'), $(this).serialize(), function (resp) {
        loader_stop();
        if (resp.type == "success") {
            window.location.href = resp.url;
        } else if (resp.type == "validation") {
            $.each(resp.message, function (index, elem) {
                $("#" + index).closest(".form-group").addClass('has-error');
                $("#" + index).closest(".form-group").find('.help-block').html(elem);
            })
        } else if (resp.type == "warning") {
            if (resp.message.email) {
                error_msg(resp.message.email);
            } else if (resp.message.password) {
                error_msg(resp.message.password);
            } else {
                error_msg(resp.message);
            }
        }
    }, 'json');
});
$(document).on('submit', '#post-forgot-password-form', function (e) {
    e.preventDefault();
    loader_start();
    $('.has-error').removeClass('has-error');
    $('.help-block').html('');
    $('.login-indicator').addClass('hide');
    $.post($(this).attr('action'), $(this).serialize(), function (resp) {
        loader_stop();
        if (resp.type == "success") {
            window.location.href = resp.url;
        } else if (resp.type == "validation") {
            $.each(resp.message, function (index, elem) {
                $("#" + index).closest(".form-group").addClass('has-error');
                $("#" + index).closest(".form-group").find('.help-block').html(elem);
            })
        } else if (resp.type == "warning") {
            error_msg(resp.message.email);
        }
    }, 'json');
});
$(document).on('submit', '#post-reset-password-form', function (e) {
    e.preventDefault();
    loader_start();
    $('.has-error').removeClass('has-error');
    $('.help-block').html('');
    $.post($(this).attr('action'), $(this).serialize(), function (resp) {
        loader_stop();
        if (resp.type == "success") {
            window.location.href = resp.url;
        } else if (resp.type == "validation") {
            $.each(resp.message, function (index, elem) {
                $("#" + index).closest(".form-group").addClass('has-error');
                $("#" + index).closest(".form-group").find('.help-block').html(elem);
            })
        } else if (resp.type == "warning") {
            if (resp.message.password) {
                error_msg(resp.message.password);
            } else if (resp.message.password_confirmation) {
                error_msg(resp.message.password_confirmation);
            }
        }
    }, 'json');
});