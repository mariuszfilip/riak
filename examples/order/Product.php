<?php
/**
 * Date: 22.06.15
 * Time: 23:09
 *
 * @author Mariusz Filipkowski
 */
namespace order;
class Product{

    private $_id;
    private $_name;
    private $_price;

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
    public function pobierzPrice()
    {
        return $this->_price;
    }

    /**
     * @param mixed $price
     */
    public function ustawPrice($price)
    {
        $this->_price = $price;
    }



}
