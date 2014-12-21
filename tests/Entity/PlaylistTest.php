<?php
/**
 * This file is part of the Knightingale package.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Knightingale\Entity;

/**
 * Playlist Tests
 */
class PlaylistTest extends \PHPUnit_Framework_TestCase
{
    public function testNewPlaylist()
    {
        $name = 'Playlist';
        $tracks = $this->getRandomTrackCollection();

        $playlist = new Playlist();
        $playlist->setName($name);
        $playlist->setTracks($tracks);

        $this->assertEquals($name, $playlist->getName());
        $this->assertEquals($name, (string) $playlist);

        $this->assertSame($tracks, $playlist->getTracks());
    }

    /**
     * @return PlaylistTrackCollection
     */
    protected function getRandomTrackCollection()
    {
        $collection = new PlaylistTrackCollection();

        for ($i = 0; $i < 2; $i++) {
            $t = new Track();
            $t->setName(sprintf('Track %s', $i));
            $t->setArtistName(sprintf('Artist %s', $i));

            $pt = new PlaylistTrack();
            $pt->setTrack($t);
            $pt->setAddedAt(new \DateTime());

            $collection->add($pt);
        }

        return $collection;
    }
}
