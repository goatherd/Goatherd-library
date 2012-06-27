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
 * Simple trie implementation.
 * See also http://xlinux.nist.gov/dads/HTML/digitalSearchTree.html
 *
 * Nodes are represented as flat arrays while edges are single characters.
 * Radix trees might not profit from that compression.
 * @todo finish implementation
 * @todo might use common abstract trie
 *
 * @category  Goatherd
 * @package Goatherd\Commons
 * @subpackage Word
 */
class DigitalSearchTree
implements ITrie
{
    /**#@+
     * Node key specification.
     *
     * @var array
     */
    const N_END_OF_WORD = -1;
    /**#@-*/

    /**
     *
     * @var array
     */
    protected $_root = array();

    /**
     *
     * @param array $path
     * @return mixed - node data or NULL on error
     */
    public function &get(array &$path)
    {
        $node = &$this->getNode($path);

        if ($node !== false) {
            $node = &$node[self::N_DATA];
        }

        return $node;
    }

    /**
     * Get node.
     *
     * @param array $path
     * @return multitype:boolean|array
     */
    public function &getNode(array &$path)
    {
        $node = &$this->_root;
        foreach ($path as $key) {
            if (!isset($node[self::N_CHILDREN][$key])) {
                $node = false;
                break;
            }
            $node = &$node[self::N_CHILDREN][$key];
        }

        return $node;
    }

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
     *
     * @param array $path
     * @param mixed $data
     */
    public function set(array &$path, $data)
    {
        $node = &$this->_root;
        foreach ($path as $key) {
            if (!isset($node[self::N_CHILDREN][$key])) {
                $node[self::N_CHILDREN][$key] = $this->_emptyNode;
            }
            $node = &$node[self::N_CHILDREN][$key];
        }

        $node[self::N_DATA] = $data;
    }

    /**
     *
     * @param array $path
     * @return boolean - node exists and is leaf
     */
    public function isLeaf(array &$path)
    {
        $node = &$this->getNode($path);
        return $node !== false && isset($node[self::N_DATA]);
    }

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
     * Override root.
     *
     * @param array $node
     * @return \Goatherd\Commons\Word\ITree - fluent interface
     */
    public function setRoot(array &$node)
    {
        $this->_root = &$node;
        return $this;
    }
}