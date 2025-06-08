<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository
{
    public function createOrUpdate(array $data): Task
    {
        /*return Task::updateOrCreate(
            ['id' => $data['id']],
            $data
        );*/
		$Task = Task::find($id);
		if(isset($Task)){
			return $this->update( $data['id'], $data);
		}else{
			return $this->create($data);
		}
    }
	
    public function all()
    {
        return Task::all();
    }

    public function find($id)
    {
        return Task::find($id);
    }

    public function create(array $data)
    {
        return Task::create($data);
    }

    public function update($id, array $data)
    {
        $Task = Task::find($id);
		if(isset($Task)){
			$Task->update($data);
			return $Task;
		}else{
			return false;
		}
    }

    public function delete($id)
    {
        $Task = Task::find($id);
		if(isset($Task)){
			$Task->delete();
			return true;
		}else{
			return false;
		}
    }	
}