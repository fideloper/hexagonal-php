<?php namespace Hex\Notifications;


interface NotifierInterface {

    public function send(Message $message);
} 