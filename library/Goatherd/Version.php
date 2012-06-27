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
 * @package   Goatherd
 * @copyright Copyright (c) 2012 Maik Penz <maik@phpkuh.de>
 * @license   https://github.com/goatherd/Goatherd-library/blob/master/LICENSE.txt     New BSD License
 */
namespace Goatherd;

/**
 * Library version and name.
 *
 * @category Goatherd
 * @package Goatherd
 * @subpackage Version
 */
final class Version
{
    /**
     * Library name
     *
     * @var string
     */
    const NAME = "Goatherd Library";

    /**
     * Library version string
     *
     * @var srtring
     */
    const VERSION = "0.7-dev";

    /**
     *
     * @param string $version
     * @return int
     */
    public static function compareVersion($version)
    {
        return version_compare(strtolower($version), self::VERSION);
    }
}