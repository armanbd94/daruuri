<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\FlashMessages;
use Illuminate\Database\Eloquent\Model;

class BaseController extends Controller
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    /**
     * @param $title
     * @param $subTitle
     */
    protected function setPageData($page_title, $sub_title, $page_icon=null)
    {
        view()->share(['page_title' => $page_title, 'sub_title' => $sub_title, 'page_icon' => $page_icon]);
    }

    /**
     * @param int $errorCode
     * @param null $message
     * @return \Illuminate\Http\Response
     */
    protected function showErrorPage($errorCode = 404, $message = null)
    {
        $data['message'] = $message;
        return response()->view('errors.'.$errorCode, $data, $errorCode);
    }

    /**
     * @param bool $error
     * @param int $responseCode
     * @param array $message
     * @param null $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function responseJson($error = true, $responseCode = 200, $message = [], $data = null)
    {
        return response()->json([
            'error'         =>  $error,
            'response_code' => $responseCode,
            'message'       => $message,
            'data'          =>  $data
        ]);
    }

    /**
     * @param $route
     * @param $message
     * @param string $type
     * @param bool $error
     * @param bool $withOldInputWhenError
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function responseRedirect($route, $message, $type = 'info', $error = false, $withOldInputWhenError = false)
    {
        $this->setFlashMessage($message, $type);
        $this->showFlashMessages();

        if ($error && $withOldInputWhenError) {
            return redirect()->back()->withInput();
        }

        return redirect()->route($route);
    }

    /**
     * @param $message
     * @param string $type
     * @param bool $error
     * @param bool $withOldInputWhenError
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function responseRedirectBack($message,$type = 'info')
    {
        $this->setFlashMessage($message,$type);
        $this->showFlashMessages();

        return redirect()->back();
    }

    //access blocked message method
    protected function access_blocked()
    {
        return redirect('admin/unauthorized')->with(['status'=>'error','message'=>'Unauthorized Access Blocked']);
    }

    protected function success_status()
    {
        return ['status' => 'success','message' => 'Data has beed saved successfully'];
    }
    protected function error_status()
    {
        return ['status' => 'error','message' => 'Data can not save'];
    }

    protected function dataTableDraw($draw,$count_all,$count_filtered, $data){
        return $output= array(
            "draw"            => $draw,//draw data
            "recordsTotal"    => $count_all,//total record
            "recordsFiltered" => $count_filtered,//total filtered record
            "data"            => $data//showing data
        );
    }
}
