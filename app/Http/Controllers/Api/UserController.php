<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
//use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function __construct(protected UserService $userService) {}

    public function index()
    {
        return response()->json($this->userService->getAll());
    }

    public function store(Request $request)
    {
		$validator = Validator::make($request->all(), [
			'name' => 'required|max:250',
			'telegram_id' => 'required|unique:users',
		]);
		
		if ($validator->fails()) {
			return response()->json($validator->errors(),500);
		}else{
			$user = $this->userService->create($request->input());
			return response()->json($user, 201);
		}
    }

    public function show($id)
    {
		$user = $this->userService->getById($id);
		if(isset($user)){
			return response()->json($this->userService->getById($id));
		}else{
			return response()->json(['message' => 'User not found']);
		}
    }

    public function update(Request $request, $id)
    {
		$validator = Validator::make($request->all(), [
			//'name' => 'required|max:250',
			//'id' => 'required|unique:users',
		]);
		
		if ($validator->fails()) {
			return response()->json($validator->errors(),500);
		}else{
			$user = $this->userService->update($id, $request->input());
			if($user !== false){
				return response()->json($user);
			}else{
				return response()->json(['message' => 'User not found']);
			}
		}
    }

    public function destroy($id)
    {
        $is_deleted = $this->userService->delete($id);
		if($is_deleted === true){
			return response()->json(['message' => 'User deleted']);
		}else{
			return response()->json(['message' => 'User not found']);
		}
    }
}