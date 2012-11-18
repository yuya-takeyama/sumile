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
 * Interface of ServiceProvider/
 *
 * @author Yuya Takeyama
 */
interface Sumile_ServiceProviderInterface
{
    public function register(Sumile_Application $app);

    public function boot(Sumile_Application $app);
}
