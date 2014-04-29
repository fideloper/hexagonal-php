<?php  namespace Hex\Validation;

use Hex\CommandBus\CommandInterface;

interface ValidatorInterface {

    public function validate(CommandInterface $command);
} 