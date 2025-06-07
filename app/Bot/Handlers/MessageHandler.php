<?php

namespace App\Bot\Handlers;

use App\Bot\TelegramApi;

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

        if ($text === '/start') {
            $this->telegram->sendMessage([
                'chat_id' => $chatId,
                'text' => 'Привіт! Це бот для отримання твоїх задач. Натисни Start щоб підписатись на розсилку та Stop щоб відписатись.',
            ]);
        } else {
            $this->telegram->sendMessage([
                'chat_id' => $chatId,
                'text' => "Ви написали: {$text} /n". var_dump($message),
            ]);
        }
    }
}