<?php

namespace App\NotificationChannels\SMS\Messages;

class SmsMessage
{
    /**
     * The message content
     *
     * @var string
     */
    public $content;

    public function __construct(string $content = '')
    {
        $this->content = $content;
    }

    /**
     * Set the message content
     *
     * @return $this
     */
    public function content(string $content)
    {
        $this->content = $content;

        return $this;
    }
}
