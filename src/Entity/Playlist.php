<?php
/**
 * This file is part of the Knightingale package.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Knightingale\Entity;

/**
 * A playlist.
 *
 * @package Knightingale\Entity
 */
class Playlist implements EntityInterface
{
    /**
     * The tracks.
     *
     * @var PlaylistTrackCollection
     */
    private $tracks;

    /**
     * The playlist name.
     *
     * @var string
     */
    private $name;

    /**
     * Returns the playlist tracks.
     *
     * @return PlaylistTrackCollection
     */
    public function getTracks()
    {
        return $this->tracks;
    }

    /**
     * Sets the playlist tracks.
     *
     * @param PlaylistTrackCollection $tracks
     */
    public function setTracks($tracks)
    {
        $this->tracks = $tracks;
    }

    /**
     * Returns the name of the playlist.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the name of the playlist.
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->getName();
    }
}
