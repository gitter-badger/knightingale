<?php
/**
 * This file is part of the Knightingale package.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Knightingale\Provider;

use Knightingale\User\User;
use Knightingale\User\UserAwareInterface;
use Knightingale\User\UserInterface;

/**
 * Provider Tests
 */
class ProviderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param string $providerClassName
     * @param string $expectedProviderName
     *
     * @dataProvider allProviders
     */
    public function testInitializeProvider($providerClassName, $expectedProviderName)
    {
        /** @var ProviderInterface $provider */
        $provider = new $providerClassName;

        $this->assertInstanceOf('Knightingale\Provider\ProviderInterface', $provider);
        $this->assertEquals($expectedProviderName, $provider->getName());
        $this->assertEquals($expectedProviderName, (string) $provider);
    }

    /**
     * @param string $providerClassName
     * @param User $user
     *
     * @dataProvider userAwareProviders
     */
    public function testInjectUserIntoUserAwareProvider($providerClassName, User $user)
    {
        /** @var ProviderInterface|UserAwareInterface $provider */
        $provider = new $providerClassName;
        $provider->setUser($user);

        $this->assertSame($user, $provider->getUser());
    }

    /**
     * @param string $providerClassName
     *
     * @dataProvider httpProviders
     */
    public function testInitializeHttpProvider($providerClassName)
    {
        /** @var HttpProviderInterface $provider */
        $provider = new $providerClassName;

        $this->assertInstanceOf('Knightingale\KnightingaleHttpAdapter', $provider->getHttpAdapter());
    }

    /**
     * @param string $providerClassName
     *
     * @dataProvider httpProviders
     */
    public function testInjectHttpAdapterIntoHttpProvider($providerClassName)
    {
        /** @var HttpProviderInterface $provider */
        $provider = new $providerClassName;

        $mock = $this->getMock('Ivory\HttpAdapter\HttpAdapterInterface');
        $provider->setHttpAdapter($mock);

        $this->assertSame($mock, $provider->getHttpAdapter());
    }

    /**
     * @param string $providerClassName
     *
     * @dataProvider playlistProviders
     */
    public function testDefinedPlaylistsAreCallable($providerClassName)
    {
        /** @var PlaylistProviderInterface $provider */
        $provider = new $providerClassName();

        $availablePlaylists = $provider->getAvailablePlaylists();
        $playlists = $provider->getPlaylists();

        $this->assertEquals($availablePlaylists, array_keys($playlists));

        foreach ($playlists as $id => $callable) {
            $this->assertTrue(
                is_callable($callable),
                sprintf(
                    'The playlist "%s" is defined in %s, but its callable is not callable',
                    $id,
                    $providerClassName
                )
            );
        }
    }

    /**
     * Test the provider's playlist features
     *
     * @group integration-tests
     *
     * @param string $providerClassName
     *
     * @dataProvider playlistProviders
     */
    public function testGetPlaylists($providerClassName)
    {
        /** @var \Knightingale\Provider\PlaylistProviderInterface $provider */
        $provider = new $providerClassName();

        $availablePlaylists = $provider->getAvailablePlaylists();

        foreach ($availablePlaylists as $id) {
            $playlist = $provider->getPlaylist($id);
            $this->assertInstanceOf('Knightingale\Entity\Playlist', $playlist);
            $this->assertGreaterThan(0, $playlist->getTracks()->count());
        }
    }

    /**
     * @param string $providerClassName
     * @param \Knightingale\User\User $user
     *
     * @dataProvider userPlaylistProviders
     */
    public function testDefinedUserPlaylistsAreCallable($providerClassName, User $user)
    {
        /** @var \Knightingale\Provider\UserPlaylistProviderInterface $provider */
        $provider = new $providerClassName();
        $provider->setUser($user);

        $availablePlaylists = $provider->getAvailableUserPlaylists();
        $playlists = $provider->getUserPlaylists();

        $this->assertEquals($availablePlaylists, array_keys($playlists));

        foreach ($playlists as $id => $callable) {
            $this->assertTrue(
                is_callable($callable),
                sprintf(
                    'The user playlist "%s" is defined in %s, but its callable is not callable',
                    $id,
                    $providerClassName
                )
            );
        }
    }

    /**
     * Test the provider's playlist features
     *
     * @group integration-tests
     *
     * @param string $providerClassName
     * @param UserInterface $user
     *
     * @dataProvider userPlaylistProviders
     */
    public function testGetUserPlaylists($providerClassName, UserInterface $user)
    {
        /** @var UserPlaylistProviderInterface $provider */
        $provider = new $providerClassName();
        $provider->setUser($user);

        $availablePlaylists = $provider->getAvailableUserPlaylists();

        foreach ($availablePlaylists as $id) {
            $playlist = $provider->getUserPlaylist($id);
            $this->assertInstanceOf('Knightingale\Entity\UserPlaylist', $playlist);
            $this->assertGreaterThan(0, $playlist->getTracks()->count());
        }
    }

    /**
     * @param string $providerClassName
     *
     * @dataProvider playlistProviders
     */
    public function testGetUndefinedPlaylist($providerClassName)
    {
        /** @var PlaylistProviderInterface $provider */
        $provider = new $providerClassName();

        $playlistId = uniqid('undefined_playlist_');

        $this->setExpectedException(
            'Knightingale\KnightingaleException',
            sprintf('The playlist "%s" has not been found (%s).', $playlistId, $provider->getName())
        );

        $provider->getPlaylist($playlistId);
    }

    /**
     * @param string $providerClassName
     * @param \Knightingale\User\User $user
     *
     * @dataProvider userPlaylistProviders
     */
    public function testGetUndefinedUserPlaylist($providerClassName, User $user)
    {
        /** @var \Knightingale\Provider\UserPlaylistProviderInterface $provider */
        $provider = new $providerClassName();
        $provider->setUser($user);

        $playlistId = uniqid('undefined_playlist_');

        $this->setExpectedException(
            'Knightingale\KnightingaleException',
            sprintf('The user playlist "%s" has not been found (%s).', $playlistId, $provider->getName())
        );

        $provider->getUserPlaylist($playlistId);
    }

    /**
     * @param string $providerClassName
     *
     * @dataProvider userPlaylistProviders
     */
    public function testGetUserPlaylistWithoutUser($providerClassName)
    {
        /** @var UserPlaylistProviderInterface $provider */
        $provider = new $providerClassName();

        $this->setExpectedException(
            'Knightingale\KnightingaleException',
            sprintf('%s requires a user.', $providerClassName)
        );

        $provider->getUser();
    }

    /**
     * @return array
     */
    public function allProviders()
    {
        return [
            ['Knightingale\Provider\Hypem\HypemProvider', 'hypem'],
        ];
    }

    /**
     * @return array
     */
    public function httpProviders()
    {
        return [
            ['Knightingale\Provider\Hypem\HypemProvider'],
        ];
    }

    /**
     * @return array
     */
    public function userAwareProviders()
    {
        return [
            ['Knightingale\Provider\Hypem\HypemProvider', new User(['hypem' => 'foudufafa'])],
        ];
    }

    /**
     * @return array
     */
    public function playlistProviders()
    {
        return [
            ['Knightingale\Provider\Hypem\HypemProvider'],
        ];
    }

    /**
     * @return array
     */
    public function userPlaylistProviders()
    {
        return [
            ['Knightingale\Provider\Hypem\HypemProvider', new User(['hypem' => 'foudufafa'])],
        ];
    }
}
