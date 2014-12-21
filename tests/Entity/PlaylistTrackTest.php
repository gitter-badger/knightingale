<?php
/**
 * This file is part of the Knightingale package.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Knightingale\Entity;

/**
 * PlaylistTrack Tests
 */
class PlaylistTrackTest extends \PHPUnit_Framework_TestCase
{
    public function testPlaylistTrack()
    {
        $track = $this->getRandomTrack();
        $now = new \DateTime();

        $pt = new PlaylistTrack();
        $pt->setTrack($track);
        $pt->setAddedAt($now);

        $this->assertSame($now, $pt->getAddedAt());
        $this->assertSame($track, $pt->getTrack());

        $this->assertEquals($track->getName(), $pt->getName());
        $this->assertEquals($track->getArtistName(), $pt->getArtistName());

        $this->assertEquals((string) $track, (string) $pt);
    }

    /**
     * @return Track
     */
    protected function getRandomTrack()
    {
        $track = new Track();
        $track->setName(uniqid('tn_'));
        $track->setArtistName(uniqid('an_'));

        return $track;
    }
}
