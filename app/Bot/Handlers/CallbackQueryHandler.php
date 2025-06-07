<?php

namespace App\Bot\Handlers;

use App\Bot\Telegram;

class CallbackQueryHandler
{
    protected Telegram $telegram;

    public function __construct(Telegram $telegram)
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