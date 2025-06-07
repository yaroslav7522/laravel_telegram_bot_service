<?php

namespace App\Bot\Handlers;

use App\Bot\TelegramApi;
use Illuminate\Support\Facades\Log;

class MessageHandler
{
    protected TelegramApi $telegram;

    public function __construct(TelegramApi $telegram)
    {
        $this->telegram = $telegram;
    }

    public function handle(array $message): void
    {
        $chatId = $message['chat']['id'];
        $text = $message['text'] ?? '';
		$name = $message['chat']['first_name'].' '.$message['chat']['last_name'];

		//Log::debug('Telegram data:'.var_dump($message));

        if ($text === '/start') {
            $this->telegram->sendMessage([
                'chat_id' => $chatId,
                'text' => 'Привіт! Це бот для отримання твоїх задач. Натисни Start щоб підписатись на розсилку та Stop щоб відписатись.',
            ]);
        } else {
            $this->telegram->sendMessage([
                'chat_id' => $chatId,
                'text' => "Ви {$name} написали: {$text}",
            ]);
        }
    }
}