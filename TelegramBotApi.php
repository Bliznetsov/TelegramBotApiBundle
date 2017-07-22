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
        return call_user_func_array(array(BotRequest::class, $name), $arguments);
    }

    public function setWebhook($url)
    {
    	if($url == null)
    		return $this->telegram->deleteWebhook();
    	else
    	    return $this->telegram->setWebhook($url);
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
		if(empty($token) or empty($username))
			throw new \InvalidArgumentException();
		else
			$this->telegram = new Telegram($token, $username);
	}

}
