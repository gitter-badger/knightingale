<?php
/**
 * This file is part of the Knightingale package.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Knightingale\Entity;

/**
 * Interface for entities.
 *
 * @package Knightingale\Entity
 */
interface EntityInterface
{
    /**
     * Returns the string representation of the entity.
     *
     * @return string
     */
    public function __toString();
}
