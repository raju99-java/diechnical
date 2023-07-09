/* global full_path */

// window height //
var currentRequest = null;
function ajaxindicatorstart() {
    if (jQuery('body').find('#resultLoading').attr('id') != 'resultLoading') {
        jQuery('body').append('<div id="resultLoading" style="display:none"><div><i style="font-size: 46px;color: #B40B2B;" class="fa fa-spinner fa-spin fa-2x fa-fw" aria-hidden="true"></i></div><div class="bg"></div></div>');
    }
    jQuery('#resultLoading').css({
        'width': '100%',
        'height': '100%',
        'position': 'fixed',
        'z-index': '10000000',
        'top': '0',
        'left': '0',
        'right': '0',
        'bottom': '0',
        'margin': 'auto'
    });
    jQuery('#resultLoading .bg').css({
        'background': '#ffffff',
        'opacity': '0.8',
        'width': '100%',
        'height': '100%',
        'position': 'absolute',
        'top': '0'
    });
    jQuery('#resultLoading>div:first').css({
        'width': '250px',
        'height': '75px',
        'text-align': 'center',
        'position': 'fixed',
        'top': '0',
        'left': '0',
        'right': '0',
        'bottom': '0',
        'margin': 'auto',
        'font-size': '16px',
        'z-index': '10',
        'color': '#ffffff'
    });
    jQuery('#resultLoading .bg').height('100%');
    jQuery('#resultLoading').fadeIn(300);
    jQuery('body').css('cursor', 'wait');
}

function ajaxindicatorstop() {
    jQuery('#resultLoading .bg').height('100%');
    jQuery('#resultLoading').fadeOut(300);
    jQuery('body').css('cursor', 'default');
}

function success_msg(msg) {
    // $.iaoAlert({
    //     type: "success",
    //     position: "bottom-right",
    //     mode: "dark",
    //     msg: msg,
    //     autoHide: true,
    //     alertTime: "9000",
    //     fadeTime: "1000",
    //     closeButton: true,
    //     fadeOnHover: true,
    //     zIndex: '9999',
    // });
    swal("",msg,"success",{
        buttons: false,
        timer: 5000,
    });
    
}
function  error_msg(msg) {
    // $.iaoAlert({
    //     type: "error",
    //     position: "bottom-right",
    //     mode: "dark",
    //     msg: msg,
    //     autoHide: true,
    //     alertTime: "3000",
    //     fadeTime: "9000",
    //     closeButton: true,
    //     fadeOnHover: true,
    //     zIndex: '9999',
    // });
    swal("",msg,"error",{
        buttons: false,
        timer: 5000,
    });
}
jQuery(document).ready(function ($) {
    adjustWinHeight();
    $(window).resize(function () {
        adjustWinHeight();
    });
    function adjustWinHeight() {
        var $ = jQuery;
        var winHeight = $(window).height();
        var footerHeight = $('.site-footer').height();
        var headerHeight = $('.site-header').height();
        var mainHeight = winHeight - (footerHeight + headerHeight);
        $('.index-main').css('min-height', mainHeight);
        $('.main').css('min-height', mainHeight);
        $('.main .dashboard').css('min-height', mainHeight);
    }

// fixed header //

    $(window).scroll(function () {
        var scroll = $(window).scrollTop();
        if (scroll >= 100) {
            $(".site-header").addClass("fixed-header");
            $(".site-header").addClass("animated");
            $(".site-header").addClass("fadeInDown");
        } else if (scroll <= 1) {
            $(".site-header").removeClass("fixed-header");
            $(".site-header").removeClass("animated");
            $(".site-header").removeClass("fadeInDown");
        }
    });
// Responsive Menu //

    $(document).ready(function () {
        $(".site-menu #nav-toggle").click(function (e) {
            $(".site-menu ul").slideToggle('slow');
            $("#navigation-icon").toggle();
            $("#times-icon").toggle();
        });
//        if ($(window).width() < 1024) {
//            $('body').on('click', function () {
//                $('.site-menu ul').slideUp('slow');
//                $("#navigation-icon").show();
//                $("#times-icon").hide();
//            });
//        } else {
//            $('.site-menu ul').show('');
//        }
    });
    // scroll to top //

    $(window).scroll(function () {
        if ($(this).scrollTop() > 75) {
            $('#scroll_top').slideDown();
            $('#scroll_top').addClass('show-top');
        } else {
            $('#scroll_top').slideDown();
            $('#scroll_top').removeClass('show-top');
        }
    });
    $('#scroll_top').click(function () {
        $("html, body").animate({scrollTop: 0}, 1500);
        return false;
    });

    /*********** Dashboard Menu *************/

    if ($(window).width() < 768) {
        $('#dashsidenav-toggle').click(function () {
            $('.left-side-item').slideToggle();
        });
        $('#dashsidenav-toggle').on('click', function () {
            this.classList.toggle('active');
        });
    } else {
        $('.left-side-item').show('');
    }
    if ($(window).width() < 1921) {
        $('#dashsidenav-toggle').click(function () {
            $('.user-left-side').toggleClass("slide-left");
            $('.dash-right').toggleClass("slide-right");
        });
    }

});
$(document).ready(function () {
    $('#submit-exam').click(function () {
        $.confirm({
            title: 'Submit Exam',
            content: 'Are you sure to submit the exam',
            type: 'red',
            typeAnimated: true,
            buttons: {
                confirm: {
                    text: '<i class="fa fa-check" aria-hidden="true"></i> Confirm',
                    btnClass: 'btn-red',
                    action: function () {
                        submitExam();
                        // alert(1);
                    }
                },
                cancel: function () {}
            }
        });
    });
    $('#exam-form').submit(function (event) {


    });
    $('#download-result-form').submit(function (event) {
        event.preventDefault();
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
                
                document.getElementById("download-result-form").reset();
                
                ajaxindicatorstop();
                // var link = document.createElement('a');
                
                // link.href = resp.file;
                // link.download = "Result.pdf";
                // alert(link.href);
                // link.click();
                // link.remove();
                $('#result-content').html(resp.content);
                success_msg(resp.msg, 5000);
                



            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $("#error-" + key).html(val[0]).closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        })
    });
    $('#download-icard-form').submit(function (event) {
        event.preventDefault();
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
                
                document.getElementById("download-icard-form").reset();
                
                ajaxindicatorstop();
                var link = document.createElement('a');
                link.href = resp.file;
                link.download = "I-card.pdf";
                link.click();
                link.remove();
                success_msg(resp.msg, 5000);
                



            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $("#error-" + key).html(val[0]).closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        })
    });
    
    
    
    $('#search_center').submit(function (event){
        event.preventDefault();
        // alert(1);return;
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
                
                
                    if(resp.code == 1){
                        success_msg(resp.msg, 5000);
                    }else{
                        error_msg(resp.msg, 5000);
                    }
                    
                    
                    
                    console.log(resp.franchise);
                    if(resp.franchise){
                        $('#here_table').show();
                         
                        
                        $.each(resp.franchise, function (i) {
                            $.each(resp.franchise[i], function (key, val) {
                                
                                if(key == 'owner_image'){
                                    $('#here_table table tbody tr .image').append( '<td colspan="3">' + '<img height="90" width="115" src=" '+ resp.image_url+'/'+val +' " />'  + '</td>' );
                                    
                                }
                                if(key == 'name'){
                                    
                                    $('#here_table table tbody tr .name').append('<td colspan="3">' + val + '</td>');
                                    
                                }
                                if(key == 'registration_id'){
                                    
                                    $('#here_table table tbody tr .code').append('<td colspan="3">' + val + '</td>');
                                    
                                }
                                if(key == 'phone'){
                                    
                                    $('#here_table table tbody tr .phone').append('<td>' + val + '</td>');
                                    
                                }
                                if(key == 'email'){
                                    
                                    $('#here_table table tbody tr .email').append('<td>' + val + '</td>');
                                    
                                }
                                if(key == 'city'){
                                    
                                    $('#here_table table tbody tr .city').append('<td>' + val + '</td>');
                                    
                                }
                                if(key == 'district'){
                                    
                                    $('#here_table table tbody tr .district').append('<td>' + val + '</td>');
                                    
                                }
                                if(key == 'state'){
                                    
                                    $('#here_table table tbody tr .state').append('<td>' + val + '</td>');
                                    
                                }
                                
                                
                            });
                        });
                        
                    }
                    // $('#surl').val(resp.surl);
                    // $('#furl').val(resp.furl);
                    // $('#txnid').val(resp.txnid);
                    // $('#firstname').val(resp.firstname);
                    // $('#email').val(resp.email);
                    // $('#hash').val(resp.hash);
                    // $('#phone').val(resp.phone);
                    
                    // $('#signup-form')[0].reset();
                    ajaxindicatorstop();
                   
                
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $("#error-" + key).html(val[0]).closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        })
    });
    
    
    $('#subscription-form').submit(function (event) {
        event.preventDefault();
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
                document.getElementById("subscription-form").reset();
                success_msg(resp.msg, 5000);
                ajaxindicatorstop();



            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    
                    $("#error-" + key).html(val[0]).closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        })
    });
    $('#leads-form').submit(function (event) {
        event.preventDefault();
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
                document.getElementById("leads-form").reset();
                success_msg(resp.msg, 5000);
                ajaxindicatorstop();



            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $("#error-" + key).html(val[0]).closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        })
    });
    $('#check-out-form').submit(function (event) {
        event.preventDefault();
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
//                alert(1);
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


    $('#signup-form').submit(function (event) {
        event.preventDefault();
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
                $('#amount').val(resp.amount);
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


    $('#login-form').submit(function (event) {
        event.preventDefault();
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
                window.location.href = resp.link;
                ajaxindicatorstop();
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $("#error-" + key).html(val[0]).closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        })
    });


    $('#forgot-form').submit(function (event) {
        event.preventDefault();
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
                $('#forgot-form')[0].reset();
                // window.location.href = resp.link;
                ajaxindicatorstop();
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $("#error-" + key).html(val[0]).closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        })
    });
    $('#reset-password-frm').submit(function (event) {
        event.preventDefault();
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
                $('#reset-password-frm')[0].reset();
                ajaxindicatorstop();
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $("#err-" + key).html(val[0]).closest('.form-group').addClass('has-error');
                });

                ajaxindicatorstop();
            }
        })
    });
    $('#reset-password-form').submit(function (event) {
        event.preventDefault();
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
//                $.iaoAlert({
//                    type: "success",
//                    position: "top-right",
//                    mode: "dark",
//                    msg: resp.msg,
//                    autoHide: true,
//                    alertTime: "3000",
//                    fadeTime: "1000",
//                    closeButton: true,
//                    fadeOnHover: true,
//                });
                $('#reset-password-form')[0].reset();

                ajaxindicatorstop();
                window.location.href = resp.link;
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $("#error-" + key).html(val[0]).closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        })
    });

    $('#customer-editprofile-form').submit(function (event) {
        event.preventDefault();
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
                ajaxindicatorstop();
                window.location.href = resp.link;
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $("#err-" + key).html(val[0]).closest('.form-group').addClass('has-error');
                });

                ajaxindicatorstop();
            }
        });
    });
    $(document).on('submit', '#contact-us-form', function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('');
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
                $('#contact-us-form')[0].reset();
                success_msg(resp.msg, 5000);
                ajaxindicatorstop();
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $('#contact-us-form').find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
                    $('#contact-us-form').find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        });
    });
    $(document).on('submit', '#franchise-request-form', function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('');
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
                
                if(resp.free == '1'){
                        
                        $('#franchise-request-form')[0].reset();
                        success_msg(resp.msg, 10000);
                        
                        setTimeout(function(){
                            ajaxindicatorstop();
                        }, 10000);
                    
                    
                }
                
                if(resp.free == '0'){
                    $('#franchise-request-form')[0].reset();
                    success_msg(resp.msg, 5000);
                    $('#surl').val(resp.surl);
                    $('#furl').val(resp.furl);
                    $('#txnid').val(resp.txnid);
                    $('#amount').val(resp.amount);
                    $('#firstname').val(resp.firstname);
                    $('#email').val(resp.email);
                    $('#hash').val(resp.hash);
                    $('#phone').val(resp.phone);
                    
                    // $('#signup-form')[0].reset();
                    ajaxindicatorstop();
                    submitPayuForm();
                }
                
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $('#franchise-request-form').find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
                    $('#franchise-request-form').find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        });
    });
    $(document).on('submit', '#enquiry-form', function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('');
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
                $('#enquiry-form')[0].reset();
                success_msg(resp.msg, 5000);
                ajaxindicatorstop();
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $("#error-" + key).html(val[0]).closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        });
    });


});


/********** Service list image upload ************/

$(document).on("click", ".browse", function () {
    var file = $(this).parents().find(".file");
    file.trigger("click");
});
$('input[type="file"]').change(function (e) {
    var fileName = e.target.files[0].name;
    $("#file").val(fileName);
});

function test()
{
    window.close();

    window.onunload = function () {
        window.opener.location.reload();
    };
}
function submitExam() {
    // event.preventDefault();
    ajaxindicatorstart();
    $('.help-block').html('').closest('.form-group').removeClass('has-error');
    var url = $('#exam-form').attr('action');
    var csrf_token = $('input[name=_token]').val();

    var data = $('#exam-form').serialize();
    // var data = new FormData($(this)[0]);
    $.ajax({
        url: full_path + 'post-give-exam',
        headers: {'X-CSRF-TOKEN': csrf_token},
        type: 'POST',
        dataType: 'json',
        data: data,
        success: function (resp) {
            document.getElementById("exam-form").reset();
            ajaxindicatorstop();
            window.close();
            window.onunload = function () {
                window.opener.location.reload();
            };


        },
        error: function (resp) {
            $.each(resp.responseJSON.errors, function (key, val) {
                $("#error-" + key).html(val[0]).closest('.form-group').addClass('has-error');
            });
            ajaxindicatorstop();
        }
    })
}
function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}
function submitExam(){
    // event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $('#exam-form').attr('action');
        var csrf_token = $('input[name=_token]').val();
        
        var data = $('#exam-form').serialize();
        // var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function (resp) {
                document.getElementById("exam-form").reset();
                ajaxindicatorstop();
                window.close();
                window.onunload = function(){
                    window.opener.location.reload();
                };
                

            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $("#error-" + key).html(val[0]).closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        })
}
function AddtoWishlist(obj) {
    ajaxindicatorstart();
    var id = $(obj).data('id');
    var csrf_token = $('input[name=_token]').val();
    currentRequest = $.ajax({
        type: 'POST',
        headers: {'X-CSRF-TOKEN': csrf_token},
        url: full_path + 'add-wishlist',
        dataType: 'json',
        data: {id: id},
        beforeSend: function () {
            if (currentRequest !== null) {
                currentRequest.abort();
            }
        },
        success: function (resp) {
            if (resp.status == 'failure') {
                if(resp.type){
                    ajaxindicatorstop();
                    window.location.href = resp.link;
                }
                error_msg(resp.msg);
            } else {
                
                $('.wishlist').html(resp.count);
                success_msg(resp.msg);
            }
            ajaxindicatorstop();
        }
    });
}
function removeWishlist(id, obj) {
    $.confirm({
        title: 'Delete',
        content: 'Are you sure to delete this course from wishlist?',
        buttons: {
            confirm: {
                btnClass: 'btn-success',
                action: function () {
                    ajaxindicatorstart();
                    var csrf_token = $('input[name=_token]').val();
                    $.ajax({
                        type: 'POST',
                        headers: {'X-CSRF-TOKEN': csrf_token},
                        url: full_path + 'remove-wishlist',
                        dataType: 'json',
                        data: {id: id},
                        success: function (resp) {
                            if (resp.type === 1) {
                                $(obj).closest('tr').remove();
                                $('.wishlist').html(resp.count);
                                if (resp.content) {
                                    location.reload();
                                }
                                success_msg(resp.msg);
                            } else {
                                error_msg(resp.msg);
                            }
                            ajaxindicatorstop();
                        }
                    });
                }
            },
            cancel: {
                btnClass: 'btn-danger'
                        //
            },
        }
    });
}
function BuyNow(obj) {
    ajaxindicatorstart();
    var id = $(obj).data('id');
    var csrf_token = $('input[name=_token]').val();
    currentRequest = $.ajax({
        type: 'POST',
        headers: {'X-CSRF-TOKEN': csrf_token},
        url: full_path + 'buy-now',
        dataType: 'json',
        data: {id: id},
        beforeSend: function () {
            if (currentRequest !== null) {
                currentRequest.abort();
            }
        },
        success: function (resp) {
            if (resp.status == 'failure') {
                if(resp.type){
                    ajaxindicatorstop();
                    window.location.href = resp.link;
                }
                error_msg(resp.msg);
            } else {
                
                $('.cart').html(resp.count);
                success_msg(resp.msg);
                window.location.href = resp.link;
            }
            ajaxindicatorstop();
        }
    });
}
function AddtoCart(obj) {
    ajaxindicatorstart();
    var id = $(obj).data('id');
    var csrf_token = $('input[name=_token]').val();
    currentRequest = $.ajax({
        type: 'POST',
        headers: {'X-CSRF-TOKEN': csrf_token},
        url: full_path + 'add-cart',
        dataType: 'json',
        data: {id: id},
        beforeSend: function () {
            if (currentRequest !== null) {
                currentRequest.abort();
            }
        },
        success: function (resp) {
            if (resp.status == 'failure') {
                if(resp.type){
                    ajaxindicatorstop();
                    window.location.href = resp.link;
                }
                error_msg(resp.msg);
            } else {
                
                $('.cart').html(resp.count);
                success_msg(resp.msg);
            }
            ajaxindicatorstop();
        }
    });
}
function removeCart(id, obj) {
    $.confirm({
        title: 'Delete',
        content: 'Are you sure to delete this course from cart?',
        buttons: {
            confirm: {
                btnClass: 'btn-success',
                action: function () {
                    ajaxindicatorstart();
                    var csrf_token = $('input[name=_token]').val();
                    $.ajax({
                        type: 'POST',
                        headers: {'X-CSRF-TOKEN': csrf_token},
                        url: full_path + 'remove-cart',
                        dataType: 'json',
                        data: {id: id},
                        success: function (resp) {
                            if (resp.type === 1) {
                                $(obj).closest('tr').remove();
                                $('.cart').html(resp.count);
                                if (resp.content) {
                                    location.reload();
                                }
                                success_msg(resp.msg);
                            } else {
                                error_msg(resp.msg);
                            }
                            ajaxindicatorstop();
                        }
                    });
                }
            },
            cancel: {
                btnClass: 'btn-danger'
                        //
            },
        }
    });
}
function change_picture()
{
    var file = $('#change_picture')[0].files[0];
    if (file.size > 2097152)
    {
        $("#progressOuter").hide();
        $("#progressBar").css("width", "0%");
        notie.alert({
            type: 'error',
            text: '<i class="fa fa-close"></i> File cannot be upload greater then 2 MB',
            time: 3
        });
        return false;
    }
    var csrf_token = $('input[name=_token]').val();
    var formdata = new FormData();
    formdata.append("image", file);
    var percentComplete = 0;
    $.ajax({
        xhr: function () {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener("progress", function (evt) {
                if (evt.lengthComputable) {
                    percentComplete = evt.loaded / evt.total;
                    percentComplete = parseInt(percentComplete * 100);
                    $("#progressOuter").show();
                    $("#progressBar").css("width", Math.round(percentComplete) + "%");
                    $("#progressBar").html(Math.round(percentComplete) + "%");
                    if (percentComplete === 100) {
                    }
                }
            }, false);
            return xhr;
        },
        url: full_path + 'upload-picture',
        headers: {'X-CSRF-TOKEN': csrf_token},
        method: "POST",
        dataType: "JSON",
        processData: false,
        contentType: false,
        data: formdata,
        success: function (response) {
            console.log(response);
            if (response.status == "success")
            {
                $.iaoAlert({
                    type: "success",
                    position: "top-right",
                    mode: "dark",
                    msg: response.msg,
                    autoHide: true,
                    alertTime: "3000",
                    fadeTime: "1000",
                    closeButton: true,
                    fadeOnHover: true,
                });
                $("#progressOuter").hide();
                $("#progressBar").css("width", "0%");
                $("#progressBar").html("0%");
                window.location.href = response.link;
            } else if (response.status == "error")
            {
                $.iaoAlert({
                    type: "error",
                    position: "top-right",
                    mode: "dark",
                    msg: '<i class="fa fa-close"></i>' + response.errors.logo[0],
                    autoHide: true,
                    alertTime: "3000",
                    fadeTime: "1000",
                    closeButton: true,
                    fadeOnHover: true,
                });
                $("#progressOuter").hide();
                $("#progressBar").css("width", "0%");
                $("#progressBar").html("0%");
            } else {
                $.iaoAlert({
                    type: "error",
                    position: "top-right",
                    mode: "dark",
                    msg: response.msg,
                    autoHide: true,
                    alertTime: "3000",
                    fadeTime: "1000",
                    closeButton: true,
                    fadeOnHover: true,
                });
                $("#progressOuter").hide();
                $("#progressBar").css("width", "0%");
                $("#progressBar").html("0%");
            }
        }
    });
}











