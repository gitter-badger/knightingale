<?php
/**
 * This file is part of the Knightingale package.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Knightingale\Entity;

/**
 * A track collection.
 *
 * @package Knightingale\Entity
 *
 * @method Track first()
 * @method Track current()
 * @method Track next()
 * @method Track last()
 * @method Track get($key)
 * @method Track[] getValues()
 * @method Track[] toArray()
 */
class TrackCollection extends EntityCollection
{
    /**
     * {@inheritdoc}
     */
    public function getEntityClassName()
    {
        return 'Knightingale\Entity\Track';
    }
}
