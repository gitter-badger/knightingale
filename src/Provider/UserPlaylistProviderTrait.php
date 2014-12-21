<?php
/**
 * This file is part of the Knightingale package.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Knightingale\Provider;

use Knightingale\KnightingaleException;
use Knightingale\User\UserAwareTrait;

/**
 * UserPlaylistProvider Trait
 *
 * @package Knightingale\Provider
 */
trait UserPlaylistProviderTrait
{
    use UserAwareTrait;

    /**
     * Returns the user's favourite tracks in a playlist.
     *
     * @see UserPlaylistProviderInterface::getUserPlaylist()
     *
     * @param mixed $id The playlist identifier.
     *
     * @throws \Knightingale\KnightingaleException
     *
     * @return \Knightingale\Entity\UserPlaylist
     */
    public function getUserPlaylist($id)
    {
        $predefinedPlaylists = $this->getUserPlaylists();
        if (array_key_exists($id, $predefinedPlaylists)) {
            return call_user_func($predefinedPlaylists[$id]);
        }

        throw KnightingaleException::userPlaylistHasNotBeenFound($this, $id);
    }

    /**
     * Returns a list of available user playlists.
     *
     * @see UserPlaylistProviderInterface::getAvailableUserPlaylists()
     *
     * @return string[]
     */
    public function getAvailableUserPlaylists()
    {
        return array_keys($this->getUserPlaylists());
    }

    /**
     * Returns an array of available user playlists.
     *
     * @see UserPlaylistProviderInterface::getUserPlaylists()
     *
     * @return \array<string,callback>
     */
    abstract public function getUserPlaylists();
}
