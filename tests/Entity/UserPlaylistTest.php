<?php
/**
 * This file is part of the Knightingale package.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Knightingale\Entity;

/**
 * UserPlaylist Tests
 *
 * Only the tests that differ from "normal" playlists
 */
class UserPlaylistTest extends \PHPUnit_Framework_TestCase
{
    public function testUser()
    {
        $p = new UserPlaylist();
        /** @var \PHPUnit_Framework_MockObject_MockObject|\Knightingale\User\User $u */
        $u = $this->getMock('Knightingale\User\User');

        $p->setUser($u);

        $this->assertEquals($u, $p->getUser());
    }
}
