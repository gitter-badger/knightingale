<?php
/**
* This file is part of the Knightingale package.
*
* For the full copyright and license information, please read the LICENSE
* file that was distributed with this source code.
*/

namespace Knightingale\Provider;

use Knightingale\Entity\UserPlaylist;
use Knightingale\User\UserAwareInterface;

/**
 * A provider who provides user playlists.
 *
 * @package Knightingale\Provider
 */
interface UserPlaylistProviderInterface extends ProviderInterface, UserAwareInterface
{
    /**
     * Returns the user's favourite tracks in a playlist.
     *
     * @param mixed $id The playlist identifier.
     *
     * @return UserPlaylist
     */
    public function getUserPlaylist($id);

    /**
     * Returns a list of available user playlists.
     *
     * @return string[]
     */
    public function getAvailableUserPlaylists();

    /**
     * Returns an array of available user playlists.
     *
     * @return array
     */
    public function getUserPlaylists();
}
