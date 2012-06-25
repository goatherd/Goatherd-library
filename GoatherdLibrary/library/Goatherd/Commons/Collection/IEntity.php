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
 * Entity interface.
 *
 * Entities are consired to be extendable replacements for stdClass objects.
 *
 * @category Goatherd
 * @package Goatherd\Commons
 * @subpackage Entity
 */
interface IEntity
{
    /**
     *
     * @param scalar       $key
     * @return mixed       $value
     * @throws \OutOfBoundsException        if key is not known
     */
    public function __get($key);

    /**
     *
     * @param scalar       $key
     * @param mixed        $value
     * @throws \OutOfBoundsException        if not writable for some key
     * @throws \InvalidArgumentException    if restricting value for some key
     */
    public function __set($key, $value);

    /**
     *
     * @param mixed $key
     * @throws \OutOfBoundsException
     */
    public function __unset($key);

    /**
     *
     * @param scalar       $key
     * @return boolean
     */
    public function __isset($key);

    /**
     *
     * @param boolean|null $writable        new value or null [=null]
     * @return boolean                      old value
     */
    public function isWritable($writable = null);

    /**
    * Get entity properties.
    *
    * @return array    $properties
    */
    public function getProperties();
}
