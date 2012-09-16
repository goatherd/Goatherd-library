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
 * @package   Goatherd\Crawler
 * @copyright Copyright (c) 2012 Maik Penz <maik@phpkuh.de>
 * @license   https://github.com/goatherd/Goatherd-library/blob/master/LICENSE.txt     New BSD License
 */
namespace Goatherd\Crawler;

/**
 *
 * @category  Goatherd
 * @package   Goatherd\Crawler
 */
interface ResponseInterface
{
    /**
     * 
     * @return boolean
     */
    public function isValid();

    /**
     * Close open resource bindings.
     * 
     */
    public function close();

    /**
     * 
     * @return array
     */
    public function getErrors();
    
    /**
     * 
     * @return string
     */
    public function getUri();

    /**
     * Add error message.
     * 
     * @param string            $msg
     * @param integer|string    $key        [=false]
     */
    public function addError($msg, $key = false);

    /**
     * Remove error from error list.
     * Useful if a filter could resolve it.
     * 
     * @param string|integer    $key
     */
    public function resolveError($key);

    /**
     * Get array with additional information or single value.
     * 
     * @param string|integer    $key    [=false]
     * 
     * @return mixed
     */
    public function getInfo($key = false);

    /**
     * Set additional info.
     * Useful for chained filters.
     * 
     * @param string|integer    $key
     * @param mixed             $value
     */
    public function setInfo($key, $value);

    /**
     * Retrieve data for response.
     * Data might be asynchronous and slow to load.
     * 
     * @return mixed
     */
    public function getData();

    /**
     * Replace data.
     * 
     * @param mixed             $data
     */
    public function setData($data);
}
