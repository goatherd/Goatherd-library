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
 * Full-scale container implementation as defined by
 * http://en.wikipedia.org/wiki/Container_(data_structure)
 * for example.
 *
 * Collections are typed (requiring all entities to inherit a common interface).
 *
 * @category Goatherd
 * @package Goatherd\Commons
 * @subpackage Collection
 */
interface ICollection
extends \ArrayAccess, \IteratorAggregate, \Countable
{
    /**
     *
     * @return string
     */
    public function getEntityNamespace();

    /**
     *
     * @return array
     */
    public function clear();
}
