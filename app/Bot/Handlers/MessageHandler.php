<?php

namespace App\Bot\Handlers;

use App\Bot\TelegramApi;

class MessageHandler
{
    protected TelegramApi $telegram;

    public function __construct(Telegram $telegram)
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
                'text' => 'Привіт! Це бот без бібліотек 🛠️',
            ]);
        } else {
            $this->telegram->sendMessage([
                'chat_id' => $chatId,
                'text' => "Ви написали: {$text}",
            ]);
        }
    }
}