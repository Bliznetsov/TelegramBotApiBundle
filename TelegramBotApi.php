<?php
namespace TelegramBotApiBundle;

use Symfony\Component\DependencyInjection\Container;
use Longman\TelegramBot\Telegram;
use Longman\TelegramBot\Request as BotRequest;

class TelegramBotApi
{
    private $config;
    private $telegram;

    public function __construct(Container $container)
    {
        $this->config = $container->getParameter('telegram_bot_api.config');

        $this->telegram = new Telegram($this->config['token'], $this->config['bot_name']);
    }

    public function __call($name, $arguments)
    {
        if ($this->config['legacy'] === true) {
	        return call_user_func_array(array(BotRequest::class, $name), $arguments);
        }
    }

}
