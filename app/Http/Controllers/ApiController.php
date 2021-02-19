<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Member;

class ApiController extends Controller
{
    public function index()
    {
		$user = User::leftJoin('member', 'member.user_id', '=', 'users.id')->get();

        return response()->json([
            'success' => true,
            'data' => $user
        ]);
    }

	public function show($ids)
	{
		$user = User::find($ids);

		if ($user)
		{
			return response()->json([
	            'success' => true,
				'data' => User::leftJoin('member', 'member.user_id', '=', 'users.id')
								->where('users.id', $ids)
								->first(),
				
			], 200);
		} else {
			return response()->json([
				'success' => false,
				'data' => "Resource not found",
			], 404);
		}
	}

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);
 
        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
 
        if (auth()->user()->posts()->save($post))
        {
            return response()->json([
                'success' => true,
                'data' => $post->toArray()
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post not added'
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
 
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Resource not found'
            ], 400);
        }
 
        $userCRUD = $user->fill($request->all())->save();
 
		$member = Member::find($id);

		if ($member)
		{
			$memberCRUD = $member->fill($request->all())->save();
		}

        if ($userCRUD)
            return response()->json([
                'success' => true,
                'message' => 'Resource updated'
            ], 200);
        else
            return response()->json([
                'success' => false,
                'message' => 'Resource can not be updated'
            ], 500);
    }


 	public function destroy($id)
    {
        $user = auth()->user()->find($id);
 
        if (!$user)
        {
            return response()->json([
                'success' => false,
                'message' => 'Resource not found'
            ], 400);
        }
 
        if ($user->delete()) 
        {
        	Member::where('user_id', $id)->delete();
            return response()->json([
                'success' => true,
                'message' => 'Resource can not be deleted'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Resource can not be deleted'
            ], 500);
        }
    }
}
