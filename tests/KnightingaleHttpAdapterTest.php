<?php
/**
 * This file is part of the Knightingale package.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Knightingale;

/**
 * KnightingaleHttpAdapter Tests
 */
class KnightingaleHttpAdapterTest extends \PHPUnit_Framework_TestCase
{
    public function testUserAgent()
    {
        $http = new KnightingaleHttpAdapter();

        $config = $http->getConfiguration();

        $regex = '@^Knightingale/([0-9]\.[0-9](\.[0-9])?(\-.+)?)\s@';
        $this->assertRegExp($regex, $config->getUserAgent());
    }

    public function testGetName()
    {
        $http = new KnightingaleHttpAdapter();
        $this->assertEquals('knightingale', $http->getName());
    }
}
