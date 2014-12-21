<?php
/**
 * This file is part of the Knightingale package.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */
namespace Knightingale\Provider\Hypem;

use Knightingale\Entity\Playlist;
use Knightingale\Entity\PlaylistTrack;
use Knightingale\Entity\PlaylistTrackCollection;
use Knightingale\Entity\Track;
use Knightingale\Entity\UserPlaylist;
use Knightingale\Provider\HttpProviderInterface;
use Knightingale\Provider\PlaylistProviderInterface;
use Knightingale\Provider\UserPlaylistProviderInterface;
use Knightingale\Provider\HttpProviderTrait;
use Knightingale\Provider\PlaylistProviderTrait;
use Knightingale\Provider\UserPlaylistProviderTrait;

/**
 * The Hype Machine Provider.
 *
 * @package Knightingale\Provider
 * @subpackage Hypem
 */
class HypemProvider implements HttpProviderInterface, PlaylistProviderInterface, UserPlaylistProviderInterface
{
    use HttpProviderTrait, PlaylistProviderTrait, UserPlaylistProviderTrait;

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'hypem';
    }

    /**
     * {@inheritdoc}
     */
    public function getPlaylists()
    {
        return [
            'latest' => [$this, 'getLatest'],
            'popular' => [$this, 'getPopular'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getUserPlaylists()
    {
        return [
            'starred' => array($this, 'getStarred'),
        ];
    }

    /**
     * Returns the "latest" playlist.
     *
     * @return Playlist
     */
    public function getLatest()
    {
        $url = sprintf("http://hypem.com/playlist/latest/all/json");

        $response = $this->getHttpAdapter()->get($url);

        $data = json_decode($response->getBody()->getContents(), true);
        unset($data['version']); // This fields prevents us from iterating the array

        $trackCollection = new PlaylistTrackCollection();
        foreach ($data as $item) {
            $track = $this->hydratePlaylistTrack($item['artist'], $item['title'], $item['dateposted']);
            $trackCollection->add($track);
        }

        $playlist = new Playlist();
        $playlist->setName('The HypeMachine Latest Tracks');
        $playlist->setTracks($trackCollection);

        return $playlist;
    }

    /**
     * Returns the "popular" playlist.
     *
     * @return \Knightingale\Entity\Playlist
     */
    public function getPopular()
    {
        $url = sprintf("http://hypem.com/playlist/popular/all/json");

        $response = $this->getHttpAdapter()->get($url);

        $data = json_decode($response->getBody()->getContents(), true);
        unset($data['version']); // This fields prevents us from iterating the array

        $trackCollection = new PlaylistTrackCollection();
        foreach ($data as $item) {
            $track = $this->hydratePlaylistTrack($item['artist'], $item['title'], $item['dateposted']);
            $trackCollection->add($track);
        }

        $playlist = new Playlist();
        $playlist->setName('The HypeMachine Popular Tracks');
        $playlist->setTracks($trackCollection);

        return $playlist;
    }

    /**
     * Returns the "starred" user playlist.
     *
     * @throws \Knightingale\KnightingaleException When no user has been set for this provider.
     *
     * @return UserPlaylist
     */
    public function getStarred()
    {
        $userName = $this->getUser()->getMatchingUser($this->getName());

        $url = sprintf("http://hypem.com/playlist/loved/%s/json", $userName);

        $response = $this->getHttpAdapter()->get($url);

        $data = json_decode($response->getBody()->getContents(), true);
        unset($data['version']); // This fields prevents us from iterating the array

        $trackCollection = new PlaylistTrackCollection();
        foreach ($data as $item) {
            $track = $this->hydratePlaylistTrack($item['artist'], $item['title'], $item['dateloved']);
            $trackCollection->add($track);
        }

        $playlist = new UserPlaylist();
        $playlist->setName('The HypeMachine Loved Tracks');
        $playlist->setUser($this->getUser());
        $playlist->setTracks($trackCollection);

        return $playlist;
    }

    /**
     * Creates a playlist track from a Hypem track item.
     *
     * @param string $artistName The artist name.
     * @param string $trackTitle The track title.
     * @param integer $addedAt Unix timestamp.
     *
     * @return \Knightingale\Entity\PlaylistTrack
     */
    protected function hydratePlaylistTrack($artistName, $trackTitle, $addedAt)
    {
        $track = new Track();
        $track->setArtistName($artistName);
        $track->setName($trackTitle);

        $playlistTrack = new PlaylistTrack();
        $playlistTrack->setTrack($track);
        $playlistTrack->setAddedAt(\DateTime::createFromFormat('U', $addedAt));

        return $playlistTrack;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->getName();
    }
}
