<?php
/**
 * This file is part of the Knightingale package.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Knightingale\Entity;

/**
 * Track Tests
 */
class TrackTest extends \PHPUnit_Framework_TestCase
{
    public function testTrackAttributes()
    {
        $name = uniqid('tn_');
        $artistName = uniqid('an_');

        $track = new Track();
        $track->setName($name);
        $track->setArtistName($artistName);

        $this->assertEquals($name, $track->getName());
        $this->assertEquals($artistName, $track->getArtistName());
        $this->assertEquals($name, (string) $track);
    }
}
