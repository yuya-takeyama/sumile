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
 * Dirty-hack for WebTestCase.
 *
 * @author Yuya Takeyama
 */
class Sumile_EnvironmentCleaner extends Slim_Environment
{
    public static function clean()
    {
        self::$environment = null;
    }
}
