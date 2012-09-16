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
abstract class ResponseAbstract
implements ResponseInterface
{
    /**
     *
     * @var array
     */
    protected $_errors = array();

    /**
     *
     * @var array
     */
    protected $_info = array();

    /**
     *
     * @var mixed
     */
    protected $_data = null;

    /**
     *
     * @var string
     */
    protected $_uri = false;

    /**
     * (non-PHPdoc)
     * @see Goatherd\Crawler.ResponseInterface::isValid()
     */
    public function isValid()
    {
        // no errors listed
        return $this->_errors === array();
    }

    /**
     * (non-PHPdoc)
     * @see Goatherd\Crawler.ResponseInterface::close()
     */
    public function close()
    {
        // response might be static
    }

    /**
     * (non-PHPdoc)
     * @see Goatherd\Crawler.ResponseInterface::getErrors()
     */
    public function getErrors()
    {
        return $this->_errors;
    }

    /**
     * (non-PHPdoc)
     * @see Goatherd\Crawler.ResponseInterface::getUri()
     */
    public function getUri()
    {
        return $this->_uri;
    }

    /**
     * (non-PHPdoc)
     * @see Goatherd\Crawler.ResponseInterface::addError()
     */
    public function addError($msg, $key = false)
    {
        if ($key === false) {
            $this->_errors[] = $msg;
        } else {
            $this->_errors[$key] = $msg;
        }
    }

    /**
     * (non-PHPdoc)
     * @see Goatherd\Crawler.ResponseInterface::resolveError()
     */
    public function resolveError($key)
    {
        if (isset($this->_errors[$key])) {
            unset($this->_errors[$key]);
        }
    }

    /**
     * (non-PHPdoc)
     * @see Goatherd\Crawler.ResponseInterface::getInfo()
     */
    public function getInfo($key = false)
    {
        if ($key === false) {
            return $this->_info;
        }

        if (isset($this->_info[$key])) {
            return $this->_info[$key];
        }
    }

    /**
     * (non-PHPdoc)
     * @see Goatherd\Crawler.ResponseInterface::setInfo()
     */
    public function setInfo($key, $value)
    {
        $this->_info[$key] = $value;
    }

    /**
     * (non-PHPdoc)
     * @see Goatherd\Crawler.ResponseInterface::getData()
     */
    public function getData()
    {
        return $this->_data;
    }

    /**
     * (non-PHPdoc)
     * @see Goatherd\Crawler.ResponseInterface::setData()
     */
    public function setData($data)
    {
        $this->_data = $data;
    }
}
