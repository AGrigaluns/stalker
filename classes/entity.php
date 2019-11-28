<?php


class entity extends searchable
{
    private $_type;

    /**
     * entity constructor.
     * @param $_name
     * @param $_description
     * @param $_picture
     * @param $_type
     */
    public function __construct($_name, $_description, $_picture, $_type)
    {
        parent::__construct($_name, $_description, $_picture);
        $this->_type = $_type;
    }


    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * @param mixed $type
     * @return entity
     */
    public function setType($type)
    {
        $this->_type = $type;
        return $this;
    }
}