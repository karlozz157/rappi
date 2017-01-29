<?php

namespace RappiBundle\DataStructure;

use RappiBundle\Entity\Matrix;

class CubeSummation
{
    /**
     * @const int
     */
    const CUBE_N_MIN = 1;
    const CUBE_N_MAX = 100;
    const CONSTRAINT_MIN = 1;

    /**
     * @var array $matrix
     */
    private $matrix = [];
    
    /**
     * @var int $n 
     */
    private $n;
    
    /**
     * @param int $n
     */
    public function __construct($n)
    {
        $this->n = $n;
        $this->fillMatrix();
    }

    /**
     * @return void
     */
    public function fillMatrix()
    {
        if ($this->n < self::CUBE_N_MIN || $this->n > self::CUBE_N_MAX) {
            throw new \Exception('Constraint: n > 1 || n < 100 ');
        }

        for ($x = 0; $x <= $this->n; $x++) {
            for ($y = 0; $y <= $this->n; $y++) {
                for ($z = 0; $z <= $this->n; $z++) {
                    $this->matrix[$x][$y][$z] = 0;
                }
            }
        }
    }

    /**
     * @param Matrix $matrix
     *
     * @return void
     */
    public function update(Matrix $matrix)
    {
        $x = $matrix->getX();
        $y = $matrix->getY();
        $z = $matrix->getZ();
        $w = $matrix->getValue();

        if ($x < self::CONSTRAINT_MIN || $x > $this->n) {
            throw new \Exception('Constraint: 1 <= x <= N ');
        }

        if ($y < self::CONSTRAINT_MIN || $y > $this->n) {
            throw new \Exception('Constraint: 1 <= y <= N ');
        }

        if ($z < self::CONSTRAINT_MIN || $z > $this->n) {
            throw new \Exception('Constraint: 1 <= z <= N ');
        }

        if ($w < pow(-10, 9) || $w > pow(10, 9)) {
            throw new Error('Constraint: -10^9 <= W <= 10^9');
        }

        $this->matrix[$x][$y][$z] = $x;
    }

    /**
     * @param Matrix $matrix1
     * @param Matrix $matrix2
     *
     * @return int
     */
    public function query(Matrix $matrix1, Matrix $matrix2)
    {
        $total = 0;

        $x1 = $matrix1->getX();
        $y1 = $matrix1->getY();
        $z1 = $matrix1->getZ();

        $x2 = $matrix2->getX();
        $y2 = $matrix2->getY();
        $z2 = $matrix2->getZ();
        
        if ($x1 < self::CONSTRAINT_MIN || $x1 > $this->n) {
            throw new \Exception('Constraint: x1 > 1 || x1 < n');
        }

        if ($y1 < self::CONSTRAINT_MIN || $y1 > $this->n) {
            throw new \Exception('Constraint: y1 > 1 || y1 < n');
        }

        if ($z1 < self::CONSTRAINT_MIN || $z1 > $this->n) {
            throw new \Exception('Constraint: z1 > 1 || z1 < n');
        }

        if ($x2 < self::CONSTRAINT_MIN || $x2 > $this->n) {
            throw new \Exception('Constraint: x2 > 1 || x2 < n');
        }

        if ($y2 < self::CONSTRAINT_MIN || $y2 > $this->n) {
            throw new \Exception('Constraint: y2 > 1 || y2 < n');
        }

        if ($z2 < self::CONSTRAINT_MIN || $z2 > $this->n) {
            throw new \Exception('Constraint: z2 > 1 || z2 < n');
        }

        if ($x1 > $x2) {
            throw new \Exception('Constraint: x1 <= x2');
        }

        if ($y1 > $y2) {
            throw new \Exception('Constraint: y1 <= y2');
        }

        if ($z1 > $z2) {
            throw new \Exception('Constraint: z1 <= z2');
        }

        for ($x = $x1; $x <= $x2; $x++) {
            for ($y = $y1; $y <= $y2; $y++) {
                for ($z = $z1; $z <= $z2; $z++) {
                    $total += $this->matrix[$x][$y][$z];
                }
            }
        }

        return $total;
    }
}
