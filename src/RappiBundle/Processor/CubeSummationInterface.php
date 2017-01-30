<?php

namespace RappiBundle\Processor;

interface CubeSummationInterface
{
    /**
     * @param mixed $input
     *
     * @return string
     */
    public function process($input);
}
