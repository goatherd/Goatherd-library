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

use Goatherd\Commons\Collection\EntityInterface;

/**
 *
 * @category  Goatherd
 * @package   Goatherd\Crawler
 */
interface CrawlerInterface
extends EntityInterface
{
    /**
     * Fetch data for a single URI.
     * If a callback is provided execution should be deferred until
     * execute()'ed.
     *
     * Callback must accept a single parameter of type
     * Goatherd\Crawler\ResponseInterface.
     *
     * @param string        $uri
     * @param callback      $callback        [=false]
     *
     * @return mixed
     */
    public function fetch($uri, callback $callback = false);

    /**
     * Force execution.
     *
     */
    public function execute();

    /**
     * Avoid execution and clear resources.
     *
     */
    public function endClean();
}
