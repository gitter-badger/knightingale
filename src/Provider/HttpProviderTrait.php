<?php
/**
 * This file is part of the Knightingale package.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Knightingale\Provider;

use Ivory\HttpAdapter\HttpAdapterInterface;
use Knightingale\KnightingaleHttpAdapter;

/**
 * HttpProvider Trait
 *
 * @package Knightingale\Provider
 */
trait HttpProviderTrait
{
    /**
     * The HTTP adapter.
     *
     * @var HttpAdapterInterface
     */
    private $http;

    /**
     * Returns the HTTP adapter.
     *
     * @see HttpProviderInterface::getHttpAdapter()
     *
     * @return HttpAdapterInterface The HTTP adapter.
     */
    public function getHttpAdapter()
    {
        if (!$this->http) {
            $this->setHttpAdapter(new KnightingaleHttpAdapter());
        }

        return $this->http;
    }

    /**
     * Sets the HTTP adapter.
     *
     * @see HttpProviderInterface::setHttpAdapter()
     *
     * @param HttpAdapterInterface $httpAdapter The HTTP adapter.
     *
     * @return void
     */
    public function setHttpAdapter(HttpAdapterInterface $httpAdapter)
    {
        $this->http = $httpAdapter;
    }
}
