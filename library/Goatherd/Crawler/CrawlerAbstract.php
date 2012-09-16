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

use Goatherd\Commons\Collection\EntityAbstract;

/**
 *
 * @category  Goatherd
 * @package   Goatherd\Crawler
 */
abstract class CrawlerAbstract
extends EntityAbstract
implements CrawlerInterface
{
    /**
     * Will replace properties on __construct() and endClean().
     *
     * @var array
     */
    protected $_defaultProperties = array();

    /**
     *
     * @var array
     */
    protected $_deferredFetch = array();

    /**
     *
     */
    public function __construct()
    {
        $this->init();
    }

    /**
     *
     */
    public function __destruct()
    {
        $this->endClean();
    }

    /**
     * (non-PHPdoc)
     * @see Goatherd\Crawler.CrawlerInterface::fetch()
     */
    public function fetch($uri, callback $callback = false)
    {
        $resource = $this->_prepareResource($uri);
        if ($callback === false) {
            return $this->_fetch($uri, $resource);
        } else {
            $this->_deferredFetch[$uri] = array($resource, $callback);
        }
    }

    /**
     * (non-PHPdoc)
     * @see Goatherd\Crawler.CrawlerInterface::execute()
     */
    public function execute()
    {
        foreach ($this->_deferredFetch as $uri => $request) {
            $callback = $request[1];
            $response = $this->_fetch($uri, $request[0]);
            $callback($response);
        }
    }

    /**
     * (non-PHPdoc)
     * @see Goatherd\Crawler.CrawlerInterface::endClean()
     */
    public function endClean()
    {
        foreach ($this->_deferredFetch as $uri => $request) {
            $this->_clearResource($uri);
        }
        
        $this->init();
    }
    
    /**
     * Called on __construct and after endClean().
     * 
     */
    public function init()
    {
        $this->_properties = $this->_defaultProperties;
    }

    /**
     *
     * @param string            $uri
     * @param mixed             $resource
     *
     * @return Goatherd\Crawler\ResponseInterface
     */
    abstract protected function _fetch($uri, $resource);

    /**
     *
     * @param string            $uri
     */
    protected function _clearResource($uri)
    {
        if (isset($this->_deferredFetch[$uri])) {
            unset($this->_deferredFetch[$uri]);
        }
    }

    /**
     * Prepare resource for uri.
     *
     * @param string            $uri
     * @return mixed
     */
    protected function _prepareResource($uri)
    {
        return false;
    }
}
