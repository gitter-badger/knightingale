<?php
/**
 * This file is part of the Knightingale package.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Knightingale\Provider;

/**
 * Dummy provider
 *
 * @package Knightingale\Provider
 */
class DummyHttpProvider implements HttpProviderInterface
{
    use HttpProviderTrait;

    /**
     * Returns the name.
     *
     * @return string The name.
     */
    public function getName()
    {
        return 'dummy_http_provider';
    }

    /**
     * Returns the string representation of this provider.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }
}
