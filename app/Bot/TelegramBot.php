<?php

namespace App\Bot;

use App\Bot\Handlers\MessageHandler;
use App\Bot\Handlers\CallbackQueryHandler;

class TelegramBot
{
    public function handle(array $update): void
    {
        if (isset($update['message'])) {
            app(MessageHandler::class)->handle($update['message']);
        } elseif (isset($update['callback_query'])) {
            app(CallbackQueryHandler::class)->handle($update['callback_query']);
        }
    }
}