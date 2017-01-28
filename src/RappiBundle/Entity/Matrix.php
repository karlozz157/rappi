<?php

namespace RappiBundle\Entity;

class Matrix
{
    /**
     * @var int $x
     */
    protected $x;

    /**
     * @var int $y
     */
    protected $y;

    /**
     * @var int $z
     */
    protected $z;

    /**
     * @var string $value
     */
    protected $value;

    /**
     * @param int $x
     *
     * @return $this
     */
    public function setX($x)
    {
        $this->x = $x;

        return $this;
    }

    /**
     * @return int
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * @param int $y
     *
     * @return $this
     */
    public function setY($y)
    {
        $this->y = $y;

        return $this;
    }

    /**
     * @return int
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * @param int $z
     *
     * @return $this
     */
    public function setZ($z)
    {
        $this->z = $z;

        return $this;
    }

    /**
     * @return $this
     */
    public function getZ()
    {
        return $this->z;
    }

    /**
     * @param int $value
     *
     * @return $this
     */ 
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }
}
