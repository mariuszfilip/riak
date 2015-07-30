<?php
/**
 * Date: 22.06.15
 * Time: 23:09
 *
 * @author Mariusz Filipkowski
 */
namespace order;
class Order{

    private $_id = 0;
    private $_products = array();
    private $_customer_id = 0;
    private $_order_date;

    /**
     * @return int
     */
    public function pobierzId()
    {
        return $this->_id;
    }

    /**
     * @param int $id
     */
    public function ustawId($id)
    {
        $this->_id = $id;
    }

    /**
     * @return array
     */
    public function pobierzProducts()
    {
        return $this->_products;
    }

    /**
     * @param array $products
     */
    public function ustawProducts($products)
    {
        $this->_products = $products;
    }

    /**
     * @return int
     */
    public function pobierzCustomerId()
    {
        return $this->_customer_id;
    }

    /**
     * @param int $customer_id
     */
    public function ustawCustomerId($customer_id)
    {
        $this->_customer_id = $customer_id;
    }

    /**
     * @return mixed
     */
    public function pobierzOrderDate()
    {
        return $this->_order_date;
    }

    /**
     * @param mixed $order_date
     */
    public function ustawOrderDate($order_date)
    {
        $this->_order_date = $order_date;
    }



}

