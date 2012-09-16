<?php
namespace Goatherd\Process;

use Goatherd\Commons\Collection\EntityInterface;

/**
 * // TODO document interface for pre-alpha release
 * Simple inter process communication (IPC) interface.
 *
 */
interface IpcHandlerInterface
extends EntityInterface
{
    /**@#+
     * Lock states.
     *
     * @var integer
     */
    const LOCK_READ  = 1;
    const LOCK_WRITE = 2;
    const LOCK_EXCL  = 3;
    const LOCK_RELEASE = 0;
    /**@#-*/

    /**@#+
     * Instance role.
     * Either ROLE_PARENT or ROLE_CHILD for directed protocols
     * or ROLE_EQUAL for bidirectional protocols.
     * Additional roles might be added as needed.
     *
     * @var integer
     */
    const ROLE_PARENT = 1;
    const ROLE_CHILD = 2;
    const ROLE_EQUAL = 0;
    /**@#-*/

    /**@#+
     * Invoke return handling.
     *
     * @var integer
     */
    const INVOKE_VOID = 0;
    const INVOKE_RETURN = 1;
    /**@#-*/

    /**
     * Test connection.
     *
     * @return boolean
     */
    public function isReady();            // is connection set up

    /**
     * Get role in directed protocols.
     *
     * @return int
     */
    public function getRole();

    /**
     * Set lock status.
     *
     * @param int        $mode        Optional; Sets exclusive lock by default.
     *
     * @return boolean
     */
    public function lock($mode = self::LOCK_EXCL); // try to aquire lock

    /**
     * Get lock status.
     *
     * @return multitype:int|boolean    lock type or false
     */
    public function isLocked();           // get lock, if any

    /**
     * Initiate connection.
     *
     * @return boolean
     */
    public function connect();            // try to connect

    /**
     * Drop connection and clean up.
     *
     * @return boolean
     */
    public function disconnect();         // close connection and clean up

    /**
     * Force synchronisation.
     *
     * @return boolean        false on error
     */
    public function sync();               // wait for sync

    /**
     * Invoke method (on child only if connection is directed).
     *
     * Return value can be handled asynchronous (non-blocking) or
     * synchronous (blocking) using either the INVOKE_VOID or INVOKE_RETURN
     * class constants.
     *
     * @param string         $method  method to invoke
     * @param array          $args    optional; argument list
     * @param int            $type    return handling [=self::INVOKE_VOID]
     *
     * @return mixed
     */
    public function invoke(
        $method, array $args = array(), $type=self::INVOKE_VOID
    );
}
