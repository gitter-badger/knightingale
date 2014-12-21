<?php
/**
 * This file is part of the Knightingale package.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Knightingale\Entity;

/**
 * Interface for entity collections.
 *
 * @package Knightingale\Entity
 */
interface EntityCollectionInterface
{
    /**
     * Throws an KnightingaleException when the given entity is not or does not inherit from the right class.
     *
     * @throws \Knightingale\KnightingaleException
     * @return string
     */
    public function getEntityClassName();
}
