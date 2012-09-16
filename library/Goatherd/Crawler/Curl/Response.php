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
 * @package   Goatherd\Crawler\Curl
 * @copyright Copyright (c) 2012 Maik Penz <maik@phpkuh.de>
 * @license   https://github.com/goatherd/Goatherd-library/blob/master/LICENSE.txt     New BSD License
 */
namespace Goatherd\Crawler\Curl;

use Goatherd\Crawler\ResponseAbstract;

/**
 *
 * @category  Goatherd
 * @package   Goatherd\Crawler\Curl
 */
class Response
extends ResponseAbstract
{
    /**
     *
     * @param resouce           $curlHandle
     * @param string            $uri
     * @param string            $data          [=null]
     */
    public function __construct($curlHandle, $uri, $data = null)
    {
        $this->_uri = $uri;
        $this->_data = $data;
        
        // get curl info and errors
        // TODO might retrieve curl data on demand
        // but that would block some resources
        $this->_info = curl_getinfo($this->_ch);
        $this->_errors[] = curl_error($this->_ch);
    }
}
