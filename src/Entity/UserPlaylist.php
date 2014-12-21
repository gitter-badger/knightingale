<?php
/**
 * This file is part of the Knightingale package.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Knightingale\Entity;

use Knightingale\User\UserInterface;

/**
 * A user playlist.
 *
 * @package Knightingale\Entity
 */
class UserPlaylist extends Playlist
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
     * @return UserInterface The user.
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Sets the user.
     *
     * @param UserInterface $user The user.
     */
    public function setUser(UserInterface $user)
    {
        $this->user = $user;
    }
}
