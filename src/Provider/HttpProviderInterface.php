<?php
/**
 * This file is part of the Knightingale package.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Knightingale\Provider;

use Ivory\HttpAdapter\HttpAdapterInterface;

/**
 * A provider who provides HTTP access.
 *
 * @package Knightingale\Provider
 */
interface HttpProviderInterface extends ProviderInterface
{
    /**
     * Returns the HTTP adapter.
     *
     * @return HttpAdapterInterface The HTTP adapter.
     */
    public function getHttpAdapter();

    /**
     * Sets the HTTP adapter.
     *
     * @param HttpAdapterInterface $httpAdapter The HTTP adapter.
     *
     * @return void
     */
    public function setHttpAdapter(HttpAdapterInterface $httpAdapter);
}
