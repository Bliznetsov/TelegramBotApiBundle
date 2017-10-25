<?php

namespace EricomGroup\TelegramBotApiBundle\Service;

use InvalidArgumentException;
use Longman\TelegramBot\Request as BotRequest;
use Longman\TelegramBot\Telegram;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class Bot
 * @property Telegram telegram
 * @package EricomGroup\TelegramBotApiBundle\Service
 */
class Bot extends BotRequest
{
	/**
	 * @var
	 */
	private $config;

	/**
	 * Bot constructor.
	 *
	 * @param ContainerInterface $container
	 *
	 * @throws \Longman\TelegramBot\Exception\TelegramException
	 * @throws \Symfony\Component\DependencyInjection\Exception\InvalidArgumentException
	 * @throws \Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException
	 * @throws \Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException
	 */
	public function __construct(ContainerInterface $container)
	{
		$this->config = $container->getParameter('telegram_bot_api.config');

		$this->telegram = new Telegram($this->config['token'], $this->config['username']);
	}

	/**
	 * @param $path
	 *
	 * @return mixed
	 */
	public function setDownloadPath($path)
	{
		return $this->telegram->setDownloadPath($path);
	}

	/**
	 * @return mixed
	 */
	public function getDownloadPath()
	{
		return $this->telegram->getDownloadPath();
	}

	/**
	 * @param $path
	 *
	 * @return mixed
	 */
	public function setUploadPath($path)
	{
		return $this->telegram->setUploadPath($path);
	}

	/**
	 * @return mixed
	 */
	public function getUploadPath()
	{
		return $this->telegram->getUploadPath();
	}

	/**
	 * @param $token
	 * @param null $username
	 *
	 * @throws InvalidArgumentException
	 * @throws \Longman\TelegramBot\Exception\TelegramException
	 */
	public function changeBot($token, $username = null)
	{
		if(empty($token))
			throw new InvalidArgumentException();
		else
			$this->telegram = new Telegram($token, $username);
	}

	/**
	 * @return mixed
	 */
	public function getDevelopers()
	{
		return $this->config['development']['developers_id'];
	}
}
