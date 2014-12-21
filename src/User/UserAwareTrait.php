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
 * UserAware Trait
 *
 * @package Knightingale\User
 */
trait UserAwareTrait
{
    /**
     * The user.
     *
     * @var UserInterface
     */
    private $user;

    /**
     * Returns the user.
     *
     * @see UserAwareInterface::getUser()
     *
     * @throws KnightingaleException When no user has been set.
     *
     * @return UserInterface The user.
     */
    public function getUser()
    {
        if (!$this->hasUser()) {
            throw KnightingaleException::aUserIsRequired($this);
        }
        return $this->user;
    }

    /**
     * Returns true if a user has been set.
     *
     * @see UserAwareInterface::hasUser()
     *
     * @return bool
     */
    public function hasUser()
    {
        return $this->user instanceof UserInterface;
    }

    /**
     * Sets the user.
     *
     * @see UserAwareInterface::setUser()
     *
     * @param UserInterface $user The user.
     */
    public function setUser(UserInterface $user)
    {
        $this->user = $user;
    }

    /**
     * Performs checks, e.g. if the specified user actually exists in the provided service.
     *
     * @see UserAwareInterface::checkUser()
     *
     * @param UserInterface $user
     *
     * @throws KnightingaleException When there is a problem with the user.
     */
    public function checkUser(UserInterface $user) {}
}
