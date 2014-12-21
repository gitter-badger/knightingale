<?php
/**
 * This file is part of the Knightingale package.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Knightingale\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Knightingale\KnightingaleException;

/**
 * Abstract class for entity collections.
 *
 * @package Knightingale\Entity
 */
abstract class EntityCollection extends ArrayCollection implements EntityCollectionInterface
{
    /**
     * Throws an EntityException when the given entity is not or does not inherit from the right class.
     *
     * @param mixed $entity
     *
     * @throws \Knightingale\KnightingaleException When the given entity is not or does not inherit from the right class.
     */
    protected function assertClass($entity)
    {
        $parents = array_merge([get_class($entity)], class_parents($entity));
        $expected = $this->getEntityClassName($entity);

        if (!in_array($this->getEntityClassName($entity), $parents, true)) {
            throw KnightingaleException::entityMustInheritFromClass($entity, $expected);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function __construct(array $elements = array())
    {
        array_walk($elements, [$this, 'assertClass']);

        parent::__construct($elements);
    }

    /**
     * {@inheritdoc}
     */
    public function add($value)
    {
        $this->getEntityClassName($value);

        return parent::add($value);
    }
}
