<?php
/**
 * This file is part of the Knightingale package.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Knightingale\Provider;

/**
 * Interface for providers.
 *
 * @package Knightingale\Provider
 */
interface ProviderInterface
{
    /**
     * Returns the name.
     *
     * @return string The name.
     */
    public function getName();

    /**
     * Returns the string representation of this provider.
     *
     * @return string
     */
    public function __toString();
}
