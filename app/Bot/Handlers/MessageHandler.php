<?php

namespace App\Bot\Handlers;

use App\Bot\TelegramApi;
use App\Services\UserService;
use Illuminate\Support\Facades\Log;

class MessageHandler
{
    protected TelegramApi $telegram;
    protected UserService $user_ser;

    public function __construct(TelegramApi $telegram, UserService $user_ser)
    {
        $this->telegram = $telegram;
        $this->user_ser = $user_ser;
    }

    public function handle(array $message): void
    {
        $chatId = $message['chat']['id'];
        $text = $message['text'] ?? '';
		$name = $message['chat']['first_name'];//.' '.$message['chat']['last_name']

		//Log::debug('Telegram data:'.var_dump($message));

        if ($text === '/start') {
			//find user by telegaram_id (chatId)
			$user = $this->user_ser->findByChatId($chatId);
			if(!isset($user)){
				$user = $this->user_ser->create([
					'name' => $name,
					'telegram_id' => $chatId,
					'subscribed' => 1,
				]);
				$this->telegram->sendMessage([
					'chat_id' => $chatId,
					'text' => 'Привіт! Це бот для отримання твоїх задач. Натисни Stop щоб відписатись від розсилки.',
				]);				
			}else{
				$user = $this->user_ser->update($user['id'],[
					'subscribed' => 1,
				]);	
				$this->telegram->sendMessage([
					'chat_id' => $chatId,
					'text' => 'Ви успішно підписались на розсилку.',
				]);				
			}
		}elseif ($text === '/stop') {
			$user = $this->user_ser->findByChatId($chatId);
			if(!isset($user)){
				$user = $this->user_ser->create([
					'name' => $name,
					'telegram_id' => $chatId,
					'subscribed' => 0,
				]);
				$this->telegram->sendMessage([
					'chat_id' => $chatId,
					'text' => 'Ви успішно відписались від розсилки.',
				]);
			}else{
				$user = $this->user_ser->update($user['id'],[
					'subscribed' => 0,
				]);	
				$this->telegram->sendMessage([
					'chat_id' => $chatId,
					'text' => 'Ви успішно відписались від розсилки.',
				]);
			}				
        } else {
            $this->telegram->sendMessage([
                'chat_id' => $chatId,
                'text' => "Ви {$name} написали: {$text}",
            ]);
        }
    }
}