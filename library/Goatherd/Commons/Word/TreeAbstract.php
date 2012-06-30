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
 * Common features of TreeInterface interface.
 *
 * @category  Goatherd
 * @package Goatherd\Commons
 * @subpackage Word
 */
abstract class TreeAbstract
implements TreeInterface
{
    /**
     *
     * @var array
     */
    protected $_root = array();

    /**
     * Get root reference.
     *
     * @return array
     */
    public function &getRoot()
    {
        return $this->_root;
    }

    /**
     * Get node.
     *
     * @param array $path
     * @return multitype:boolean|array
     */
    abstract public function getNode(array &$path);

    /**
     * Get node (pointer) as object.
     *
     * Note that even if the node itself was not cloned it might still contain
     * pointers at some level.
     *
     * @param array $path
     * @param boolean $clone - clone node [=true]
     * @return \Goatherd\Commons\Word\Tree - null if no node was found
     */
    public function getNodeObject(array &$path, $clone = true)
    {
        if ($clone === true) {
            $node = &$this->getNode($path);
        } else {
            $node = $this->getNode($path);
        }

        if ($node === false) {
            return null;
        }

        $obj = new static();
        $obj->setRoot($node);

        return $obj;
    }

    /**
     * Override root.
     *
     * @param array $node
     * @return \Goatherd\Commons\Word\TreeInterface - fluent interface
     */
    public function setRoot(array &$node)
    {
        $this->_root = &$node;
        return $this;
    }
}