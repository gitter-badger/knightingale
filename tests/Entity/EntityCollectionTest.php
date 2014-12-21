<?php
/**
 * This file is part of the Knightingale package.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Knightingale\Entity;

/**
 * EntityCollection Tests
 */
class EntityCollectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param string $collectionClassName
     * @param string $entityClassName
     *
     * @dataProvider collectionProvider
     */
    public function testCreateCollection($collectionClassName, $entityClassName)
    {
        $entity = $this->getMockBuilder($entityClassName)
            ->disableOriginalConstructor()
            ->getMock();

        $entity2 = clone $entity;

        /** @var EntityCollection $collection */
        $collection = new $collectionClassName([$entity]);
        $this->assertCount(1, $collection);
        $this->assertInstanceOf($collectionClassName, $collection);

        $collection->add($entity2);
        $this->assertCount(2, $collection);
    }

    /**
     * @param string $collectionClassName
     * @param string $entityClassName
     *
     * @dataProvider collectionProvider
     */
    public function testCreateCollectionWithInvalidEntity($collectionClassName, $entityClassName)
    {
        $this->setExpectedException(
            'Knightingale\KnightingaleException',
            sprintf('The entity "stdClass" must inherit from "%s".', $entityClassName)
        );

        new $collectionClassName([new \stdClass()]);
    }

    /**
     * Returns an array of items:
     * Collection class name / Item class name
     *
     * @return array
     */
    public function collectionProvider()
    {
        return [
            ['Knightingale\Entity\PlaylistTrackCollection', 'Knightingale\Entity\PlaylistTrack',],
            ['Knightingale\Entity\TrackCollection', 'Knightingale\Entity\Track', ],
        ];
    }
}
