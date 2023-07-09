@extends('layouts.main')
@section('css')
<style>

</style>
@stop
@section('content')
<!--------------------breadcrumb ---------------------->
<!--------------------breadcrumb ---------------------->
<section class="breadcrumb about-us-b">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="breadcrumb-title-div">
                    <div class="bread-left-side">
                        <h2>Useful Links</h2>
                    </div>
                    <div class="breadcrumb-ul right-side">
                        <ul>
                            <li><a href="/">HOME</a>/</li>
                            <li><span>Useful Links</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!------------------- //breadcrumb ------------------->
<!--------------------------------Main content Start--------------------------->
<section class="main">
    
    <script src="{{ URL::asset('public/frontend/js/jquery-3.3.1.min.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <section class="exam-div">
        <div class="container">
            <div class="row">
                
                <div class="col-sm-12 mb-3">
                    <div class="result-download">
                        <h2>Useful Links</h>
                            
                    </div>
                    
                    
                </div>
                
                <div id="here_table" class="col-sm-12" >
    
                    <div style="overflow: auto;">
                        <table  class="table table-striped table-bordered" style="text-transform: uppercase;">
                            <tbody>
                                
                                <tr>
                                    <th>Name</th>
                                    <th>Link</th>
                                </tr>  

                                @forelse($menus as $menu)
                                    <tr>
                                        <td><b>{{ $menu->name }}</b></td>
                                        <td><a href="{{ $menu->slug }}" target="_blank">Click Here</a></td>
                                    </tr>
                                    @empty
		                        @endforelse
                            
                            </tbody>  
                        </table>
                    </div>
                </div>
                        
                
            </div>  
        </div>
    </section>
</section>
<!----------------------------------Main content End--------------------------->

@stop
@section('js')

@stop