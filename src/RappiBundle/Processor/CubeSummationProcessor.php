<?php

namespace RappiBundle\Processor;

class CubeSummationProcessor
{
    /**
     * @var CubeSummationInterface $adapter
     */
    protected $adapter;
    
    /**
     * @param CubeSummationInterface $adapter
     */
    public function __construct(CubeSummationInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @param mixed $commands
     *
     * @return string
     */
    public function process($commands)
    {
        return $this->adapter->process($commands);
    }
}
