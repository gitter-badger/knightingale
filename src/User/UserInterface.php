<?php
/**
 * This file is part of the Knightingale package.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Knightingale\User;
use Knightingale\KnightingaleException;


/**
 * User Interface
 *
 * @package Knightingale\User
 */
interface UserInterface
{
    /**
     * Adds a user for a provider.
     *
     * @param string $providerName The provider name.
     * @param string $userName The user name.
     *
     * @return void
     */
    public function addLinkedUser($providerName, $userName);

    /**
     * Gets a user for a given provider.
     *
     * @param string $providerName The provider name.
     *
     * @throws KnightingaleException When no user has been found for this provider.
     *
     * @return string
     */
    public function getMatchingUser($providerName);

    /**
     * Whether a user for a given provider has been defined.
     *
     * @param string $providerName The provider name.
     *
     * @return bool
     */
    public function hasMatchingUser($providerName);

    /**
     * String representation of the user.
     *
     * @return string
     */
    public function __toString();
}
