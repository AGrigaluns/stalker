<?php


class feed extends searchable
{
    public function __construct($_name, $_description, $_picture)
    {
        parent::__construct($_name, $_description, $_picture, "blog");
    }

}