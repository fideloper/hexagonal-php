<?php namespace Hex\Notifications;


class Message {

    protected $to = [];

    protected $from;

    protected $formattedMessage;

    protected $plainMessage;

    public function __construct($to, $from, $formattedMessage, $plainMessage='')
    {
        if( ! is_array($to) )
        {
            $to = [$to];
        }

        $this->to = $to;
        $this->from = $from;
        $this->formattedMessage = $formattedMessage;
        $this->plainMessage = $plainMessage;
    }
} 