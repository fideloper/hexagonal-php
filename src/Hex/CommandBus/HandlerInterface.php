<?php namespace Hex\CommandBus;

interface HandlerInterface {

    public function handle(CommandInterface $command);
}
 