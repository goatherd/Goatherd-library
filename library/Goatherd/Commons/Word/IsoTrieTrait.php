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
 * 8bit charset optimisation for trie.
 *
 * @category  Goatherd
 * @package Goatherd\Commons
 * @subpackage Word
 */
trait IsoTrieTrait
{
    /**
     * Simplified for 8bit charsets.
     *
     * (non-PHPdoc)
     * @see Goatherd\Commons\Word.ITrie::wordToPath()
     */
    public function wordToPath(&$word)
    {
        return str_split($word);
    }
}