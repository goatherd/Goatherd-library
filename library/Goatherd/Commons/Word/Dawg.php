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
 * Suffix-compression for DigitalSearchTree and derivates.
 *
 * The implementation is neither space nor time efficient.
 *
 * @note a compressed trie must not be written.
 *
 * @category  Goatherd
 * @package Goatherd\Commons
 * @subpackage Word
 */
class Dawg
{
    /**
     *
     * @var integer
     */
    const N_UID = -2;

    /**
     * Compresses trie using references for common suffices.
     *
     * @param DigitalSearchTree $tree
     */
    public function compress(DigitalSearchTree $tree)
    {
        $ids = array();
        $this->compressNode($tree->getRoot(), $ids);
    }

    /**
     * Compress subtree.
     *
     * @param array $node   - node pointer
     * @param array $ids    - reference buffer
     */
    public function compressNode(array &$node, array &$ids)
    {
        foreach ($node as $key => &$child) {
            // ignore compressed leafs
            // ignore special keys
            if (is_string($key) || $key >= 0) {
                $id = $this->getNodeId($child);
                if (!isset($ids[$id])) {
                    // compress subtree
                    $ids[$id] = &$child;
                    unset($child[self::N_UID]);
                    $this->compressNode($child, $ids);
                }
                // use suffix reference
                $node[$key] = &$ids[$id];
            }
        }
    }

    /**
     *
     * @param array $node
     * @return string
     */
    public function getNodeId(array &$node)
    {
        // only calculate once
        if (isset($node[self::N_UID])) {
            return $node[self::N_UID];
        }

        $id = '[';
        $children = array_keys($node);
        sort($children, SORT_ASC);

        foreach ($children as $k) {
            $id .= $k;
            if ($k !== DigitalSearchTree::N_END_OF_WORD) {
                $child = &$node[$k];
                $id .= $this->getNodeId($child);
            }
        }
        $id .= ']';

        $node[self::N_UID] = $id;
        return $id;
    }
}