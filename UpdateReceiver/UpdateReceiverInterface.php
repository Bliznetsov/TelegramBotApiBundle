<?php

namespace TelegramBotApiBundle\UpdateReceiver;

use TelegramBotApiBundle\Type\Update;

interface UpdateReceiverInterface
{
    public function handleUpdate(Update $update);
}
