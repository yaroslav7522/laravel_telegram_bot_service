<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function all()
    {
        return User::all();
    }

    public function find($id)
    {
        return User::find($id);//findOrFail
    }
	
    public function findByChatId($t_id)
    {
        return User::where('telegram_id', $t_id)->first();
    }	

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update($id, array $data)
    {
        $user = User::find($id);
		if(isset($user)){
			$user->update($data);
			return $user;
		}else{
			return false;
		}
    }

    public function delete($id)
    {
        $user = User::find($id);
		if(isset($user)){
			$user->delete();
			return true;
		}else{
			return false;
		}
    }
	
	public function getSubscribed(){
		return User::where('subscribed', true)->get();
	}
}