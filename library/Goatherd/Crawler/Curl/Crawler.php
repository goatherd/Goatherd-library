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

use Goatherd\Crawler\CrawlerAbstract;

/**
 *
 * @category  Goatherd
 * @package   Goatherd\Crawler\Curl
 */
class Crawler
extends CrawlerAbstract
{
    /**
     *
     * @var array
     */
    protected $_defaultProperties = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_BINARYTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_AUTOREFERER => true,
            CURLOPT_MAXREDIRS => 32,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_ENCODING => '',
    );

    /**
     *
     * @param string            $uri
     * @param resource          $resource
     *
     * @return \Goatherd\Crawler\Curl\Response
     */
    public function rawResponse($uri, $resource)
    {
        return new Response($resource, $uri);
    }

    /**
     * (non-PHPdoc)
     * @see Goatherd\Crawler.CrawlerAbstract::_fetch()
     */
    protected function _fetch($uri, $resource)
    {
        // TODO test resource/ response of curl_exec
        $data = curl_exec($resource);
        $response = $this->rawResponse($uri, $resource);
        $response->setData($data);

        // free resources
        $this->_clearResource($uri);

        return $response;
    }

    /**
     * (non-PHPdoc)
     * @see Goatherd\Crawler.CrawlerAbstract::_prepareResource()
     */
    protected function _prepareResource($uri)
    {
        // TODO test curl handle
        $ch = curl_init($uri);
        curl_setopt_array($ch, $this->getProperties());

        return $ch;
    }

    /**
     * (non-PHPdoc)
     * @see Goatherd\Crawler.CrawlerAbstract::_clearResource()
     */
    protected function _clearResource($uri)
    {
        if (isset($this->_deferredFetch[$uri])) {
            @curl_close($this->_deferredFetch[$uri][0]);
        }

        parent::_clearResource($uri);
    }
}
