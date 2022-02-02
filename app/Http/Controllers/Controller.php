<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $request_payload, $response;
    public function appendDataToResponse($data)
    {
        $this->response['data'] = $data;
        return $this;
    }

    public function changeStatusCodeResponse($status_code)
    {
        $this->response['statusCode'] = $status_code;
        return $this;
    }

    public function appendActionToResponse($action)
    {
        $this->response = array_merge($this->response,[
            $action => "true"
        ]);
        return $this;
    }

    public function appendMessageToResponse($message)
    {
        $this->response = array_merge($this->response, [
            "message" => $message
        ]);
        return $this;
    }

    public function setRequest($request)
    {
        $this->request_payload = $request;
        return $this;
    }
}
