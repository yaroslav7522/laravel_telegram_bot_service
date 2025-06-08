<?php

namespace App\Bot;

//use Illuminate\Support\Facades\Http;

class TelegramApi
{
    protected string $telegram_bot_url;

    public function __construct()
    {
        $this->telegram_bot_url = config('telegram.url');
    }

    public function sendMessage(array $params): void
    {
        //Http::post("{$this->telegram_bot_url}/sendMessage", $params);
		$this->send_request("sendMessage", $params);
    }

    public function answerCallbackQuery(array $params): void
    {
        //Http::post("{$this->telegram_bot_url}/answerCallbackQuery", $params);
		$this->send_request("answerCallbackQuery", $params);
    }
	
	private function send_request($method, $params = []){
		if(!empty($params)){
			$url = "{$this->telegram_bot_url}/" . $method . '?' . http_build_query($params);
		}else{
			$url = "{$this->telegram_bot_url}/" . $method;
		}

		return $this->getSslPage($url);
	}

	private function getSslPage($url) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_REFERER, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}	
	
}