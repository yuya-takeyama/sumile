<?php
/**
 * This file is part of Sumile.
 *
 * (c) Yuya Takeyama
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * ServiceProvider of EDPS' EventEmitter.
 *
 * @author Yuya Takeyama
 */
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
        return new Edps_EventEmitter;
    }
}
