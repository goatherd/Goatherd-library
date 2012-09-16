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
interface FilterInterface
{
    /**
     * Apply filter to crawler response.
     * 
     * @param ResponseInterface    $response
     */
    public function filter(ResponseInterface $response);
}
