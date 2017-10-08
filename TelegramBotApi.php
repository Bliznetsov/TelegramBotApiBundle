<?php
namespace EricomGroup\TelegramBotApiBundle;

use Symfony\Component\DependencyInjection\Container;
use Longman\TelegramBot\Telegram;
use Longman\TelegramBot\Request as BotRequest;

class TelegramBotApi extends BotRequest
{
    private $config;
    private $telegram;

    public function __construct(Container $container)
    {
        $this->config = $container->getParameter('telegram_bot_api.config');

        $this->telegram = new Telegram($this->config['token'], $this->config['bot_name']);
    }

    public function setDownloadPath($path)
    {
    	return $this->telegram->setDownloadPath($path);
    }

	public function getDownloadPath()
	{
		return $this->telegram->getDownloadPath();
	}

	public function setUploadPath($path)
	{
		return $this->telegram->setUploadPath($path);
	}

	public function getUploadPath()
	{
		return $this->telegram->getUploadPath();
	}

	public function changeBot($token, $username)
	{
		if(empty($token))
			throw new \InvalidArgumentException();
		else
			$this->telegram = new Telegram($token, $username);
	}

}
