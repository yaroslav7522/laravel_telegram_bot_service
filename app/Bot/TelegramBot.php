<?php

namespace App\Bot;

use App\Bot\Handlers\MessageHandler;
use App\Bot\Handlers\CallbackQueryHandler;
use Illuminate\Support\Facades\Log;

class TelegramBot
{
    public function handle(array $update): void
    {
		Log::debug('Telegram input call');
        if (isset($update['message'])) {
			Log::debug('Telegram input Message');
            app(MessageHandler::class)->handle($update['message']);
        } elseif (isset($update['callback_query'])) {
			Log::debug('Telegram input callback_query');
            app(CallbackQueryHandler::class)->handle($update['callback_query']);
        }
    }
}