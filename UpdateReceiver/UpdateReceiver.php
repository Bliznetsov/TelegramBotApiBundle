<?php

namespace TelegramBotApiBundle\UpdateReceiver;

use TelegramBotApiBundle\TelegramBotApi;
use TelegramBotApiBundle\Type\Update;

class UpdateReceiver implements UpdateReceiverInterface
{

    private $config;
    private $telegramBotApi;

    public function __construct(TelegramBotApi $telegramBotApi, $config)
    {
        $this->telegramBotApi = $telegramBotApi;
        $this->config = $config;
    }

    public function handleUpdate(Update $update)
    {
        $message = json_decode(json_encode($update->message), true);

        switch ($message['text']) {
            case "/about":
            case "/about@{$this->config['bot_name']}":
                $text = "I'm a samble Telegram Bot";
                break;
            case "/help":
            case "/help@{$this->config['bot_name']}":
            default :
                $text = "Command List:\n";
                $text .= "/about - About this bot\n";
                $text .= "/help - show this help message\n";
                break;
        }

        $this->telegramBotApi->sendMessage($message['chat']['id'], $text);
    }
}
