<?php


class stalkerError
{
    private $type;
    private $message;
    private $log;

    /**
     * error constructor.
     * @param $type
     * @param $message
     * @param $log
     */
    public function __construct($type, $message, $log=false)
    {
        $this->type = $type;
        $this->message = $message;
        $this->log = $log;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }



}