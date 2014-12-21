<?php
/**
 * This file is part of the Knightingale package.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Knightingale\Entity;

/**
 * A playlist track collection.
 *
 * @package Knightingale\Entity
 *
 * @method PlaylistTrack first()
 * @method PlaylistTrack current()
 * @method PlaylistTrack next()
 * @method PlaylistTrack last()
 * @method PlaylistTrack get($key)
 * @method PlaylistTrack[] getValues()
 * @method PlaylistTrack[] toArray()
 */
class PlaylistTrackCollection extends EntityCollection
{
    /**
     * {@inheritdoc}
     */
    public function getEntityClassName()
    {
        return 'Knightingale\Entity\PlaylistTrack';
    }
}
