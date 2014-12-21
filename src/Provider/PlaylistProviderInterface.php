<?php
/**
* This file is part of the Knightingale package.
*
* For the full copyright and license information, please read the LICENSE
* file that was distributed with this source code.
*/

namespace Knightingale\Provider;

/**
 * A provider who provides playlists.
 *
 * @package Knightingale\Provider
 */
interface PlaylistProviderInterface extends ProviderInterface
{
    /**
     * Returns a playlist.
     *
     * @param mixed $id The playlist identifier.
     *
     * @throws \Knightingale\KnightingaleException When a playlist has not been found.
     *
     * @return \Knightingale\Entity\Playlist
     */
    public function getPlaylist($id);

    /**
     * Returns a list of available playlists.
     *
     * @return string[]
     */
    public function getAvailablePlaylists();

    /**
     * Returns an array of available playlists.
     *
     * @return array<string,callback>
     */
    public function getPlaylists();
}
