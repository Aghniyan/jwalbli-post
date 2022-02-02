<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use PostHelper\PostHelper;
use Symfony\Component\HttpFoundation\Response;


class PostController extends Controller
{
    protected $post_helper;
    public function __construct()
    {
        $this->post_helper = new PostHelper();
    }

    public function getAll(Request $request)
    {
        $data = $this->post_helper->getAll();
        if ($request->userId) {
            $data = $this->post_helper->getByUserID($request->userId);
        }
        return set_response(
            $this->appendDataToResponse(
                json_decode($data)
            )
                ->changeStatusCodeResponse(Response::HTTP_OK)
                ->response
        );
    }

    public function getByID($id)
    {
        $data = $this->post_helper->getByID($id);
        if($data == '{}'){
            $response = [
                'status' => Response::HTTP_NOT_FOUND,
                'message' => "Your request item not found"
            ];
            return response()->json($response)->setStatusCode(Response::HTTP_NOT_FOUND);
        }
        return set_response(
            $this->appendDataToResponse(
                json_decode($data)
            )
                ->changeStatusCodeResponse(Response::HTTP_OK)
                ->response
        );
    }

    public function create(PostRequest $request)
    {
        return set_response(
            $this->appendDataToResponse(
                json_decode($this->post_helper->createPost($request))
            )
                ->changeStatusCodeResponse(Response::HTTP_CREATED)
                ->response
        );
    }

    public function update(PostRequest $request, $id)
    {
        $data = $this->post_helper->getByID($id);
        if($data == '{}'){
            $response = [
                'status' => Response::HTTP_NOT_FOUND,
                'message' => "Your request item not found"
            ];
            return response()->json($response)->setStatusCode(Response::HTTP_NOT_FOUND);
        }
        return set_response(
            $this->appendDataToResponse(
                json_decode($this->post_helper->updatePost($request, $id))
            )
                ->changeStatusCodeResponse(Response::HTTP_OK)
                ->appendActionToResponse('update')
                ->response
        );
    }

    public function delete($id)
    {
        $data = $this->post_helper->getByID($id);
        if($data == '{}'){
            $response = [
                'status' => Response::HTTP_NOT_FOUND,
                'message' => "Your request item not found"
            ];
            return response()->json($response)->setStatusCode(Response::HTTP_NOT_FOUND);
        }

        return set_response(

            $this->appendDataToResponse(
                json_decode($this->post_helper->deletePost($id))
            )
                ->changeStatusCodeResponse(Response::HTTP_OK)
                ->appendActionToResponse('delete')
                ->response
        );
    }
}
