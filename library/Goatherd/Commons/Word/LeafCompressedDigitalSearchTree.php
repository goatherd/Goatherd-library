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
 * Adds leaf compression to DST: instead of `array(-1=>true)` for leaves
 * boolean `true` is used (or any given data if used as hash table - see DST
 * class for that).
 *
 * @note if used as hash table: data must not be of type array.
 *
 * @category  Goatherd
 * @package Goatherd\Commons
 * @subpackage Word
 */
class LeafCompressedDigitalSearchTree
extends DigitalSearchTree
{
    /**
     * (non-PHPdoc)
     * @see Goatherd\Commons\Word.DigitalSearchTree::get()
     */
    public function &get(array &$path)
    {
        $node = &$this->getNode($path);

        if ($node === false) {
            return null;
        }
        if ($node === true) {
            return true;
        }

        return isset($node[self::N_END_OF_WORD])
            ?$node[self::N_END_OF_WORD]
            :null;
    }

    /**
     * (non-PHPdoc)
     * @see Goatherd\Commons\Word.DigitalSearchTree::isLeaf()
     */
    public function isLeaf(array &$path)
    {
        $node = &$this->getNode($path);
        return $node === true || isset($node[self::N_END_OF_WORD]);
    }

    /**
     * (non-PHPdoc)
     * @see Goatherd\Commons\Word.TreeInterface::set()
     */
    public function set(array &$path, $data)
    {
        $node = &$this->_root;
        // TODO check path for invalid data? (value of -1 is not allowed)
        // TODO $data must not be of type array or null
        // last node will be handled separately
        $last = array_pop($path);
        // traverse and create nodes if needed
        foreach ($path as $key) {
            if (!isset($node[$key])) {
                $node[$key] = $this->_emptyNode;
            }
            // TODO === true is faster but might break with custom data
            if (!is_array($node[$key])) {
                $empty = $this->_emptyNode;
                $empty[self::N_END_OF_WORD] = &$node[$key];
                unset($node[$key]);
                $node[$key] = $empty;
            }
            $node = &$node[$key];
        }

        if (isset($node[$last])) {
            $node[$last][self::N_END_OF_WORD] = $data;
        } else {
            $node[$last] = $data;
        }
    }
}