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
 * Nodes are represented using flat arrays holding end-of-word flag alongside
 * edge labels. It is assumed that no edge can be labeled using a negative
 * integer.
 * Radix trees might not profit from that compression as additional logic is
 * needed.
 *
 * @note it is not intended to but the DST can be used to store data
 *       as a hash table. However suffix compression will not work.
 *
 * @category  Goatherd
 * @package Goatherd\Commons
 * @subpackage Word
 */
class DigitalSearchTree
extends TrieAbstract
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
    protected $_emptyNode = array();

    /**
     * (non-PHPdoc)
     * @see Goatherd\Commons\Word.TreeInterface::get()
     */
    public function &get(array &$path)
    {
        $node = &$this->getNode($path);

        if ($node === false) {
            return null;
        }

        return isset($node[self::N_END_OF_WORD])
            ?$node[self::N_END_OF_WORD]
            :null;
    }

    /**
     *
     * @param array $path
     * @return boolean - node exists and is leaf
     */
    public function isLeaf(array &$path)
    {
        $node = &$this->getNode($path);
        return isset($node[self::N_END_OF_WORD]);
    }

    /**
     * (non-PHPdoc)
     * @see Goatherd\Commons\Word.TreeInterface::set()
     */
    public function set(array &$path, $data)
    {
        $node = &$this->_root;
        // TODO check path for invalid data? (value of -1 is not allowed
        foreach ($path as $key) {
            if (!isset($node[$key])) {
                $node[$key] = $this->_emptyNode;
            }
            $node = &$node[$key];
        }

        $node[self::N_END_OF_WORD] = $data;
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
            if (!isset($node[$key])) {
                unset($node);
                $node = false;
                break;
            }
            $node = &$node[$key];
        }

        return $node;
    }
}