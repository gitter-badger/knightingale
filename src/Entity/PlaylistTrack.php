<?php
/**
 * This file is part of the Knightingale package.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Knightingale\Entity;

/**
 * A playlist track.
 *
 * @package Knightingale\Entity
 */
class PlaylistTrack implements EntityInterface
{
    /**
     * The track.
     *
     * @var Track
     */
    private $track;

    /**
     * When the track has been added to the playlist.
     *
     * @var \DateTime
     */
    private $addedAt;

    /**
     * Gets the track.
     *
     * @return Track
     */
    public function getTrack()
    {
        return $this->track;
    }

    /**
     * Sets the track.
     *
     * @param Track $track
     */
    public function setTrack($track)
    {
        $this->track = $track;
    }

    /**
     * Gets the added at time.
     *
     * @return \DateTime
     */
    public function getAddedAt()
    {
        return $this->addedAt;
    }

    /**
     * Sets the added at time.
     *
     * @param \DateTime $addedAt
     */
    public function setAddedAt($addedAt)
    {
        $this->addedAt = $addedAt;
    }

    /**
     * Gets the track name.
     *
     * @see Track::getName()
     *
     * @return string
     */
    public function getName()
    {
        return $this->track->getName();
    }

    /**
     * Gets the track's artist name.
     *
     * @see Track::getArtistName()
     *
     * @return string
     */
    public function getArtistName()
    {
        return $this->track->getArtistName();
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return (string) $this->track;
    }
}
