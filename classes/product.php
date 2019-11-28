<?php


class product extends searchable
{
    private $_price;

    public function __construct($_name, $_description, $_picture, $_price)
    {
        parent::__construct($_name, $_description, $_picture);
        $this->_price = $_price;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->_price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->_price = $price;
    }
}