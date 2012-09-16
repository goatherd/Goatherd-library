<?php
namespace Goatherd\Process;

// TODO IpcWrapper takes an IpcHandler and provides a reduced interface
class IpcWrapper
implements IpcHandlerInterface
{
    /**
     *
     * @var \Goatherd\Process\IpcHandlerInterface
     */
    private $_handler = null;

    public function __construct(IpcHandlerInterface $handler)
    {
        // TODO handler must not be wrapper instance (mustn't it?)
        $this->_handler = $handler;
    }

    // TODO blocked methods
    public function sync();
    public function connect();
    public function disconnect();

    public function isReady()
    {
        return $this->_handler->isReady();
    }

    /**
     * (non-PHPdoc)
     * @see Goatherd\Process.IpcHandlerInterface::lock()
     */
    public function lock($mode = self::EXCL)
    {
        return $this->_handler->lock($mode);
    }
    /**
     * (non-PHPdoc)
     * @see Goatherd\Process.IpcHandlerInterface::isLocked()
     */
    public function isLocked()
    {
        return $this->_handler->isLocked();
    }

    // TODO execute method on client (other side)
    // TODO naming convention issue: call vs. fire vs. execute
    public function execute($method, $args);
}