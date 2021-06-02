<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Logo;
use App\Model\Slider;
use App\Model\Course;
use App\Model\AboutUs;
use App\Model\WhyUs;
use App\Model\Event;
use App\Model\Testimonial;
use App\Model\Designation;
use App\Model\Department;
use App\Model\Contact;
use App\Model\Faculty;
use App\Model\Emails;
use App\User;
use Mail;

class FrontendController extends Controller
{
    public function index()
    {
        $data['logo']= Logo::first();
    	$data['contacts']= Contact::all();
    	$data['sliders']= Slider::all();
    	$data['courses']= Course::all();
    	$data['aboutuses']= AboutUs::all();
        $data['whyUses']= WhyUs::all();
        $data['faculties']= Faculty::all();
        $data['events']= Event::all();
        $data['testimonials']= Testimonial::all();
       
    	return view('frontend.layouts.home',$data);
    }

    public function showAboutUs()
    {   
        $data['logo']= Logo::first();
        $data['aboutuses']= AboutUs::all();
        $data['testimonials']= Testimonial::all();
        return view('frontend.show-aboutUs',$data);
    }

    public function showContact()
    {   
        $data['logo']= Logo::first();
        $data['contacts']= Contact::all();
        return view('frontend.show-contact',$data);
    }

    public function showFaculty()
    {   
        $data['logo']= Logo::first();
        $data['faculties']= Faculty::all();
        return view('frontend.show-faculty',$data);
    }

    public function showCourse()
    {   
        $data['logo']= Logo::first();
        $data['courses']= Course::all();
        return view('frontend.show-course',$data);
    }

}
