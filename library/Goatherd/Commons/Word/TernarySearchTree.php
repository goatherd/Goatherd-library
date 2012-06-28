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
 * Ternary search tree implementation.
 *
 * @note this implementation is not balanced.
 * However it is possible to balance input using balancedAddWords().
 *
 *
 * @todo add / update docs
 * See also http://xlinux.nist.gov/dads/HTML/digitalSearchTree.html
 *
 * @todo finish interface implementation
 * @todo balance list input
 * @todo cleanup
 *
 * @category  Goatherd
 * @package Goatherd\Commons
 * @subpackage Word
 */
class TernarySearchTree
extends DigitalSearchTree // TODO might use common abstract implementation
{
    /**#@+
     * Node key specification.
     *
     * @var array
     */
    const N_LABEL = 0;
    const N_LO = 1;
    const N_EQ = 2;
    const N_HI = 3;
    /**#@-*/

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
     * Input is balanced before being added to the tree.
     *
     * @param array $words
     */
    public function balancedAddWords(array &$words)
    {
        // TODO implement
    }
}