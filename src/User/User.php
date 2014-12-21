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
 * User
 *
 * @package Knightingale\User
 */
class User implements UserInterface
{
    /**
     * Users used by the providers, where needed.
     *
     * @var string[]
     */
    private $linkedUsers;

    /**
     * Creates a user.
     *
     * @param array $data Linked users.
     */
    public function __construct(array $data = [])
    {
        $this->linkedUsers = [];

        foreach ($data as $providerName => $userName) {
            $this->addLinkedUser($providerName, $userName);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function addLinkedUser($providerName, $userName)
    {
        $this->linkedUsers[$providerName] = $userName;
    }

    /**
     * {@inheritdoc}
     */
    public function getMatchingUser($providerName)
    {
        if (!$this->hasMatchingUser($providerName)) {
            throw KnightingaleException::noUserSetForProvider($providerName);
        }

        return $this->linkedUsers[$providerName];
    }

    /**
     * {@inheritdoc}
     */
    public function hasMatchingUser($providerName)
    {
        return array_key_exists($providerName, $this->linkedUsers);
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return sprintf('%s (%s)', get_class($this), implode(', ', array_keys($this->linkedUsers)));
    }
}
