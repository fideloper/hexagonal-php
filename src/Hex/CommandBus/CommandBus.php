<?php  namespace Hex\CommandBus; 

use Illuminate\Container\Container;

class CommandBus implements CommandBusInterface {

    /**
     * @var \Illuminate\Container\Container
     */
    private $container;

    /**
     * @var CommandNameInflector
     */
    private $inflector;

    public function __construct(Container $container, CommandNameInflector $inflector)
    {
        $this->container = $container;
        $this->inflector = $inflector;
    }

    public function execute(CommandInterface $command)
    {
        $this->getHandler($command)->handle($command);
    }

    private function getHandler($command)
    {
        return $this->container->make( $this->inflector->getHandler($command) );
    }
} 