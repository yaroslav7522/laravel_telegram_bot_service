<?php

namespace App\Bot\Handlers;

use App\Bot\TelegramApi;

class CallbackQueryHandler
{
    protected Telegram $telegram;

    public function __construct(TelegramApi $telegram)
    {
        $this->telegram = $telegram;
    }

    public function handle(array $callback): void
    {
        $callbackId = $callback['id'];
        $data = $callback['data'];

        $this->telegram->answerCallbackQuery([
            'callback_query_id' => $callbackId,
            'text' => "Ви вибрали: {$data}",
            'show_alert' => true,
        ]);
    }
}