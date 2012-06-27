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
namespace Goatherd\Commons\Word;

/**
 * Abstract tree interface.
 *
 * @category  Goatherd
 * @package Goatherd\Commons
 * @subpackage Word
 */
interface ITree
{
    /**
     *
     * @param array $path
     * @param mixed $data
     */
    public function set(array &$path, $data);

    /**
     *
     * @param array $path
     * @return mixed - node data or NULL on error
     */
    public function &get(array &$path);

    /**
     *
     * @param array $path
     * @return boolean - node exists and is leaf
     */
    public function isLeaf(array &$path);

    /**
     * Get root reference.
     *
     * @return array
     */
    public function &getRoot();

    /**
     * Override root.
     *
     * @param array $node
     * @return \Goatherd\Commons\Word\ITree - fluent interface
     */
    public function setRoot(array &$node);
}