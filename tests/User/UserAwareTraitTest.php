<?php
/**
 * This file is part of the Knightingale package.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Knightingale\User;

/**
 * UserAwareTrait Test
 */
class UserAwareTraitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject|UserAwareTrait
     */
    protected $trait;

    protected function setUp()
    {
        parent::setUp();

        $this->trait = $this->getMockForTrait('Knightingale\User\UserAwareTrait');
    }

    public function testSetAndHasAndGetUser()
    {
        /** @var UserInterface $user */
        $user = $this->getMock('Knightingale\User\UserInterface');

        $this->trait->setUser($user);

        $this->assertTrue($this->trait->hasUser());
        $this->assertSame($user, $this->trait->getUser());
    }

    public function testGetUndefinedUserThrowsAndException()
    {
        $this->setExpectedException(
            'Knightingale\KnightingaleException',
            sprintf('%s requires a user.', get_class($this->trait)));

        $this->trait->getUser();
    }
}
