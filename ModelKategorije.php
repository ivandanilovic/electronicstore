<?php
/**
 * Created by PhpStorm.
 * User: PHP
 * Date: 11/27/2017
 * Time: 7:29 PM
 */

class ModelKategorije
{
    private $naziv;
    private $id;

    public function __construct($id, $naziv)
    {
        $this->id=$id;
        $this->naziv=$naziv;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNaziv()
    {
        return $this->naziv;
    }

    /**
     * @param mixed $naziv
     */
    public function setNaziv($naziv)
    {
        $this->naziv = $naziv;
    }
}