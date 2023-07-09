@extends('layouts.main')
@section('css')
<style>
    .help-block{
        color:red;
    }
    .card-faqs{
    border-bottom-color: #d7d6d6;
    background-color: #f1f1f1;
}
.faqs-head {
    font-size: 17px;
    color: #0072ad !important;
    font-weight: 700 !important;
    margin: 0 0 0px !important;
    border-bottom: none !important;
}
.faqs-body-text {
    background: #fff;
}
.media {
    color: #716969;
}
.btn-abc {
    color: #fff;
    background-color: #ff5522;
    border-color: #ff5522;
    padding: 10px;
    font-size: 15px;
    font-weight: bold;
    color: #fff;
}
.btn-abc:hover{
    color: #fff;
    background-color: #ff5522;
    border-color: #ff5522;
    padding: 10px;
    font-size: 15px;
    font-weight: bold;
    color: #fff;
}
@media only screen and (max-width: 767px) {
.gappings{
    margin-top: 20px;
}
}
</style>
@endsection
@section('content')

<!--------------------breadcrumb ---------------------->
<section class="breadcrumb about-us-b">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="breadcrumb-title-div">
                    <div class="bread-left-side">
                        <h2>STUDY MATERIAL</h2>
                    </div>
                    <div class="breadcrumb-ul right-side">
                        <ul>
                            <li><a href="{{route('/')}}">HOME</a>/</li>
                            <li><span>Study Material</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!------------------- //breadcrumb ------------------->

<!--------------------------------Main content Start--------------------------->
<section class="main-content">
    <section class="dashboard">
        <div class="container-fluid">
            <div class="row">
                @include('partials.left')
                <div class="col-md-9 col-sm-9 tab_dsh_2">
                    <div class="dash-right-sec">
                        <div class="successfull">
                           <div class="container">
                        <div class="row">
                            <div class="col-sm-12 gappings">
                                <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">

                                    <!-- Accordion card one-->
                                    @forelse($course_modules as $mod => $course_module)
                                    <?php
                                $videos = App\Model\CourseModuleVideo::where('module_id', $course_module->id)->where('status', '1')->get();
                                if (sizeof($videos) > 0) {
                                    $total_lesson_module = App\Model\CourseModuleVideo::where('course_id',$course_module->course_id)->where('module_id',$course_module->id)->where('status','1')->count();
                                    $totaltime= App\Model\CourseModuleVideo::where('course_id',$course_module->course_id)->where('module_id',$course_module->id)->where('status','1')->sum('time');
                                    $hour = floor($totaltime / 60);
                                    $minute = ($totaltime % 60);
                                    ?>
                                    <div class="card card-faqs">
                                
                                      <!-- Card header -->
                                      <div class="card-header" role="tab" id="headingOne{{$mod}}">
                                        <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne{{$mod}}" aria-expanded="false" aria-controls="collapseOne{{$mod}}" class="collapsed">
                                            <h5 class="recent-h5 faqs-head">{{$course_module->name}} <i class="fa fa-angle-down rotate-icon float-right"></i>
                                            </h5>
                                        </a>
                                      </div>
                                      
                                      <!-- Card body -->
                                      <div id="collapseOne{{$mod}}" class="collapse" role="tabpanel" aria-labelledby="headingOne{{$mod}}" data-parent="#accordionEx" style="">
                                        @foreach($videos as $i => $video)  
                                      <?php
                                      $checkvideo=App\Model\ModuleViewVideo::where('user_id',Auth::guard('frontend')->user()->id)->where('video_id',$video->id)->first();
                                      if(empty($checkvideo)){
                                        $videostatus='0';
                                      }else{
                                        $videostatus='1';  
                                      }
                                      ?>
                                        <div class="card-body faqs-body-text">
                                          <div class="row">
                                            <div class="col-sm-12">
                                                <div class="media" data-toggle="modal" onclick="videoPlay('{{$video->name}}', '{{ URL::asset('public/uploads/course/video/'.$video->video) }}','{{$video->id}}','{{$videostatus}}');"> 
                                                    <i class="fa fa-play-circle min-w-3rem text-center opacity-lg mt-1 mr-2 ml-0"></i>
                                                    <span class="media-body">{{$video->name}}@if($videostatus=='1') <i class="icofont-checked" id="video-watch"></i>@endif</span>
                                                    <a id="viewVideo" href="javascript:void(0)" class="btn btn-abc">View Video</a>  
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        @endforeach
                                      </div>
                                      
                                
                                    </div>
                                    <!-- //Accordion card one-->
                                    <?php
                                }
                                ?>
                                    @empty
                                @endforelse

                                    
                                </div>
                            </div>
                        </div>
                    </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> 
</section>
<!----------------------------------Main content End--------------------------->
    <div class="modal fade" id="vidEo" tabindex="-1" role="dialog" aria-labelledby="logInLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title loginshowerror" id="logInLabel">Module One</h5>
              <button id="closeModal" type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="cross"><i class="fa fa-times-circle"></i></span>
              </button>
            </div>
            <div class="modal-body">
                <!--<video width="100%" height="auto" controls="controls" controlslist="nodownload" autoplay="" muted=""> -->
                <!--    <source src="https://bct.tekbazaar.in/public/uploads/course/video/1638800840Untitled.mp4" type="video/mp4" id="videosource" autoplay="false">-->
                <!--</video>  -->
                <video width="100%" height="auto" controls src="" controlslist="nodownload" autoplay=""  id="videosource">
                </video>
            </div>
          </div>
        </div>
    </div>

    

@stop
@section('js')
<script>
		function videoPlay(name,video,id,videostatus) {
		    if(videostatus==0)
		    {
		    ajaxindicatorstart();
                var csrf_token = $('input[name=_token]').val();
                $.ajax({
                    type: 'POST',
                    headers: {'X-CSRF-TOKEN': csrf_token},
                    url: full_path + 'view-study-material',
                    dataType: 'json',
                    data: {id: id},
                    success: function (resp) {
                        
                        ajaxindicatorstop();
                    }
                });
		    }
		$('#logInLabel').html(name);
		$('#videosource').attr('src', video);
        $('.modal').modal('hide');
        $('#vidEo').modal('show');
    }
    
     $(document).ready(function () {
          $("#viewVideo").click(function(){
            $("#videosource").autoplay="true";
          });
          $("#closeModal").click(function(){
            $("#videosource").trigger('pause');
          });

    });
</script>
@endsection



