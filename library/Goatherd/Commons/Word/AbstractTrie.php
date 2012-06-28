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
 * Implements most common trie methods.
 *
 * @category  Goatherd
 * @package Goatherd\Commons
 * @subpackage Word
 */
abstract class AbstractTrie
extends AbstractTree
implements ITrie
{
    /**
     * (non-PHPdoc)
     * @see Goatherd\Commons\Word.ITrie::addWord()
     */
    public function addWord(&$word)
    {
        $path = $this->wordToPath($word);
        $this->set($path, true);
    }

    /**
     * (non-PHPdoc)
     * @see Goatherd\Commons\Word.ITrie::addWords()
     */
    public function addWords(&$words)
    {
        foreach ($words as &$word) {
            $this->addWord($word);
        }
    }

    /**
     * (non-PHPdoc)
     * @see Goatherd\Commons\Word.ITrie::has()
     */
    public function has(&$word)
    {
        $path = $this->wordToPath($word);
        return $this->isLeaf($path);
    }

    /**
     * (non-PHPdoc)
     * @see Goatherd\Commons\Word.ITrie::wordToPath()
     */
    public function wordToPath(&$word)
    {
        return preg_split('//u', $word, -1, PREG_SPLIT_NO_EMPTY);
    }
}