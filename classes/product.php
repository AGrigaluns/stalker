<?php


class product extends searchable
{
    private $_price;

    public function __construct($_name, $_description, $_picture, $_price = 0)
    {
        parent::__construct($_name, $_description, $_picture, "shop");
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