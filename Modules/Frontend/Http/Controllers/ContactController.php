<?php

namespace Modules\Frontend\Http\Controllers;

use App\Jobs\ContactMessageJob;
use App\Mail\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Modules\Frontend\Http\Controllers\FrontendBaseController;
use Validator;
class ContactController extends FrontendBaseController
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $this->setPageData('Contact','Contact');
        return view('frontend::contact.contact');
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        if($request->ajax()){
            $rules = [
                'g-recaptcha-response' => 'required|captcha',
                'name'    => 'required|string|max:50',
                'email'   => 'required|email|max:100',
                'phone'   => 'required|string|max:20',
                'subject' => 'required|string|max:150',
                'message' => 'required|string|max:350'
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $output = array(
                    'errors' => $validator->errors()
                );
            } else {
                if(request('g-recaptcha-response')){
                    $data = collect($request->all())->only(['name','email','phone','subject','message']);
                    // $result = ContactMessageJob::dispatch($data->all())->delay(now()->addMinutes(10));
                    Mail::to(env('MAIL_FROM_ADDRESS'))->send(new ContactMessage($data->all()));
                    if(!Mail::failures()){
                        $output = ['status'=>'success','message'=>'Message sent successfully.'];
                    }else{
                        $output = ['status'=>'error','message'=>'Message cannot send. Please try again!'];
                    }
                }else{
                    $output = ['status'=>'error','message'=>'Captcha validation failed! Try again.'];
                }
            }
            return response()->json($output);
        }
        
        
        
    }

   
}
