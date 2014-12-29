<?php
/**
 * This file is part of the Knightingale package.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Knightingale;

use Ivory\HttpAdapter\ConfigurationInterface;
use Ivory\HttpAdapter\CurlHttpAdapter;

/**
 * HttpAdapter for requests made from a Knightingale provider.
 *
 * @package Knightingale
 */
class KnightingaleHttpAdapter extends CurlHttpAdapter
{
    /**
     * Creates a KnightingaleHttpAdapter.
     *
     * @param ConfigurationInterface $configuration
     */
    public function __construct(ConfigurationInterface $configuration = null)
    {
        parent::__construct($configuration);

        $this->overrideUserAgent();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'knightingale';
    }

    /**
     * Overrides the user agent
     */
    public function overrideUserAgent()
    {
        $configuration = $this->getConfiguration();

        $userAgent = sprintf('%s', $configuration->getUserAgent());
        $userAgent = sprintf('Knightingale/%s', $userAgent);

        $configuration->setUserAgent($userAgent);
        $this->setConfiguration($configuration);
    }
}
