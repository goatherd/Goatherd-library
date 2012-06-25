<?php
/**
 * @category Goatherd
 * @package Goatherd\Commons
 *
 * @author Copyright (c) 2012 Maik Penz <maik@phpkuh.de>
 * @version $Id: ITrie.php 97 2012-04-27 22:41:30Z maik@phpkuh.de $
 *
 * This file is part of Goatherd library.
 *
 * Goatherd library is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * Goatherd library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with Goatherd library. If not, see <http://www.gnu.org/licenses/>.
 */
namespace Goatherd\Commons\Word;

/**
 * Generic trie interface (see http://en.wikipedia.org/wiki/Trie).
 *
 * @package Goatherd\Commons
 * @subpackage Word
 */
interface ITrie
extends ITree
{
    /**
     * Add word to trie.
     *
     * @param string $word
     * @throws Exception
     */
    public function addWord(&$word);

    /**
     * Batch-wise add.
     *
     * @param array|Traversable $words
     * @throws Exception
     */
    public function addWords(&$words);

    /**
     * Lookup word and retrieve indexed data (if there is any).
     *
     * @param string $word
     * @return mixed false if word is not indexed
     */
    public function has(&$word);

    /**
     * Word to path conversion.
     *
     * @param string $word
     * @return array
     */
    public function wordToPath(&$word);
}