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

/**
 * @todo initiate multi curl handle (on init)
 * @todo resolve multi curl on endClean (well, prior to init..)
 * @todo upgrade _fetch logic to use multi_curl
 * @todo upgrade _clearResource logic to use multi_curl
 *
 * @category  Goatherd
 * @package   Goatherd\Crawler\Curl
 */
class MultiCrawler
extends Crawler
{
    /**
     * 
     * @var resource
     */
    protected $_handle = false;
    
    /**
     * (non-PHPdoc)
     * @see Goatherd\Crawler.CrawlerAbstract::_fetch()
     */
    protected function _fetch($uri, $resource)
    {
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
    }
}
