<?php  namespace Hex\CommandBus; 

use Illuminate\Support\ServiceProvider;

class CommandBusServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->bind('Hex\CommandBus\CommandBus', function()
        {
            return new CommandBus( $this->app, new CommandNameInflector );
        });
    }
} 