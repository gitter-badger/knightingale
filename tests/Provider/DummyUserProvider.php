<?php
/**
 * This file is part of the Knightingale package.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Knightingale\Provider;

use Knightingale\User\UserAwareInterface;
use Knightingale\User\UserAwareTrait;

/**
 * Dummy provider
 *
 * @package Knightingale\Provider
 */
class DummyUserProvider implements ProviderInterface, UserAwareInterface
{
    use UserAwareTrait;

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'dummy_user_provider';
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->getName();
    }
}
