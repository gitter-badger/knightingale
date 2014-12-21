<?php
/**
 * This file is part of the Knightingale package.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Knightingale;

use Knightingale\Provider\Hypem\HypemProvider;
use Knightingale\Provider\ProviderInterface;
use Knightingale\User\UserAwareInterface;
use Knightingale\User\UserInterface;

/**
 * The Knightingale kernel.
 *
 * @package Knightingale
 */
class KnightingaleKernel
{
    /**
     * The registered providers.
     *
     * @var ProviderInterface[]
     */
    private $providers;

    /**
     * The user.
     *
     * @var UserInterface
     */
    private $user;

    /**
     * Creates a Knightingale kernel.
     */
    public function __construct()
    {
        $this->registerDefaultProviders();
    }

    /**
     * Sets the user.
     *
     * @param \Knightingale\User\UserInterface $user The user.
     */
    public function setUser(UserInterface $user)
    {
        foreach($this->providers as $provider) {
            $this->injectUserIntoProvider($user, $provider);
        }

        $this->user = $user;
    }

    /**
     * Injects a user into a provider, if possible.
     *
     * @param \Knightingale\User\UserInterface $user The user.
     * @param ProviderInterface $provider The provider.
     */
    protected function injectUserIntoProvider(UserInterface $user, ProviderInterface $provider)
    {
        /** @var \Knightingale\User\UserAwareInterface|ProviderInterface $provider */ // <- Helping IDEs to get it right
        if ($provider instanceof UserAwareInterface && $user->hasMatchingUser($provider->getName())) {
            $provider->setUser($user);
        }
    }

    /**
     * Gets the registered providers.
     *
     * @return string[]
     */
    public function getAvailableProviders()
    {
        return array_keys($this->providers);
    }

    /**
     * Registers a provider.
     *
     * @throws KnightingaleException
     *
     * @param ProviderInterface $provider The provider.
     */
    public function registerProvider(ProviderInterface $provider)
    {
        $name = $provider->getName();

        if (isset($this->providers[$name])) {
            throw KnightingaleException::providerHasAlreadyBeenRegistered($name);
        }

        if (isset($this->user)) {
            $this->injectUserIntoProvider($this->user, $provider);
        }

        $this->providers[$name] = $provider;
    }

    /**
     * Gets a provider by name.
     *
     * @param string $name The provider name.
     *
     * @throws KnightingaleException When a provider does not exist.
     *
     * @return ProviderInterface The provider.
     */
    public function getProvider($name)
    {
        if (!isset($this->providers[$name])) {
            throw KnightingaleException::providerHasNotBeenRegistered($name);
        }

        return $this->providers[$name];
    }

    /**
     * Registers the default providers.
     */
    private function registerDefaultProviders()
    {
        $this->registerProvider(new HypemProvider());
    }
}
