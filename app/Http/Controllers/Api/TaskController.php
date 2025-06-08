<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use App\Services\TaskApiService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
	public function __construct(protected TaskApiService $taskApiService) {}
	
    public function index(): JsonResponse
    {
		//Log::debug('Gat all tasks.');
       return response()->json($this->taskApiService->getAll());
    }
	
	public function store(Request $request)
    {
		$validator = Validator::make($request->all(), [
			'title' => 'required|max:128'
		]);
		
		if ($validator->fails()) {
			return response()->json($validator->errors(),500);
		}else{
			$task = $this->taskApiService->create($request->input());
			return response()->json($task, 201);
		}
    }

    public function show($id)
    {
		$task = $this->taskApiService->getById($id);
		if(isset($task)){
			return response()->json($this->taskApiService->getById($id));
		}else{
			return response()->json(['message' => 'Task not found']);
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
			$task = $this->taskApiService->update($id, $request->input());
			if($task !== false){
				return response()->json($task);
			}else{
				return response()->json(['message' => 'Task not found']);
			}
		}
    }

    public function destroy($id)
    {
        $is_deleted = $this->taskApiService->delete($id);
		if($is_deleted === true){
			return response()->json(['message' => 'Task deleted']);
		}else{
			return response()->json(['message' => 'Task not found']);
		}
    }
	
	public function runconsol(Request $request)
	{
		//Artisan::call('app:notify-tasks');
		return response()->json(['message' => 'Console runing...']);
	}
	
}
