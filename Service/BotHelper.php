<?php

namespace TelegramBotApiBundle\Service;

use Longman\TelegramBot\Entities\Audio;
use Longman\TelegramBot\Entities\CallbackQuery;
use Longman\TelegramBot\Entities\Contact;
use Longman\TelegramBot\Entities\Document;
use Longman\TelegramBot\Entities\File;
use Longman\TelegramBot\Entities\InlineQuery;
use Longman\TelegramBot\Entities\Location;
use Longman\TelegramBot\Entities\Message;
use Longman\TelegramBot\Entities\MessageEntity;
use Longman\TelegramBot\Entities\User;
use Longman\TelegramBot\Entities\Venue;
use Longman\TelegramBot\Entities\Video;
use Longman\TelegramBot\Entities\VideoNote;
use Longman\TelegramBot\Entities\Voice;
use Symfony\Component\DependencyInjection\ContainerInterface;

class BotHelper {
	/**
	 * @var object|\TelegramBotApiBundle\TelegramBotApi
	 */
	private $bot;

	/**
	 * BotHelper constructor.
	 *
	 * @param ContainerInterface $container
	 */
	public function __construct(ContainerInterface $container) {
		$this->bot = $container->get('telegram_bot_api');
	}
	
	/**
	 * @return mixed
	 */
	public function getDecodeInput()
	{
		return json_decode($this->bot::getInput(), 1);
	}

	/**
	 * @return bool|Message
	 */
	public function getMessage()
	{
		if(isset($this->getDecodeInput()['message']))
			return new Message($this->getDecodeInput()['message']);
		else
			return false;
	}

	/**
	 * @return bool|User
	 */
	public function getFrom()
	{
		if(isset($this->getDecodeInput()['message']['from']))
			return new User($this->getDecodeInput()['message']['from']);
		elseif (isset($this->getDecodeInput()['callback_query']['from']))
			return new User($this->getDecodeInput()['callback_query']['from']);
		elseif (isset($this->getDecodeInput()['inline_query']['from']))
			return new User($this->getDecodeInput()['inline_query']['from']);
		else
			return false;
	}

	/**
	 * @return bool|MessageEntity
	 */
	public function getMessageEntity()
	{
		if(isset($this->getDecodeInput()['message']['entities']))
			return new MessageEntity($this->getDecodeInput()['message']['entities']);
		else
			return false;
	}

	/**
	 * @return bool|Audio
	 */
	public function getAudio()
	{
		if(isset($this->getDecodeInput()['message']['audio']))
			return new Audio($this->getDecodeInput()['message']['audio']);
		else
			return false;
	}

	/**
	 * @return bool|Document
	 */
	public function getDocument()
	{
		if(isset($this->getDecodeInput()['message']['document']))
			return new Document($this->getDecodeInput()['message']['document']);
		else
			return false;
	}

	/**
	 * @return bool|Video
	 */
	public function getVideo()
	{
		if(isset($this->getDecodeInput()['message']['video']))
			return new Video($this->getDecodeInput()['message']['video']);
		else
			return false;
	}

	/**
	 * @return bool|Voice
	 */
	public function getVoice()
	{
		if(isset($this->getDecodeInput()['message']['voice']))
			return new Voice($this->getDecodeInput()['message']['voice']);
		else
			return false;
	}

	/**
	 * @return bool|VideoNote
	 */
	public function getVideoNote()
	{
		if(isset($this->getDecodeInput()['message']['video_note']))
			return new VideoNote($this->getDecodeInput()['message']['video_note']);
		else
			return false;
	}

	/**
	 * @return bool|Contact
	 */
	public function getContact()
	{
		if(isset($this->getDecodeInput()['message']['contact']))
			return new Contact($this->getDecodeInput()['message']['contact']);
		else
			return false;
	}

	/**
	 * @return bool|Location
	 */
	public function getLocation()
	{
		if(isset($this->getDecodeInput()['message']['location']))
			return new Location($this->getDecodeInput()['message']['location']);
		else
			return false;
	}

	/**
	 * @return bool|Venue
	 */
	public function getVenue()
	{
		if(isset($this->getDecodeInput()['message']['venue']))
			return new Venue($this->getDecodeInput()['message']['venue']);
		else
			return false;
	}

	/**
	 * @return bool|File
	 */
	public function getFile()
	{
		if(isset($this->getDecodeInput()['message']['file']))
			return new File($this->getDecodeInput()['message']['file']);
		else
			return false;
	}

	/**
	 * @return bool|CallbackQuery
	 */
	public function getCallbackQuery()
	{
		if(isset($this->getDecodeInput()['callback_query']))
			return new CallbackQuery($this->getDecodeInput()['callback_query']);
		else
			return false;
	}

	/**
	 * @return bool|InlineQuery
	 */
	public function getInlineQuery()
	{
		if(isset($this->getDecodeInput()['inline_query']))
			return new InlineQuery($this->getDecodeInput()['inline_query']);
		else
			return false;
	}
}
