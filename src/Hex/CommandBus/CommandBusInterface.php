<?php  namespace Hex\CommandBus; 

interface CommandBusInterface {

    public function execute(CommandInterface $command);
} 