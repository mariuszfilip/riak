<?php
/**
 * Date: 22.06.15
 * Time: 23:07
 *
 * @author Mariusz Filipkowski
 */
namespace order;
class Customer{

    private $_id;
    private $_pesel;

    private $_name;
    private $_surname;

    /**
     * @return mixed
     */
    public function pobierzId()
    {
        return $this->_id;
    }

    /**
     * @param mixed $id
     */
    public function ustawId($id)
    {
        $this->_id = $id;
    }

    /**
     * @return mixed
     */
    public function pobierzPesel()
    {
        return $this->_pesel;
    }

    /**
     * @param mixed $pesel
     */
    public function ustawPesel($pesel)
    {
        $this->_pesel = $pesel;
    }

    /**
     * @return mixed
     */
    public function pobierzName()
    {
        return $this->_name;
    }

    /**
     * @param mixed $name
     */
    public function ustawName($name)
    {
        $this->_name = $name;
    }

    /**
     * @return mixed
     */
    public function pobierzSurname()
    {
        return $this->_surname;
    }

    /**
     * @param mixed $surname
     */
    public function ustawSurname($surname)
    {
        $this->_surname = $surname;
    }



}

