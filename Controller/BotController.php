<?php
namespace EricomGroup\TelegramBotApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class BotController
 * @package EricomGroup\TelegramBotApiBundle\Controller
 */
abstract class BotController extends Controller
{
	/**
	 * @return \EricomGroup\TelegramBotApiBundle\Service\Bot|object
	 */
	protected function bot()
	{
		return $this->container->get('telegram_bot_api');
	}

	/**
	 * @return \EricomGroup\TelegramBotApiBundle\Service\BotHelper|object
	 */
	protected function botHelper()
	{
		return $this->container->get('telegram_bot_api.helper');
	}
}
