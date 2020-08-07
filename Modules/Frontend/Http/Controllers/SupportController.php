<?php

namespace Modules\Frontend\Http\Controllers;

use App\Model\User;
use App\Notifications\CustomerFeedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Modules\Frontend\Http\Controllers\FrontendBaseController;
use Modules\Backend\Entities\Faq;
use Modules\Backend\Entities\Review;
use Validator;
class SupportController extends FrontendBaseController
{
    public function faqs(){
        $this->setPageData('FAQs','FAQs');
        $faqs = Faq::allFaqs();
        return view('frontend::support.faq',compact('faqs'));
    }
    public function feedback(){
        $this->setPageData('Give Us Your Feedback','Give Us Your Feedback');
        return view('frontend::support.feedback');
    }
    public function store(Request $request){
        if($request->ajax()){
            $rules = [
                'g-recaptcha-response' => 'required|captcha',
                'name'                 => 'required|string|max:50',
                'email'                => 'required|email|max:100',
                'phone_no'             => 'required|string|max:20',
                'description'          => 'required|string|max:350',
                'daruuri_rating'       => 'required|integer|min:1|max:5',
                'communication_rating' => 'required|integer|min:1|max:5',
                'stuff_rating'         => 'required|integer|min:1|max:5',
                'service_rating'       => 'required|integer|min:1|max:5',
                'referal_rating'       => 'required|integer|min:1|max:5',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $output = array(
                    'errors' => $validator->errors()
                );
            } else {
                if(request('g-recaptcha-response')){
                    $data = collect($request->all())->only(['name','email','phone_no','description','daruuri_rating',
                    'communication_rating','stuff_rating' ,'service_rating','referal_rating']);
                    $result = Review::create($data->all());
                    if($result){
                        
                        Notification::send(User::all(), new CustomerFeedback($result));
                        $output = ['status'=>'success','message'=>'Your feedback submitted successfully.'];
                    }else{
                        $output = ['status'=>'error','message'=>'Your feedback failed to submit! Try again.'];
                    }
                }else{
                    $output = ['status'=>'error','message'=>'Captcha validation failed! Try again.'];
                }
            }
            return response()->json($output);
        }
    }
}
