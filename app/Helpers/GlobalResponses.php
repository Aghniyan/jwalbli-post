<?php

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

if(!function_exists("create_message_from_status_code")){
    function create_message_from_status_code($request){
        $msg = "";
        switch($request['statusCode']){
            case Response::HTTP_OK:
                if (array_key_exists('update', $request)){
                    $msg = "Data updated successfully";
                }else if (array_key_exists('delete', $request)){
                    $msg = "Data deleted successfully";
                }else{
                    $msg = "Get data successfully";
                }
            break;
            case Response::HTTP_NOT_FOUND:
                $msg = "Your request item not found";
            break;
            case Response::HTTP_CREATED:
                $msg = "Data inserted successfully";
            break;
            case Response::HTTP_INTERNAL_SERVER_ERROR:
                $msg = "Internal server error";
            break;
            case Response::HTTP_FORBIDDEN:
                $msg = "This action is unauthorize";
            break;
        }
        return $msg;
    }
}

if(!function_exists('set_format_response')){
    function set_format_response(){
        return [
            "statusCode" => Response::HTTP_OK,
            "data"       => new \stdClass(),
        ];
    }
}

if(!function_exists("set_response")){
    function set_response($request){
        $response = array();
        $response['status'] = $request['statusCode'];
        if (array_key_exists('metaData', $request)){
            $response['_metadata'] = $request['metaData'];
        }
        if(array_key_exists('message', $request)){
            $response['message'] = $request['message'];
        }else{
            $response['message'] = create_message_from_status_code($request);
        }
        if(array_key_exists('data', $request)){
            $response['data'] = $request['data'];
        }
        return response()->json($response)->setStatusCode($request['statusCode']);
    }
}

if (!function_exists('makePaginationFromCollection')) {
    function makePaginationFromCollection($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $slicing = isset($options['slicing']) ? boolval($options['slicing']) : true;

        $items = $items instanceof Collection ? $items : Collection::make($items);

        if ($slicing) {
            $pagination = new LengthAwarePaginator(
                $items->forPage($page, $perPage)->values(),
                $items->count(),
                $perPage,
                $page,
                $options
            );
        } else {
            $pagination = new LengthAwarePaginator(
                $items,
                $options['total'],
                $perPage,
                $page,
                $options
            );
        }

        return $pagination;
    }
}

if (!function_exists('makeRequest')) {
    function makeRequest(array $datas) {
        return new Request($datas);
    }
}
