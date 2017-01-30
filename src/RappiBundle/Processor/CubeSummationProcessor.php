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
     * @param mixed $input
     *
     * @return string
     */
    public function process($input)
    {
        return $this->adapter->process($input);
    }
}
