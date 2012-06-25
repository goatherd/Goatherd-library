<?php
/**
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://github.com/goatherd/Goatherd-library/blob/master/LICENSE.txt
 *
 * @category  Goatherd
 * @package   Goatherd\Commons
 * @copyright Copyright (c) 2012 Maik Penz <maik@phpkuh.de>
 * @license   https://github.com/goatherd/Goatherd-library/blob/master/LICENSE.txt     New BSD License
 */
namespace Goatherd\Commons\Collection;

/**
 * Full collection implementation.
 *
 * @category Goatherd
 * @package Goatherd\Commons
 * @subpackage Collection
 */
class Collection
extends \ArrayObject
implements ICollection
{
    /**
     * Entity base class/ interface.
     *
     * @var string
     */
    protected $_entityNamespace = '\\Goatherd\\Commons\\Collection\\IEntity';

    /**
     * (non-PHPdoc)
     * @see Goatherd\Commons\Collection.ICollection::getEntityNamespace()
     */
    public function getEntityNamespace()
    {
        return $this->_entityNamespace;
    }

    /**
     * (non-PHPdoc)
     * @see Goatherd\Commons\Collection.ICollection::clear()
     */
    public function clear()
    {
        return parent::exchangeArray(array());
    }

    /**
     * (non-PHPdoc)
     * @see ArrayObject::exchangeArray()
     */
    public function exchangeArray($array)
    {
        $old = $this->clear();

        foreach ($array as $key => $value) {
             $this->offsetSet($key, $value);
        }

        return $old;
    }

    /**
     * (non-PHPdoc)
     * @see ArrayAccess::offsetSet()
     */
    public function offsetSet ($offset, $value)
    {
        // TODO: might specify interfaces too!
        if (!is_object($value) && null !== $value) {
            throw new \InvalidArgumentException(sprintf("Value must be an object or null. '%s' given.", gettype($value)));
        } elseif (!($value instanceof $this->_entityNamespace)) {
            throw new \InvalidArgumentException(sprintf("Value must implement '%s'.", $this->_entityNamespace));
        }
        parent::offsetSet($offset, $value);
    }
}
