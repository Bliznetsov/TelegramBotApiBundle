<?php

namespace EricomGroup\TelegramBotApiBundle\Service;

use InvalidArgumentException;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Telegram;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\VarDumper\VarDumper;

/**
 * Class Bot
 * @property Telegram telegram
 * @package EricomGroup\TelegramBotApiBundle\Service
 * 
 * @method ServerResponse getUpdates(array $data)              Use this method to receive incoming updates using long polling (wiki). An Array of Update objects is returned.
 * @method ServerResponse setWebhook(array $data)              Use this method to specify a url and receive incoming updates via an outgoing webhook. Whenever there is an update for the bot, we will send an HTTPS POST request to the specified url, containing a JSON-serialized Update. In case of an unsuccessful request, we will give up after a reasonable amount of attempts. Returns true.
 * @method ServerResponse deleteWebhook()                      Use this method to remove webhook integration if you decide to switch back to getUpdates. Returns True on success. Requires no parameters.
 * @method ServerResponse getWebhookInfo()                     Use this method to get current webhook status. Requires no parameters. On success, returns a WebhookInfo object. If the bot is using getUpdates, will return an object with the url field empty.
 * @method ServerResponse getMe()                              A simple method for testing your bot's auth token. Requires no parameters. Returns basic information about the bot in form of a User object.
 * @method ServerResponse forwardMessage(array $data)          Use this method to forward messages of any kind. On success, the sent Message is returned.
 * @method ServerResponse sendPhoto(array $data)               Use this method to send photos. On success, the sent Message is returned.
 * @method ServerResponse sendAudio(array $data)               Use this method to send audio files, if you want Telegram clients to display them in the music player. Your audio must be in the .mp3 format. On success, the sent Message is returned. Bots can currently send audio files of up to 50 MB in size, this limit may be changed in the future.
 * @method ServerResponse sendDocument(array $data)            Use this method to send general files. On success, the sent Message is returned. Bots can currently send files of any type of up to 50 MB in size, this limit may be changed in the future.
 * @method ServerResponse sendSticker(array $data)             Use this method to send .webp stickers. On success, the sent Message is returned.
 * @method ServerResponse sendVideo(array $data)               Use this method to send video files, Telegram clients support mp4 videos (other formats may be sent as Document). On success, the sent Message is returned. Bots can currently send video files of up to 50 MB in size, this limit may be changed in the future.
 * @method ServerResponse sendVoice(array $data)               Use this method to send audio files, if you want Telegram clients to display the file as a playable voice message. For this to work, your audio must be in an .ogg file encoded with OPUS (other formats may be sent as Audio or Document). On success, the sent Message is returned. Bots can currently send voice messages of up to 50 MB in size, this limit may be changed in the future.
 * @method ServerResponse sendVideoNote(array $data)           Use this method to send video messages. On success, the sent Message is returned.
 * @method ServerResponse sendMediaGroup(array $data)          Use this method to send a group of photos or videos as an album. On success, an array of the sent Messages is returned.
 * @method ServerResponse sendLocation(array $data)            Use this method to send point on the map. On success, the sent Message is returned.
 * @method ServerResponse editMessageLiveLocation(array $data) Use this method to edit live location messages sent by the bot or via the bot (for inline bots). A location can be edited until its live_period expires or editing is explicitly disabled by a call to stopMessageLiveLocation. On success, if the edited message was sent by the bot, the edited Message is returned, otherwise True is returned.
 * @method ServerResponse stopMessageLiveLocation(array $data) Use this method to stop updating a live location message sent by the bot or via the bot (for inline bots) before live_period expires. On success, if the message was sent by the bot, the sent Message is returned, otherwise True is returned.
 * @method ServerResponse sendVenue(array $data)               Use this method to send information about a venue. On success, the sent Message is returned.
 * @method ServerResponse sendContact(array $data)             Use this method to send phone contacts. On success, the sent Message is returned.
 * @method ServerResponse sendChatAction(array $data)          Use this method when you need to tell the user that something is happening on the bot's side. The status is set for 5 seconds or less (when a message arrives from your bot, Telegram clients clear its typing status). Returns True on success.
 * @method ServerResponse getUserProfilePhotos(array $data)    Use this method to get a list of profile pictures for a user. Returns a UserProfilePhotos object.
 * @method ServerResponse getFile(array $data)                 Use this method to get basic info about a file and prepare it for downloading. For the moment, bots can download files of up to 20MB in size. On success, a File object is returned. The file can then be downloaded via the link https://api.telegram.org/file/bot<token>/<file_path>, where <file_path> is taken from the response. It is guaranteed that the link will be valid for at least 1 hour. When the link expires, a new one can be requested by calling getFile again.
 * @method ServerResponse kickChatMember(array $data)          Use this method to kick a user from a group, a supergroup or a channel. In the case of supergroups and channels, the user will not be able to return to the group on their own using invite links, etc., unless unbanned first. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Returns True on success.
 * @method ServerResponse unbanChatMember(array $data)         Use this method to unban a previously kicked user in a supergroup or channel. The user will not return to the group or channel automatically, but will be able to join via link, etc. The bot must be an administrator for this to work. Returns True on success.
 * @method ServerResponse restrictChatMember(array $data)      Use this method to restrict a user in a supergroup. The bot must be an administrator in the supergroup for this to work and must have the appropriate admin rights. Pass True for all boolean parameters to lift restrictions from a user. Returns True on success.
 * @method ServerResponse promoteChatMember(array $data)       Use this method to promote or demote a user in a supergroup or a channel. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Pass False for all boolean parameters to demote a user. Returns True on success.
 * @method ServerResponse exportChatInviteLink(array $data)    Use this method to export an invite link to a supergroup or a channel. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Returns exported invite link as String on success.
 * @method ServerResponse setChatPhoto(array $data)            Use this method to set a new profile photo for the chat. Photos can't be changed for private chats. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Returns True on success.
 * @method ServerResponse deleteChatPhoto(array $data)         Use this method to delete a chat photo. Photos can't be changed for private chats. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Returns True on success.
 * @method ServerResponse setChatTitle(array $data)            Use this method to change the title of a chat. Titles can't be changed for private chats. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Returns True on success.
 * @method ServerResponse setChatDescription(array $data)      Use this method to change the description of a supergroup or a channel. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Returns True on success.
 * @method ServerResponse pinChatMessage(array $data)          Use this method to pin a message in a supergroup or a channel. The bot must be an administrator in the chat for this to work and must have the ‘can_pin_messages’ admin right in the supergroup or ‘can_edit_messages’ admin right in the channel. Returns True on success.
 * @method ServerResponse unpinChatMessage(array $data)        Use this method to unpin a message in a supergroup or a channel. The bot must be an administrator in the chat for this to work and must have the ‘can_pin_messages’ admin right in the supergroup or ‘can_edit_messages’ admin right in the channel. Returns True on success.
 * @method ServerResponse leaveChat(array $data)               Use this method for your bot to leave a group, supergroup or channel. Returns True on success.
 * @method ServerResponse getChat(array $data)                 Use this method to get up to date information about the chat (current name of the user for one-on-one conversations, current username of a user, group or channel, etc.). Returns a Chat object on success.
 * @method ServerResponse getChatAdministrators(array $data)   Use this method to get a list of administrators in a chat. On success, returns an Array of ChatMember objects that contains information about all chat administrators except other bots. If the chat is a group or a supergroup and no administrators were appointed, only the creator will be returned.
 * @method ServerResponse getChatMembersCount(array $data)     Use this method to get the number of members in a chat. Returns Int on success.
 * @method ServerResponse getChatMember(array $data)           Use this method to get information about a member of a chat. Returns a ChatMember object on success.
 * @method ServerResponse setChatStickerSet(array $data)       Use this method to set a new group sticker set for a supergroup. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Use the field can_set_sticker_set optionally returned in getChat requests to check if the bot can use this method. Returns True on success.
 * @method ServerResponse deleteChatStickerSet(array $data)    Use this method to delete a group sticker set from a supergroup. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Use the field can_set_sticker_set optionally returned in getChat requests to check if the bot can use this method. Returns True on success.
 * @method ServerResponse answerCallbackQuery(array $data)     Use this method to send answers to callback queries sent from inline keyboards. The answer will be displayed to the user as a notification at the top of the chat screen or as an alert. On success, True is returned.
 * @method ServerResponse answerInlineQuery(array $data)       Use this method to send answers to an inline query. On success, True is returned.
 * @method ServerResponse editMessageText(array $data)         Use this method to edit text and game messages sent by the bot or via the bot (for inline bots). On success, if edited message is sent by the bot, the edited Message is returned, otherwise True is returned.
 * @method ServerResponse editMessageCaption(array $data)      Use this method to edit captions of messages sent by the bot or via the bot (for inline bots). On success, if edited message is sent by the bot, the edited Message is returned, otherwise True is returned.
 * @method ServerResponse editMessageReplyMarkup(array $data)  Use this method to edit only the reply markup of messages sent by the bot or via the bot (for inline bots). On success, if edited message is sent by the bot, the edited Message is returned, otherwise True is returned.
 * @method ServerResponse deleteMessage(array $data)           Use this method to delete a message, including service messages, with certain limitations. Returns True on success.
 * @method ServerResponse getStickerSet(array $data)           Use this method to get a sticker set. On success, a StickerSet object is returned.
 * @method ServerResponse uploadStickerFile(array $data)       Use this method to upload a .png file with a sticker for later use in createNewStickerSet and addStickerToSet methods (can be used multiple times). Returns the uploaded File on success.
 * @method ServerResponse createNewStickerSet(array $data)     Use this method to create new sticker set owned by a user. The bot will be able to edit the created sticker set. Returns True on success.
 * @method ServerResponse addStickerToSet(array $data)         Use this method to add a new sticker to a set created by the bot. Returns True on success.
 * @method ServerResponse setStickerPositionInSet(array $data) Use this method to move a sticker in a set created by the bot to a specific position. Returns True on success.
 * @method ServerResponse deleteStickerFromSet(array $data)    Use this method to delete a sticker from a set created by the bot. Returns True on success.
 * @method ServerResponse sendInvoice(array $data)             Use this method to send invoices. On success, the sent Message is returned.
 * @method ServerResponse answerShippingQuery(array $data)     If you sent an invoice requesting a shipping address and the parameter is_flexible was specified, the Bot API will send an Update with a shipping_query field to the bot. Use this method to reply to shipping queries. On success, True is returned.
 * @method ServerResponse answerPreCheckoutQuery(array $data)  Once the user has confirmed their payment and shipping details, the Bot API sends the final confirmation in the form of an Update with the field pre_checkout_query. Use this method to respond to such pre-checkout queries. On success, True is returned.
 * @method ServerResponse sendMessage(array $data)             Use this method to send text messages. On success, the sent Message is returned.
 * @method ServerResponse encodeFile(string $file)             Encode file.
 * @method ServerResponse downloadFile(\Longman\TelegramBot\Entities\File $file) Download file.
 * @method ServerResponse getInput() Set input from custom input or stdin and return it.
 */
class Bot
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

	public function __call( $name, $arguments)
	{
		$result =  call_user_func_array(['Longman\TelegramBot\Request', $name], $arguments);
		if(property_exists($result, 'ok') && !$result->ok)
		{
			throw new TelegramException($result->description);
		}

		return $result;
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
	 * @return Telegram
	 */
	public function changeBot($token, $username = null)
	{
		if(empty($token))
			throw new InvalidArgumentException('$token can not be null.');
		else
			return new Telegram($token, $username);
	}

	/**
	 * @return mixed
	 */
	public function getDevelopers()
	{
		return $this->config['development']['developers_id'];
	}
}
