<?php namespace Hex\Notifications;


class Message {

    protected $to = [];

    protected $from;

    protected $formattedMessage;

    protected $plainMessage;

    public function __construct(array $to, $from, $formattedMessage, $plainMessage='')
    {
        $this->to = $to;
        $this->from = $from;
        $this->formattedMessage = $formattedMessage;
        $this->plainMessage = $plainMessage;
    }
} 