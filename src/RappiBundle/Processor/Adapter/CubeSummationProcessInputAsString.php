<?php

namespace RappiBundle\Processor\Adapter;

use RappiBundle\DataStructure\CubeSummation;
use RappiBundle\Entity\Matrix;
use RappiBundle\Processor\CubeSummationInterface;

class CubeSummationProcessInputAsString implements CubeSummationInterface
{
    /**
     * @const int 
     */
    const CUBE_DEFINITION = 2;
    const CUBE_N = 0;
    const CUBE_M = 1;
    const M_MIN  = 1;
    const M_MAX  = 1000;

    /**
     * @const string
     */
    const BLANK_SPACE    = ' ';
    const QUERY_COMMAND  = 'QUERY';
    const UPDATE_COMMAND = 'UPDATE';

    /**
     * @var CubeSummation $cube
     */
    protected $cube;

    /**
     * @param string $input
     *
     * @return string
     */
    public function process($input)
    {
        $commands = explode(PHP_EOL, $input);
        $output = '';
        $m = 0;
        $n = 0;

        foreach ($commands as $command) {
            $command = trim($command);

            if ($this->isDefineCube($command)) {
                $cubeDefinition = $this->parseCommand($command);
                $n = $cubeDefinition[self::CUBE_N];
                $m = $cubeDefinition[self::CUBE_M];

                $this->cube = new CubeSummation($n);

                if ($this->isNotValidM($m)) {
                    throw new \Exception('Constraint: 1 <= M <= 1000');
                }
            }

            if ($this->cube && !$m) {
                continue;
            }

            if ($this->isUpdateCommand($command)) {
                $this->prepareUpdate($command);
                $m--;
            }

            if ($this->isQueryCommand($command)) {
                $output .= $this->prepareQuery($command) . PHP_EOL;
                $m--;
            }
        }

        return $output;
    }

    /** 
     * @param string $command
     *
     * @return boolean
     */
    protected function isDefineCube($command)
    {
        return self::CUBE_DEFINITION === count($this->parseCommand($command));
    }

    /**
     * @param string $m
     * 
     * @return boolean
     */
    protected function isNotValidM($m)
    {
        return ($m < self::M_MIN || $m > self::M_MAX);
    }
    
    /** 
     * @param string $command
     *
     * @return boolean
     */
    protected function isUpdateCommand($command)
    {
        return (strrpos($command, self::UPDATE_COMMAND) !== false);
    }

    /**
     * @param string $command
     *
     * @return boolean
     */
    protected function isQueryCommand($command)
    {
        return (strrpos($command, self::QUERY_COMMAND) !== false);
    }

    /**
     * @param string $command
     * 
     * @return string
     */
    protected function parseCommand($command)
    {
        return explode(self::BLANK_SPACE, $command);
    }

    /**
     * @param string $command
     */
    protected function prepareUpdate($command)
    {
        $update = $this->parseCommand($command);

        $matrix = new Matrix();
        $matrix
            ->setX(($update[1] - 1))
            ->setY(($update[2] - 1))
            ->setZ(($update[3] - 1))
            ->setValue($update[4]);

        $this->cube->update($matrix);
    }

    /**
     * @param string $command
     *
     * @return string
     */
    protected function prepareQuery($command)
    {
        $query = $this->parseCommand($command);

        $matrix1 = new Matrix();
        $matrix1
            ->setX(($query[1] - 1))
            ->setY(($query[2] - 1))
            ->setZ(($query[3] - 1));

        $matrix2 = new Matrix();
        $matrix2
            ->setX(($query[4] - 1))
            ->setY(($query[5] - 1))
            ->setZ(($query[6] - 1));

        return $this->cube->query($matrix1, $matrix2);
    }
}
