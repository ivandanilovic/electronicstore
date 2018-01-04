<?php
/**
 * Created by PhpStorm.
 * User: PHP
 * Date: 11/20/2017
 * Time: 8:22 PM
 */

class Proizvod
{
    private $id;
    private $naziv;
    private $cena;
    private $akcijskacena;
    private $kolicina;
    private $kategorija;

    public function __construct($id, $naziv, $cena, $akcijskacena, $kolicina, $kategorija)
    {
        $this->id=$id;
        $this->naziv=$naziv;
        $this->kolicina=$kolicina;
        $this->cena=$cena;
        $this->akcijskacena=$akcijskacena;
        $this->kategorija=$kategorija;
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

    /**
     * @return mixed
     */
    public function getCena()
    {
        return $this->cena;
    }

    /**
     * @param mixed $cena
     */
    public function setCena($cena)
    {
        $this->cena = $cena;
    }

    /**
     * @return mixed
     */
    public function getAkcijskaCena()
    {
        return $this->akcijskacena;
    }

    /**
     * @param mixed $akcijskacena
     */
    public function setAkcijskaCena($akcijskacena)
    {
        $this->akcijskacena = $akcijskacena;
    }

    /**
     * @return mixed
     */
    public function getKolicina()
    {
        return $this->kolicina;
    }

    /**
     * @param mixed $kolicina
     */
    public function setKolicina($kolicina)
    {
        $this->kolicina = $kolicina;
    }

    /**
     * @return mixed
     */
    public function getKategorija()
    {
        return $this->kategorija;
    }

    /**
     * @param mixed $kategorija
     */
    public function setKategorija($kategorija)
    {
        $this->kategorija = $kategorija;
    }

}
