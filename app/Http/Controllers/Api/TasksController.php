<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tasks;
use Illuminate\Http\JsonResponse;

class TasksController extends Controller
{
    public function index(): JsonResponse
    {
        $tasks = Tasks::all();
        return response()->json($tasks);
    }
	
	public function add(Request $request){
		$val = $request->validate([
			
		]);
	}
	
	public function getAllByApi() {
		
	}
}
