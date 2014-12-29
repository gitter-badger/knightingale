<?php
/**
 * This file is part of the Knightingale package.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Knightingale\Provider;
use Knightingale\KnightingaleException;

/**
 * PlaylistProvider Trait
 *
 * @package Knightingale\Provider
 */
trait PlaylistProviderTrait
{
    /**
     * Returns a playlist.
     *
     * @see PlaylistProviderInterface::getPlaylist()
     *
     * @param mixed $id The playlist identifier.
     *
     * @throws \Knightingale\KnightingaleException When a playlist has not been found.
     *
     * @return \Knightingale\Entity\Playlist
     */
    public function getPlaylist($id)
    {
        $predefinedPlaylists = $this->getPlaylists();
        if (array_key_exists($id, $predefinedPlaylists)) {
            return call_user_func($predefinedPlaylists[$id]);
        }

        throw KnightingaleException::playlistHasNotBeenFound($this, $id);
    }

    /**
     * Returns a list of available playlists.
     *
     * @see PlaylistProviderInterface::getAvailablePlaylists()
     *
     * @return string[]
     */
    public function getAvailablePlaylists()
    {
        return array_keys($this->getPlaylists());
    }

    /**
     * Returns an array of available playlists.
     *
     * @see PlaylistProviderInterface::getPlaylists()
     *
     * @return array
     */
    abstract function getPlaylists();
}
