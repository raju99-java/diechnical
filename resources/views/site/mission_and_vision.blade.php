@extends('layouts.main')
@section('css')
<style>

</style>
@stop
@section('content')
<!--------------------breadcrumb ---------------------->
<section class="breadcrumb about-us-b">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="breadcrumb-title-div">
                    <div class="bread-left-side">
                        <h2>MISSION & VISION</h2>
                    </div>
                    <div class="breadcrumb-ul right-side">
                        <ul>
                            <li><a href="/">HOME</a>/</li>
                            <li><span>MISSION & VISION</span></li>
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
    <section class="director">
        <div class="container">
            <div class="row">
                <div class="col-sm-7">
                    <div class="mission">
                        <h3 class="about-us-text">OUR <span class="theme-colour">MISSION</span></h3>
                        <p>Our Mission is to build a strong research and teaching environment that responds to future challenges. Our mission is to provide quality computer education in both theoretical and applied foundations of computer science and train students to effectively. Apply this research based and originality oriented education to solve real world problems. Thus amplifying their potential & interpersonal for high quality career and give them competitive advantage in every challenging global work environment.

Strengthen the development of associated learning centre as a proactive role model for high quality and learner centric computer literacy programmee.
Share professional capabilities and resources to improve standards of computer education in the whole world.
Develop networks using emerging technologies and methods with global reach for effective programme delivery.
Provide an intelligent flexible system of education to meet the challenges of access and equity and work towards development of knowledge based society.
Provide computer education to the highest unreached people and promote community participation for local development.
Provide specific need-based computer education and training opportunities for continuous professional development and skill up gradation to in service professionals</p>
                    </div>

                    <div class="mission">
                        <h3 class="about-us-text">OUR <span class="theme-colour">VISION</span></h3>
                        <p>DI TECHNICAL an ISO 9001:2015 Certified Organisation, the initiator of DI TECHNICAL shall provide seamless access to sustainable and learner centric quality education, skill up gradation and training to all by using innovative technologies and methodologies for computer literacy programme and ensuring convergence of existing systems for massive human resources required for promoting integrated national development and global understanding. Thus we have : To establish computer literacy centers countrywide and abroad specially in rural areas. to impart learning, keeping in quality courses with study materials, well drafted keeping in view the students awareness level as well as the latest development as job oriented and all this for a normal fee. To extend financial flexibility in terms of scholarships and stipends to deserving candidates. To proved computer education to grassroots levels.</p>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="side-bar-page">
                        <div class="enqir-sec">
                            <h3 class="quick-title-sec">Quick Enquiry</h3>
                            <form class="quick-enquiry-form" id="enquiry-form" action="{{route('post-enquiry')}}" method="POST">
                                @csrf
                                <div class="form-group q-grp">
                                    <label class="quick-label">Services*</label>
                                    <select id="services" class="form-control" name="services">
                						<option value="">Select Services</option>
                						<option value="New Franchise">New Franchise</option>
                						<option value="Admission">Admission</option>
                						<option value="Student">Student</option>
                						<option value="ALC">ALC</option>
                						<option value="Other">Other</option>
                					</select>
                                    <span class="help-block" id="error-services"></span>
                                </div>
                                <div class="form-group q-grp">
                                    <label class="quick-label">Full Name*</label>
                                    <input type="text" name="name" class="form-control quick-input" placeholder="Enter Your Full Name.." > 
                                    <span class="help-block" id="error-name"></span>
                                </div>
                                <div class="form-group q-grp">
                                    <label class="quick-label">Contact No*</label>
                                    <input type="tel" name="phone" class="form-control quick-input" placeholder="Enter Your Contact No.." >	
                                    <span class="help-block" id="error-phone"></span>
                                </div>
                                <div class="form-group q-grp">
                                    <label class="quick-label">Email Id*</label>
                                    <input type="email" name="email" class="form-control quick-input" placeholder="Enter Your Email Id..">	
                                    <span class="help-block" id="error-email"></span>
                                </div>
                                <div class="form-group q-grp">
                                    <label class="quick-label">Address*</label>
                                    <textarea name="address" cols="20" rows="2" class="form-control quick-textaeea" placeholder="Address"></textarea>	
                                    <span class="help-block" id="error-address"></span>
                                </div>
                                <div class="form-group q-grp">
                                    <label class="quick-label">Message*</label>
                                    <textarea name="message" cols="20" rows="2" class="form-control quick-textaeea" placeholder="Message"></textarea>	
                                    <span class="help-block" id="error-message"></span>
                                </div>
                                <button type="submit" class="quick-submit">Submit</button>
                            </form>
                        </div>
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