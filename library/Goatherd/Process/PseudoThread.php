<?php
namespace Goatherd\Process;

use Goatherd\Commons\Collection\EntityInterface;

/**
 * TODO document for pre-alpha
 *
 * TODO should be allowed to set customer sig handler?
 * TODO is there a real use to plugable child actions? (it would seem so, but
 * they will share a lot of logic and it is some overhead to use a callable)
 *
 * Derived from ZendX_Console_Process_Unix
 * http://framework.zend.com/svn/framework/standard/tags/release-1.12.0rc4/extras/library/ZendX/Console/Process/Unix.php
 *
 * Inter process communication (IPC) is abstracted and access levels are
 * refactored. Minor changes to increase efficiency and accessability.
 */
class PseudoThread
implements EntityInterface
{

    /**
     * Unique thread name
     *
     * @var string
     */
    private $_name;

    /**
     * PID of the child process
     *
     * @var integer
     */
    private $_pid = null;

    /**
     * UID of the child process owner
     *
     * @var integer
     */
    private $_puid = null;

    /**
     * GUID of the child process owner
     *
     * @var integer
     */
    private $_guid = null;

    /**
     * Whether the process is yet forked or not
     *
     * @var boolean
     */
    private $_isRunning = false;

    /**
     * Wether we are into child process or not
     *
     * @var boolean
     */
    private $_isChild = false;

    /**
     * Inter process communication handler.
     *
     * @var \Goatherd\Process\IpcHandlerInterface
     */
    private $_ipcHandler = null;

    /**
     *
     * @var \Goatherd\Process\IpcWrapper
     */
    protected $_ipcWrapper = null;

    /**
     * Constructor method
     *
     * Allocates a new pseudo-thread object. Optionally, set a PUID, a GUID and
     * a UMASK for the child process. This also initialize Shared Memory
     * Segments for process communications.
     *
     * @param  integer $puid
     * @param  integer $guid
     * @param  integer $umask
     * @throws ZendX_Console_Process_Exception When running on windows
     * @throws ZendX_Console_Process_Exception When running in web enviroment
     * @throws ZendX_Console_Process_Exception When shmop_* functions don't exist
     * @throws ZendX_Console_Process_Exception When pcntl_* functions don't exist
     * @throws ZendX_Console_Process_Exception When posix_* functions don't exist
     */
    public function __construct($puid = null, $guid = null, $umask = null)
    {
//         if (substr(PHP_OS, 0, 3) === 'WIN') {
//             throw new ZendX_Console_Process_Exception('Cannot run on windows');
//         } else if (!in_array(substr(PHP_SAPI, 0, 3), array('cli', 'cgi'))) {
//             throw new ZendX_Console_Process_Exception('Can only run on CLI or CGI enviroment');
//         } else if (!function_exists('shmop_open')) {
//             throw new ZendX_Console_Process_Exception('shmop_* functions are required');
//         } else if (!function_exists('pcntl_fork')) {
//             throw new ZendX_Console_Process_Exception('pcntl_* functions are required');
//         } else if (!function_exists('posix_kill')) {
//             throw new ZendX_Console_Process_Exception('posix_* functions are required');
//         }

        $this->_isRunning = false;

        $this->_name = md5(uniqid(rand()));
        $this->_guid = $guid;
        $this->_puid = $puid;

        if ($umask !== null) {
            umask($umask);
        }

        $this->setChildaction([$this, '_run']);

        // TODO allow more sophisticated IPC setup; allow to run later
        // Try to create the shared memory segment. The variable
        // $this->_ipcIsOkay contains the return code of this operation and must
        // be checked before forking
//         if ($this->_createIpcSegment() && $this->_createIpcSemaphore()) {
//             $this->_ipcIsOkay = true;
//         } else {
//             $this->_ipcIsOkay = false;
//         }
    }

/**
     * Stop the child on destruction
     */
    public function __destruct()
    {
        if ($this->isRunning()) {
            $this->stop();
        }
    }

    public function start();
    public function stop();


    /**
     * Test if the pseudo-thread is already started.
     *
     * @return boolean
     */
    public function isRunning()
    {
        return $this->_isRunning;
    }

    /**
     * Returns the PID of the current pseudo-thread.
     *
     * @return integer
     */
    public function getPid()
    {
        return $this->_pid;
    }

    public function setAction(Callable $action)
    {
        $this->_run = $action;
    }

    /**
     *
     * @return \Goatherd\Process\IpcWrapper
     */
    public function getIpcWrapper()
    {
        if (null === $this->_ipcWrapper) {
            $this->_ipcWrapper = new IpcWrapper($this->_ipcHandler);
        }
        return $this->_ipcWrapper;
    }

    /**
     * Dummy action called by child.
     * Either extend this method or provide a callback via setAction().
     */
    protected function _run()
    {
        throw new Exception(
            'Child must either provide a valid callback or extend _run().'
        );
    }

    public function __get($key)
    {
        // TODO ipc handler might not be set
        return $this->_ipcHandler->__get($key);

    }

    public function __set($key, $value)
    {
        // TODO ipc handler might not be set
        $this->_ipcHandler->__set($key, $value);
    }

    public function __unset($key)
    {
        // TODO ipc handler might not be set
        $this->_ipcHandler->__unset($key);
    }

    public function __isset($key)
    {
        // TODO ipc handler might not be set
        return $this->_ipcHandler->__isset($key);
    }

    /**
     *
     * @param boolean|null $writable        new value or null [=null]
     * @return boolean                      old value
     */
    public function isWritable($writable = null)
    {
        // TODO ipc handler might not be set
        // TODO should try to set write lock?
        return $this->_ipcHandler->isWritable();
    }

    /**
    * Get entity properties.
    *
    * @return array    $properties
    */
    public function getProperties()
    {
        // TODO ipc handler might not be set
        return $this->_ipcHandler->getProperties();
    }
}