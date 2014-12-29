<?php
/**
 * This file is part of the Knightingale package.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Knightingale\User;

/**
 * Interface for user aware classes.
 *
 * @package Knightingale\User
 */
interface UserAwareInterface
{
    /**
     * Returns the user.
     *
     * @return UserInterface
     */
    public function getUser();

    /**
     * Sets the user.
     *
     * @param UserInterface $user The user.
     *
     * @return void
     */
    public function setUser(UserInterface $user);
}
