<?php

namespace App\Bot;

use Illuminate\Support\Facades\Http;

class TelegramApi
{
    protected string $telegram_bot_url;

    public function __construct()
    {
        $this->telegram_bot_url = config('telegram.url');
    }

    public function sendMessage(array $params): void
    {
        Http::post("{$this->telegram_bot_url}/sendMessage", $params);
    }

    public function answerCallbackQuery(array $params): void
    {
        Http::post("{$this->telegram_bot_url}/answerCallbackQuery", $params);
    }
	
}