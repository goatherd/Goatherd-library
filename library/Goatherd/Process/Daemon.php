<?php
namespace Goatherd\Process;


/**
 *
 * TODO should allow basic forking AND daemon mode (using distinct classes)
 *
 * Influenced by ZendX_Console_Process_Unix
 */
class Daemon
extends PseudoThread
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
     * A data structure to hold data for Inter Process Communications
     *
     * @var array
     */
    private $_internalIpcData = array();

    /**
     * Key to access to Shared Memory Area.
     *
     * @var integer
     */
    private $_internalIpcKey;

    /**
     * Key to access to Sync Semaphore.
     *
     * @var integer
     */
    private $_internalSemKey;

    /**
     * Is Shared Memory Area OK? If not, the start() method will block.
     * Otherwise we'll have a running child without any communication channel.
     *
     * @var boolean
     */
    private $_ipcIsOkay;

    /**
     * Filename of the IPC segment file
     *
     * @var string
     */
    private $_ipcSegFile;

    /**
     * Filename of the semaphor file
     *
     * @var string
     */
    private $_ipcSemFile;

    public function start()
    {

    }

    public function stop()
    {

    }

    public function setChildMethod(Callable $x) {

    }

    public function setParentMethod(Callable $x) {

    }

    public function usePID($pidFilename)
    {

    }

    public function setVerifyChild($set = null)
    {

    }

    public function setSigHandler(Callable $x = null)
    {

    }

    public function setClearObCache($set = null)
    {

    }

    public function setClearStd($set = null)
    {
        // TODO clear STDIN, STDOUT, STDERR
    }

    public function __invoke()
    {
        // TODO start daemon
    }
}