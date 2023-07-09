@extends('admin::layouts.main') 
@section('page_css') 
<style>
 .question-ans-box {
    box-shadow: 0 1px 3px 0 rgb(0 0 0 / 20%), 0 1px 1px 0 rgb(0 0 0 / 14%), 0 2px 1px -1px rgb(0 0 0 / 12%);
    background-color: rgb(255,255,255);
    border-radius: 2px;
    padding: 20px;
    margin: 0px 0px 30px;
}
.question h3 {
    font-size: 18px;
    padding: 10px 0px 20px;
    font-weight: 600;
}
.question-no {
    background: #960001;
    padding: 6px;
    color: #fff;
    border-radius: 5px !important;
    text-align: center;
    margin-right: 8px;
    font-size: 15px;
    font-weight: 500;
}
.question-ans {
    font-size: 16px;
    padding: 10px 0px 20px;
    font-weight: 600;
    color: #960001;
    margin-right: 5px;
}
.user-ans h4 {
    font-size: 16px;
    padding: 10px 0px 0px;
    font-weight: 600;
    color: #333;
}
.correct i {
    font-size: 22px;
    color: #05a705;
}
.correct {
    font-size: 18px;
    padding: 10px 0px 20px;
    font-weight: 600;
    color: #05a705;
    line-height: 15px;
}
.correct-ans h4 {
    font-size: 19px;
    font-weight: 600;
    color: #000;
}
</style>
@stop 
@section('content')
<ul class="page-breadcrumb breadcrumb">
	<li> <a href="{{route('admin-dashboard')}}">Home</a>
		<i class="fa fa-circle"></i>
	</li>
	<li> <a href="{{Route('admin-student-exam-answer-index')}}">Exam</a>
		<i class="fa fa-circle"></i>
	</li>
	<li> <span class="active">view</span>
	</li>
</ul>
<div class="container">
<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption"> <i class="fa fa-edit font-red-sunglo"></i>
					<span class="caption-subject font-red-sunglo bold uppercase">View Exam Answers of student {{$model->user->full_name}} course {{$model->course->name}}</span>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
				    <!--question&ansview-->
				       <?php
				       for($i=1;$i<=35;$i++){
				            $question='q'.$i.'_id';
                            $answer='q'.$i.'_answer';
                            
                            $q=$model->$question;
                            $a=$model->$answer;
				           if(isset($q) && isset($a)){
				               $question_answer=App\Model\QuestionAnswer::where('id',$q)->first();
				               
				               if(!empty($question_answer)){
				               $correctanswer=$question_answer->answer;
				            //   print_r($question_answer->$correctanswer);
				            //   exit;
				       ?>
				       
				       
				       <div class="question-ans-box">
				           <div class="question">
				               <h3><span class="question-no">Q.{{$i}}</span> {{isset($question_answer->question)?strip_tags(html_entity_decode($question_answer->question)):'Not Availabe!'}}</h3>
				           </div>
				           <div class="user-ans">
				               <h4><span class="question-ans">Ans:</span>{{isset($question_answer->$a)?$question_answer->$a:'Not Availabe!'}} </h4>
				           </div>
				           <hr>
				           <div class="correct-ans">
				              <h4><span class="correct"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Correct Ans:</span> {{isset($question_answer->$correctanswer)?$question_answer->$correctanswer:'Not Availabe!'}}</h4> 
				           </div>
				       </div> 
				       <?php
				           }
				           }
				       }
				       ?>
				       
				       
				    <!--//question&ansview-->
				</div>
				<div class="form-actions">
					<div class="row">
						<div class="col-md-12 text-center"> 
						    <a href="{{Route('admin-student-exam-answer-index')}}" class="btn btn-primary">Cancel</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
@endsection
@section('page_js') 

@endsection