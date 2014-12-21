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
     */
    public function setUser(UserInterface $user);

    /**
     * Performs checks, e.g. if the specified user actually exists in the provided service.
     *
     * @param UserInterface $user
     *
     * @throws \Knightingale\KnightingaleException When there is a problem with the user.
     */
    public function checkUser(UserInterface $user);
}
