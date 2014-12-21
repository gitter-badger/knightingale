<?php
/**
 * This file is part of the Knightingale package.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Knightingale\Provider;

/**
 * A provider who provides tracks.
 *
 * @package Knightingale\Provider
 */
interface TrackProviderInterface extends ProviderInterface
{
    /**
     * Returns a track.
     *
     * @return \Knightingale\Entity\Track
     */
    public function getTrack();

    /**
     * Returns a track collection.
     *
     * @return \Knightingale\Entity\TrackCollection
     */
    public function getTracks();
}
