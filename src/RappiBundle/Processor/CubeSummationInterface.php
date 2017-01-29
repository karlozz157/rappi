<?php

namespace RappiBundle\Processor;

interface CubeSummationInterface
{
    /**
     * @param mixed $commands
     *
     * @return string
     */
    public function process($commands);
}
