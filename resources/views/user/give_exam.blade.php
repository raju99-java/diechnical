
<!DOCTYPE html>
<html>

    <head>
        <script type="text/javascript">
            var full_path = '<?= url('/') . '/'; ?>';
            var logged_in = '<?= (Auth()->guard('frontend')->guest()) ? true : false; ?>';
        </script>
        <meta charset="UTF-8">
        <title>GIVE EXAM</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="keywords" content="&lt;p&gt;Company Product Related Keywords&lt;/p&gt;">
        <meta name="description" content="&lt;p&gt;Company Name&lt;/p&gt;">
        <meta property="og:title" content="" />
        <meta property="og:image" content="add image" />
        <meta property="og:description" content="Company Product Describtion" />
        <!--Website Theme Color-->
        <!-- Chrome, Firefox OS and Opera -->
        <meta name="theme-color" content="#fff">
        <!-- Windows Phone -->
        <meta name="msapplication-navbutton-color" content="#fff">
        <!-- iOS Safari -->
        <meta name="apple-mobile-web-app-status-bar-style" content="#fff">
        <link rel="icon" href="{{ URL::asset('favicon.png') }}">
        <!--<link rel="shortcut icon" href="{{ URL::asset('favicon.png') }}">-->
        <!----bootstrape css----->

        <link href="{{ URL::asset('public/frontend/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <!--fontawesome-4-->
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <!--font-->
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
        <!---custom css---->
        <link href="{{ URL::asset('public/di-exam/css/examstyle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('public/di-exam/css/sweetalert.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('public/di-exam/css/front-exam.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('public/di-exam/css/morris.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('public/di-exam/css/materialdesignicons.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{ URL::asset('public/backend/css/jquery-confirm.css') }}" />
        <style>
            /* Hide all steps by default: */
            .tab {
                display: none;
                /* min-height: 400px;
                max-height: 400px; */
            }
            /* Make circles that indicate the steps of the form: */
            .step {
                height: 15px;
                width: 15px;
                margin: 0 2px;
                background-color: #bbbbbb;
                border: none;
                border-radius: 50%;
                display: inline-block;
                opacity: 0.5;
            }

            .step.active {
                opacity: 1;
            }

            /* Mark the steps that are finished and valid: */
            .step.finish {
                background-color: #04AA6D;
            }
            .cursor{
                cursor: pointer;
            }
        </style>
    </head>


    <body>
        <!-- NAVIGATION -->
        <!-- /NAVIGATION -->
        <div id="wrapper" class="mt-15">
            <!-- Navigation -->
            <nav role="navigation"></nav>
            <aside class="right-sidebar mt-50" id="rightSidebar">
                <div class="panel panel-right-sidebar ">
                    <div class="panel-heading">
                        <h2>Time Status</h2>
                    </div>
                    <div class="panel-body">
                        <div id="timerdiv" class="countdown-styled "><span id="hours">00</span> :<span id="mins">{{$time->value}}</span> :<span id="seconds">00</span>
                        </div>
                    </div>
                    <div class="panel-heading countdount-heading">
                        <h2>Total Time <span class="pull-right">00:{{$time->value}}:00</span></h2>
                    </div>
                    <div class="panel-body">
                        <div class="sub-heading">
                            <h3>Examination</h3>
                        </div>
                        <ul class="question-palette" id="pallete_list">
                            @foreach($question_answers as $count =>$qa)
                            <?php
                            $c = $count + 1;
                            $question = 'q' . $c . '_id';
                            $answer = 'q' . $c . '_answer';
                            ?>
                            <li class="palette pallete-elements not-visited" onclick="showSpecificQuestion({{$count}});"><span>{{$c}}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <hr>
                    <div class="panel-heading">
                        <h2>Summary</h2>
                    </div>
                    <div class="panel-body">
                        <ul class="legends">
                            <li class="palette answered"><span id="palette_total_answered">1</span> Answered</li>
                             <li class="palette marked"><span id="palette_total_marked">2</span> Marked</li> 
                            <li class="palette not-answered"><span id="palette_total_not_answered">3</span> Not Answered</li>
                            <li class="palette not-visited"><span id="palette_total_not_visited">4</span> Not Visited</li>
                        </ul>
                    </div>
                </div>
            </aside>

            <div id="page-wrapper" class="examform">
                <div class="container-fluid">
                    
                    
                   <form id="exam-form" action="{{ Route('post-give-exam', ['id' => $id])}}" method="POST" class="">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-custom">
                                    <div class="panel-heading">
                                        <div class="pull-right exam-duration"></div>
                                        <h1><span class="text-uppercase"> Examining </span>: Question <span id="question_number">1</span> of 35</h1>
                                    </div>
                                    <div class="panel-body question-ans-box">
                                        <div id="questions_list">
                                            @foreach($question_answers as $count =>$qa)

                                            <?php
                                            $c=$count+1;
                                            $question='q'. $c .'_id';
                                            $answer='q'. $c .'_answer';
                                            ?>
                                            
                                            <div class="question_div subject_1" name="question[58]" id="58" style="display:none;" value="0">
                                                <input type="hidden" name="{{$question}}" value="{{$qa->id}}">
                                                <!--<input type="hidden" name="time_spent[58]" id="time_spent_58" value="0">-->
                                                <div class="questions"> <span class="language_l1"> <p>{!! $qa->question !!}</p></span>
                                                    
                                                    <div class="row">
                                                        <div class="col-md-8 text-center"></div>
                                                        <div class="col-md-4"> <span class="pull-right"> 2 Mark(s)</span>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <hr>
                                                <div class="select-answer">
                                                    <ul class="row list-style-none">
                                                        <li class="col-md-6">
                                                            <input id="{{$answer}}_option1" value="option1" name="{{$answer}}" type="radio" class="cursor"/>
                                                            <label for="{{$answer}}_option1"> 
                                                                <span class="language_l1 cursor">{{$qa->option1}}</span>
                                                            </label>
                                                        </li>
                                                        <li class="col-md-6">
                                                            <input id="{{$answer}}_option2" value="option2" name="{{$answer}}" type="radio" class="cursor"/>
                                                            <label for="{{$answer}}_option2"> 
                                                                <span class="language_l1 cursor">{{$qa->option2}}</span>
                                                            </label>
                                                        </li>
                                                        <li class="col-md-6">
                                                            <input id="{{$answer}}_option3" value="option3" name="{{$answer}}" type="radio" class="cursor"/>
                                                            <label for="{{$answer}}_option3"> 
                                                                <span class="language_l1 cursor">{{$qa->option3}}</span>
                                                            </label>
                                                        </li>
                                                        <li class="col-md-6">
                                                            <input id="{{$answer}}_option4" value="option4" name="{{$answer}}" type="radio" class="cursor"/>
                                                            <label for="{{$answer}}_option4"> 
                                                                <span class="language_l1 cursor">{{$qa->option4}}</span>
                                                            </label>
                                                        </li>
                                                    </ul>
                                                </div>
                                                </hr>
                                            </div>
                                            @endforeach
                                            
                                      
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button class="btn btn-lg btn-success button prev" type="button"> <i class="fa fa-chevron-left ">

                                                    </i>
                                                    Previous</button>
                                                <button class="btn btn-lg btn-dark button next" id="markbtn" type="button">Mark For Review & Next</button>
                                                <button class="btn btn-lg btn-success button next" type="button">Next <i class="fa fa-chevron-right">

                                                    </i>
                                                </button>
                                                <button class="btn btn-lg btn-dark button clear-answer" type="button">Clear Answer</button>
                                                <button class="btn btn-lg btn-danger button   finish" type="button" id="submit-exam">Finish</button>
                                            </div>
                                        </div>
                                        </hr>
                                    </div>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <script src="{{ URL::asset('public/di-exam/js/jquery-3.1.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('public/di-exam/js/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('public/di-exam/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('public/di-exam/js/exam-main.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('public/di-exam/js/all.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ URL::asset('public/backend/js/jquery-confirm.js') }}"></script>
    <script src="{{ URL::asset('public/frontend/custom/js/script.js') }}" type="text/javascript"></script>
    <script>
        var csrfToken = $('[name="csrf_token"]').attr('content');
        setInterval(refreshToken, 600000); // 1 hour 

        function refreshToken(){
        $.get('refresh-csrf').done(function(data){
        csrfToken = data; // the new token
        });
        }

        setInterval(refreshToken, 600000); // 1 hour
    </script>
    <script src="{{ URL::asset('public/di-exam/js/angular.js') }}"></script>
    <script>
                                                                var app = angular.module('academia', []);
                                                                app.controller('angExamScript', function($scope, $http) {

                                                                $scope.initAngData = function(data) {
                                                                if (data == '')
                                                                {
                                                                return;
                                                                }

                                                                $scope.hints = 0;
                                                                        $scope.saved_bookmarks = [];
                                                                        $scope.intilizeBookmarks('questions');
                                                                        $scope.bookmarks = [];
                                                                        angular.forEach(data, function(value, index) {
                                                                        $scope.bookmarks[value] = 0;
                                                                        });
                                                                }

                                                                $scope.getToken = function(){
                                                                return  $('[name="_token"]').val();
                                                                }
                                                                $scope.isBookmarked = function(item_id) {

                                                                res = $scope.findIndexInData($scope.saved_bookmarks, 'item_id', item_id)

                                                                        return res;
                                                                }
                                                                $scope.findIndexInData = function (Array, property, action) {

                                                                var result = - 1;
                                                                        angular.forEach(Array, function(value, index) {

                                                                        if (value[property] == action){

                                                                        result = index;
                                                                        }

                                                                        });
                                                                        return result;
                                                                }
                                                                });
                                                                var EFFECT = 'bounceInDown';
                                                                var DURATION = 500;
                                                                var DIV_REFERENCE = $("#questions_list .question_div");
                                                                var MAXIMUM_QUESTIONS = $("#questions_list .question_div").size();
                                                                var VISIBLE_ELEMENT = "#questions_list .question_div:visible";
                                                                var HINTS = 0;
                                                                var ANSWERED = ' answered';
                                                                var NOT_ANSWERED = ' not-answered';
                                                                var ANSWER_MARKED = ' marked';
                                                                var NOT_VISITED = ' not-visited';
                                                                var TOTAL_ANSWERED = 0;
                                                                var TOTAL_MARKED = 0;
                                                                var TOTAL_NOT_VISITED = MAXIMUM_QUESTIONS;
                                                                var TOTAL_NOT_ANSWERED = MAXIMUM_QUESTIONS;
                                                                var HOURS = 0;
                                                                var MINUTES = 0;
                                                                var SECONDS = 0;
                                                                var SPENT_TIME = [];
                                                                DIV_REFERENCE.first().show();
                                                                updateCount();
                                                                // onlclick of next button

                                                                $('.next').click(function() {

                                                        nextClick($(this).attr('id'));
                                                                $('.next #markbtn').show();
                                                        });
                                                                // onlclick of prev button

                                                                $('.prev').click(function() {

                                                        prevClick($(this).attr('id'));
                                                        });
                                                                $('.clear-answer').click(function() {

                                                        clearAnswer();
                                                        });
                                                                function nextClick(argument) {

                                                                is_marked = 0;
                                                                        if (argument == 'markbtn') {

                                                                is_marked = 1;
                                                                }

                                                                processNext(is_marked);
                                                                        $(VISIBLE_ELEMENT).next('div').fadeIn(DURATION).prev().hide();
                                                                        doGeneralOperations();
                                                                        return false;
                                                                }

                                                        function prevClick(argument) {

                                                        is_marked = 0;
                                                                if (argument == 'markbtn') {

                                                        is_marked = 1;
                                                        }

                                                        processNext(is_marked);
                                                                $(VISIBLE_ELEMENT).prev('div').fadeIn(DURATION).next().hide();
                                                                doGeneralOperations();
                                                                return false;
                                                        }



                                                        function clearAnswer() {

                                                        list = $(VISIBLE_ELEMENT + ' input ');
                                                                $.each(list, function() {

                                                                elementType = $(this).attr('type');
                                                                        switch (elementType) {

                                                                case 'radio': $(this).prop('checked', false); break;
                                                                        case 'checkbox': $(this).attr('checked', false); break;
                                                                        case 'text': $(this).val(''); break;
                                                                }



                                                                });
                                                        }



                                                        function bookmark(operation) {

                                                        item_id = $(VISIBLE_ELEMENT).attr('id');
                                                                item_type = 'questions';
                                                                angular.element('.examform').scope().bookmark(item_id, operation, item_type);
                                                                angular.element('.examform').scope().$apply();
                                                        }



                                                        function processNext(is_marked) {



                                                        list = $(VISIBLE_ELEMENT + ' input ');
                                                              

                                                                textarea_list = $(VISIBLE_ELEMENT + ' textarea ');
                                                                
                                                                answer_status = 0;
                                                              

                                                                if (list != 0) {

                                                        list.each(function(index, value){



                                                        element_type = $(value).attr('type');
                                                                switch (element_type)

                                                        {

                                                        case 'radio': if ($(value).prop('checked')) answer_status = 1; break;
                                                                case 'checkbox': if ($(value).prop('checked')) answer_status = 1; break;
                                                                case 'text': if ($(value).val().length != 0) answer_status = 1; break;
                                                        }

                                                        });
                                                        }


                                                        if (textarea_list.length)

                                                        {

                                                        textarea_list.each(function(index, value){

                                                        if ($(value).val().length != 0)

                                                                answer_status = 1;
                                                        });
                                                        }



                                                        class_name = NOT_ANSWERED;
                                                                if (answer_status) {

                                                        if (is_marked)

                                                                class_name = ANSWER_MARKED;
                                                                else

                                                                class_name = ANSWERED;
                                                        }



                                                        $(".question-palette .pallete-elements:eq(" + getCurrentIndex() + ")")

                                                                .removeClass(NOT_VISITED + NOT_ANSWERED + ANSWER_MARKED)

                                                                .addClass(class_name);
                                                                return false;
                                                        }


                                                        function checkButtonStatus() {

                                                        CURR_INDEX = getCurrentIndex() + 1;
                                                                if (CURR_INDEX == MAXIMUM_QUESTIONS)

                                                        {

                                                        $('.next').fadeOut();
                                                                $('.prev').fadeIn();
                                                                $('.next #markbtn').show();
                                                        }
                                                        else if (CURR_INDEX == 1)

                                                        {

                                                        $('.prev').fadeOut();
                                                                $('.next').fadeIn();
                                                        }
                                                        else

                                                        {

                                                        $('.next').show();
                                                                $('.prev').show();
                                                        }



                                                        }


                                                
                                                        function doGeneralOperations() {

                                                        setQuestionNumber();
                                                                checkButtonStatus();
                                                                updateCount();
                                                                return false;
                                                        }




                                                        function getCurrentIndex() {

                                                        return $(VISIBLE_ELEMENT).index();
                                                        }



                                                        function showSpecificQuestion(index) {

                                                        $(VISIBLE_ELEMENT).hide();
                                                                $("#questions_list .question_div:eq(" + index + ")").fadeIn();
                                                                doGeneralOperations();
                                                                return false;
                                                        }




                                                        function updateCount() {

                                                        TOTAL_NOT_ANSWERED = $(".not-answered").length - 1;
                                                                TOTAL_NOT_VISITED = $(".not-visited").length - 1;
                                                                TOTAL_MARKED = $(".marked").length - 1;
                                                                TOTAL_ANSWERED = $(".answered").length - 1;
                                                                $('#palette_total_answered').html(TOTAL_ANSWERED);
                                                                $('#palette_total_marked').html(TOTAL_MARKED);
                                                                $('#palette_total_not_visited').html(TOTAL_NOT_VISITED);
                                                                $('#palette_total_not_answered').html(TOTAL_NOT_ANSWERED);
                                                        }

                                                        function showSubjectQuestion(subject_id) {

                                                        question_number = $($("." + subject_id).first()).attr('id');
                                                                $(VISIBLE_ELEMENT).hide();
                                                                $("#" + question_number).fadeIn();
                                                                doGeneralOperations();
                                                                return false;
                                                        }

                                                        $('.finish').click(function() {



                                                        });
                                                                
                                                                        function setQuestionNumber() {

                                                                        $('#question_number').html(getCurrentQuestionNumber());
                                                                        }



                                                                function getCurrentQuestionNumber() {

                                                                return $(VISIBLE_ELEMENT).index() + 1;
                                                                }

                                                                function intilizetimer(hrs, mins, sec)

                                                                {

                                                                HOURS = hrs;
                                                                        MINUTES = mins;
                                                                        SECONDS = sec;
                                                                        $("#timerdiv").addClass('text-success');
                                                                        startInterval();
                                                                }

                                                                function startInterval()

                                                                {



                                                                timer = setInterval("tictac()", 1000);
                                                                }



                                                                function stopInterval()

                                                                {

                                                                clearInterval(timer);
                                                                
                                                                }







                                                                function tictac(){

                                                                SECONDS--;
                                                                        visible_div_id = $(VISIBLE_ELEMENT).attr('id');
                                                                        if (isNaN(SPENT_TIME[visible_div_id]))

                                                                        SPENT_TIME[visible_div_id] = 0;
                                                                        else

                                                                        SPENT_TIME[visible_div_id] = SPENT_TIME[visible_div_id] + 1;
                                                                        $('#time_spent_' + visible_div_id).val(SPENT_TIME[visible_div_id]);
                                                                        if (SECONDS <= 0)

                                                                {

                                                                MINUTES--;
                                                                        // $("#timerdiv #mins span").text(MINUTES);

                                                                        $("#mins").text(MINUTES);
                                                                        if (MINUTES < 1)

                                                                {



                                                                if (HOURS == 0) {
                                                                $("#timerdiv").removeClass('text-success');
                                                                        $("#timerdiv").addClass("text-red");
                                                                }


                                                                }







                                                                if (MINUTES < 0)

                                                                {
                                                                if (HOURS != 0) {

                                                                MINUTES = 59;
                                                                        HOURS = HOURS - 1;
                                                                        SECONDS = 59;
                                                                        $("#mins").text(MINUTES);
                                                                        $("#hours").text(HOURS);
                                                                        return;
                                                                }
                                                                stopInterval();
                                                                        $("#mins").text('0');
                                                                       

                                                                        //alert('You are exceeded the time to finish the exam.');
                                                                        
                                                                        submitExam();
                                                                }





                                                                SECONDS = 60;
                                                                }



                                                                if (MINUTES >= 0)

                                                                        $("#seconds").text(SECONDS);
                                                                        else

                                                                        $("#seconds").text('00');
                                                                }



                                                                Mousetrap.bind('left', function() {

                                                                prevClick();
                                                                });
                                                                        Mousetrap.bind('right', function() {

                                                                        nextClick();
                                                                        });
                                                                        Mousetrap.bind('escape', function() {

                                                                        clearAnswer();
                                                                        });
                                                                        Mousetrap.bind(['shift+up'], function(e) {

                                                                        bookmark('add');
                                                                        });
                                                                        Mousetrap.bind(['shift+down'], function(e) {

                                                                        bookmark('delete');
                                                                        });
    </script>
    <script type="text/javascript">
                        $(document).ready(function () {

                intilizetimer(00, {{$time->value}}, 1);
                        // intilizetimer(5,20,0);

                });
    </script>
    <script>
    document.onkeydown = function (e) {
        if (e.keyCode == 123) {
            return false;
        }
        if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
            return false;
        }
        if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
            return false;
        }
        if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
            return false;
        }

        if (e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
            return false;
        }
    }
    window.onload = function() {
        document.addEventListener("contextmenu", function(e){
        e.preventDefault();
        if(event.keyCode == 123) {
        disableEvent(e);
        }
    }, false);
    function disableEvent(e) {
        if(e.stopPropagation) {
            e.stopPropagation();
        } else if(window.event) {
            window.event.cancelBubble = true;
        }
    }
    }
    $(document).contextmenu(function() { return false;});
    </script>
    <script>
                window.addEventListener('blur', function(){
   console.log('blur');
}, false);
    </script>
</body>

</html>