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
 *
 * @category Goatherd
 * @package Goatherd\Commons
 * @subpackage Entity
 */
trait EntityTrait
{
    /**
     * Entity of key-value-pairs.
     *
     * @var array
     */
    protected $_properties = array();

    /**
     * Whether to allow adding of new key.
     * @todo is naming suitable?
     *
     * @var boolean
     */
    protected $_writable = false;

    /**
     * (non-PHPdoc)
     * @see Goatherd\Commons\Collection.IEntity::__get()
     */
    public function __get($key)
    {
        $method = 'get'.ucfirst($key);
        if (method_exists($this, $method)) {
            return $this->$method();
        }
        if (!array_key_exists($key, $this->_properties)) {
            throw new \OutOfBoundsException(sprintf("Unknown key '%s'.", $key));
        }

        return $this->_properties[$key];
    }

    /**
     * (non-PHPdoc)
     * @see Goatherd\Commons\Collection.IEntity::__set()
     */
    public function __set($key, $value)
    {
        $method = 'set'.ucfirst($key);
        if (method_exists($this, $method)) {
            return $this->$method($value);
        }
        if (!$this->_writable && !array_key_exists($key, $this->_properties)) {
            throw new \OutOfBoundsException(sprintf("Unknown key '%s'.", $key));
        }

        $this->_properties[$key] = $value;
    }

    /**
     * (non-PHPdoc)
     * @see Goatherd\Commons\Collection.IEntity::__unset()
     */
    public function __unset($key)
    {
        $method = 'unset'.ucfirst($key);
        if (method_exists($this, $method)) {
            return $this->$method();
        }
        if (!array_key_exists($key, $this->_properties)) {
            throw new \OutOfBoundsException(sprintf("Unknown key '%s'.", $key));
        }

        unset($this->_properties[$key]);
    }

    /**
     * (non-PHPdoc)
     * @see Goatherd\Commons\Collection.IEntity::__isset()
     */
    public function __isset($key)
    {
        $method = 'isset'.ucfirst($key);
        if (method_exists($this, $method)) {
            return $this->$method();
        }

        return array_key_exists($key, $this->_properties);
    }

    /**
     * (non-PHPdoc)
     * @see Goatherd\Commons\Collection.IEntity::isWritable()
     */
    public function isWritable($writable = null)
    {
        $wasWritable = $this->_writable;

        if (is_bool($writable)) {
            $this->_writable = $writable;
        }

        return $wasWritable;
    }

    /**
     * (non-PHPdoc)
     * @see Goatherd\Commons\Collection.IEntity::getProperties()
     */
    public function getProperties()
    {
        return $this->_properties;
    }
}
