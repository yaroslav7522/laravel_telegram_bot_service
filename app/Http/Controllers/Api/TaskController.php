<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    public function index(): JsonResponse
    {
		//Log::debug('Gat all tasks.');
        $tasks = Task::all();
        return response()->json($tasks);
    }
	
	public function add(Request $request){
		$val = $request->validate([
			
		]);
	}
	
	public function getAllByApi() {
		
	}
}
