<?php
class Sumile_Provider_EventEmitterServiceProvider implements Sumile_ServiceProviderInterface
{
    public function register(Sumile_Application $app)
    {
        $app->share('emitter', array($this, 'provideEmitter'));
    }

    public function boot(Sumile_Application $app)
    {
    }

    public function provideEmitter($c)
    {
        require_once 'Edps/EventEmitter.php';

        return new Edps_EventEmitter;
    }
}
