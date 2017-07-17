<?php

namespace TelegramBotApiBundle\Type;

interface TypeInterface
{
    /**
     * @param \stdClass $obj
     */
    public function loadResult(\stdClass $obj);
}
