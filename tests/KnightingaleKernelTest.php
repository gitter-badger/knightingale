<?php
/**
 * This file is part of the Knightingale package.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Knightingale;

use Knightingale\Provider\DummyProvider;
use Knightingale\Provider\DummyUserProvider;
use Knightingale\User\User;

/**
 * KnightingaleKernel Tests
 */
class KnightingaleKernelTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var KnightingaleKernel
     */
    protected $kernel;

    protected function setUp()
    {
        parent::setUp();

        $this->kernel = new KnightingaleKernel();
    }


    public function testInitializeKernel()
    {
        // There must be more than one :)
        $this->assertGreaterThan(0, count($this->kernel->getAvailableProviders()));
    }

    public function testGetNonExistentProvider()
    {
        $this->setExpectedException(
            'Knightingale\KnightingaleException',
            'A provider with the name "foo" has not been registered.'
        );

        $this->kernel->getProvider('foo');
    }

    public function testRegisterProviderTwice()
    {
        $p = new DummyProvider();

        $this->setExpectedException(
            'Knightingale\KnightingaleException',
            sprintf('A provider with the name "%s" has already been registered.', $p->getName())
        );

        $this->kernel->registerProvider($p);
        $this->kernel->registerProvider($p);
    }

    public function testRegisterProvider()
    {
        $k = new KnightingaleKernel();

        $numDefaultProviders = count($k->getAvailableProviders());
        $k->registerProvider($p = new DummyProvider());

        $this->assertEquals($numDefaultProviders + 1, count($k->getAvailableProviders()));
        $this->assertSame($p, $k->getProvider($p->getName()));
    }

    public function testUserGetsInjectedIntoExistingProviders()
    {
        $k = new KnightingaleKernel();
        $p = new DummyUserProvider();
        $u = new User([$p->getName() => 'foo']);


        $k->registerProvider($p);
        $k->setUser($u);

        $this->assertSame($u, $p->getUser());
    }

    public function testUserGetsInjectedAfterRegisteringAProvider()
    {
        $k = new KnightingaleKernel();
        $p = new DummyUserProvider();
        $u = new User([$p->getName() => 'foo']);


        $k->setUser($u);
        $k->registerProvider($p);

        $this->assertSame($u, $p->getUser());
    }
}
