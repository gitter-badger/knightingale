<?php
/**
 * This file is part of the Knightingale package.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Knightingale\User;

/**
 * User Tests
 */
class UserTest extends \PHPUnit_Framework_TestCase
{
    public function testInitializeUser()
    {
        $user = new User([
            'foo' => 'bar',
            'baz' => 'qux',
        ]);

        $this->assertTrue($user->hasMatchingUser('foo'));
        $this->assertTrue($user->hasMatchingUser('baz'));

        $this->assertEquals((string) $user, 'Knightingale\User\User (foo, baz)');
    }

    public function testAddLinkedUser()
    {
        $user = new User();
        $user->addLinkedUser('foo', 'bar');

        $this->assertTrue($user->hasMatchingUser('foo'));
    }

    public function testGetMatchingUser()
    {
        $user = new User(['foo' => 'bar']);

        $this->assertEquals('bar', $user->getMatchingUser('foo'));
    }

    public function testGetUndefinedMatchingUser()
    {
        $user = new User();

        $this->setExpectedException(
            'Knightingale\KnightingaleException',
            'No user has been set for the foo provider.');

        $user->getMatchingUser('foo');
    }
}
