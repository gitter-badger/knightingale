<?php
/**
 * This file is part of the Knightingale package.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Knightingale;

use Knightingale\Provider\ProviderInterface;

/**
 * Exceptions for Knightingale
 *
 * @package Knightingale
 */
class KnightingaleException extends \Exception
{
    /**
     * Creates a new "provider has not been registered" exception.
     *
     * @param string $providerName
     *
     * @return KnightingaleException
     */
    public static function providerHasNotBeenRegistered($providerName)
    {
        return new self(sprintf(
            'A provider with the name "%s" has not been registered.',
            $providerName
        ));
    }

    /**
     * Creates a new "provider has already been registered" exception.
     *
     * @param string $providerName
     *
     * @return KnightingaleException
     */
    public static function providerHasAlreadyBeenRegistered($providerName)
    {
        return new self(sprintf(
            'A provider with the name "%s" has already been registered.',
            $providerName
        ));
    }

    /**
     * Creates a new "user has not been found" exception
     *
     * @param string $providerName
     *
     * @return KnightingaleException
     */
    public static function noUserSetForProvider($providerName)
    {
        return new self(sprintf(
            'No user has been set for the %s provider.',
            $providerName
        ));
    }

    /**
     * Creates a new playlistHasNotBeenFound exception
     *
     * @param ProviderInterface $knightingaleProvider
     * @param string $playlistId
     *
     * @return KnightingaleException
     */
    public static function playlistHasNotBeenFound(ProviderInterface $knightingaleProvider, $playlistId)
    {
        return new self(sprintf(
            'The playlist "%s" has not been found (%s).',
            $playlistId,
            $knightingaleProvider
        ));
    }

    /**
     * Creates a new userPlaylistHasNotBeenFound exception
     *
     * @param ProviderInterface $provider
     * @param string $playlistId
     *
     * @return KnightingaleException
     */
    public static function userPlaylistHasNotBeenFound(ProviderInterface $provider, $playlistId)
    {
        return new self(sprintf('The user playlist "%s" has not been found (%s).', $playlistId, $provider));
    }

    /**
     * Creates an exception for when an entity did not inherit from a required interface.
     *
     * @param object $class
     * @param string $expected
     *
     * @return KnightingaleException
     */
    public static function entityMustInheritFromClass($class, $expected)
    {
        return new self(sprintf('The entity "%s" must inherit from "%s".', get_class($class), $expected));
    }

    /**
     * Creates an exception for when a user object is required, but not present.
     *
     * @param object $class
     *
     * @return KnightingaleException
     */
    public static function aUserIsRequired($class)
    {
        return new self(sprintf('%s requires a user.', get_class($class)));
    }
}
