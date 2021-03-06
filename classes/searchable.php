<?php

/**
 * Class searchable
 * @author Christophe Ferreboeuf <christophe@crealoz.fr>
 * This class is used to create objects that can be displayed in the search page
 */
abstract class searchable
{
    /**
     * This property is private
     * @var string
     */
    protected $_name;

    /**
     * @var string
     */
    protected $_description;

    /**
     * @var string
     */
    protected $_picture;

    /**
     * @var integer
     */
    protected $_score = 0;

    protected $_imgPath;

    /**
     * searchable constructor.
     * @param string $_name
     * @param string $_description
     * @param string $_picture
     */
    public function __construct($_name, $_description, $_picture, $_imgPath)
    {
        $this->_name = $_name;
        $this->_description = $_description;
        $this->_picture = $_picture;
        $this->_imgPath = $_imgPath;
    }


    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->_description;
    }

    /**
     * @param string $description
     * @return searchable
     */
    public function setDescription($description)
    {
        $this->_description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getPicture()
    {
        return $this->_picture;
    }

    /**
     * @param string $picture
     * @return searchable
     */
    public function setPicture($picture)
    {
        $this->_picture = $picture;
        return $this;
    }

    /**
     * @param string $name
     * @return searchable
     */
    public function setName($name)
    {
        $this->_name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->_name;
    }

    /**
     * @return int
     */
    public function getScore()
    {
        return $this->_score;
    }

    public function highlightResult($queryString){
        $this->_description = preg_replace('/('.$queryString.')/i', '<strong>'.$queryString.'</strong>', $this->_description, -1, $score);
        $this->_score += $score;
    }

    /**
     * @return mixed
     */
    public function getImgPath()
    {
        return $this->_imgPath;
    }

}
