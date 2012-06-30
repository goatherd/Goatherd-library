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
 * Generic tree implementation.
 *
 * Nodes are represented as nested arrays that store node data and
 * child pointers. You should consider using a trie if possible as
 * flat node arrays use much less memory.
 *
 * @category  Goatherd
 * @package Goatherd\Commons
 * @subpackage Word
 */
class Tree
extends TreeAbstract
{
    /**#@+
     * Node key specification.
     *
     * @var array
     */
    const N_CHILDREN = 1;
    const N_DATA = 0;
    /**#@-*/

    /**
     *
     * @var array
     */
    protected $_root = array(self::N_CHILDREN => array());

    /**
     *
     * @var array
     */
    protected $_emptyNode = array(self::N_CHILDREN => array());

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
                unset($node);
                $node = false;
                break;
            }
            $node = &$node[self::N_CHILDREN][$key];
        }

        return $node;
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
}