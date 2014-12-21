<?php
/**
 * This file is part of the Knightingale package.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Knightingale\Entity;

/**
 * A track.
 *
 * @package Knightingale\Entity
 */
class Track implements EntityInterface
{
    /**
     * The artist name.
     *
     * @var string
     */
    private $artistName;

    /**
     * The name.
     *
     * @var string
     */
    private $name;

    /**
     * Gets the track name.
     *
     * @return string The track name.
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the track name.
     *
     * @param string $name The track name.
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Gets the artist name.
     *
     * @return string
     */
    public function getArtistName()
    {
        return $this->artistName;
    }

    /**
     * Sets the artist name.
     *
     * @param string $artistName
     */
    public function setArtistName($artistName)
    {
        $this->artistName = $artistName;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->getName();
    }
}
