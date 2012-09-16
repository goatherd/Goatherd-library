<?php
namespace Goatherd\Process\Ipc;

use Goatherd\Process\IpcHandlerInterface;

// TODO implement interface with shm* and semaphores
/**
 * // TODO document for pre-alpha release
 * Directed (parent-child) asynchronous IPC wrapper using shared memory (shm*)
 * and system signals (posix) for communication.
 *
 */
class SharedMemory
implements IpcHandlerInterface
{
    protected $_isConnected = false;
    protected $_isReady = false;

    /**
     *
     * @throws Exception When not running in cli or cgi context
     * @throws Exception When shmop_* functions do not exist
     * @throws Exception When posix_* functions do not exist
     */
    public function __construct()
    {
        // check extensions
        if (!in_array(substr(PHP_SAPI, 0, 3), array('cli', 'cgi'))) {
            throw new Exception('Can only run on CLI or CGI enviroment');
        } else if (!function_exists('shmop_open')) {
            throw new Exception('shmop_* functions are required');
        } else if (!function_exists('posix_kill')) {
            throw new Exception('posix_* functions are required');
        }
    }

    public function __destruct()
    {
        if ($this->_isConnected) {
            $this->disconnect();
        }
    }

    public function connect();

    public function disconnect();
}