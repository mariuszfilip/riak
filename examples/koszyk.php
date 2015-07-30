<?php
/**
 * Date: 22.06.15
 * Time: 23:03
 *
 * @author Mariusz Filipkowski
 */



require __DIR__ . '/../vendor/autoload.php';
use Basho\Riak;
use Basho\Riak\Node;
use Basho\Riak\Command;
class Customer{

    public $_id;
    public $_pesel;

    public $_name;
    public $_surname;

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
class Product{

    public $_id;
    public $_name;
    public $_price;

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
class Order{

    public $_id = 0;
    public $_products = array();
    public $_customer_id = 0;
    public $_order_date;

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



try{
    $node = (new Node\Builder)
        ->atHost('127.0.0.1')
        ->onPort(8098)
        ->build();
    $riak = new Riak([$node]);


    $oCustomer = new Customer();

    $oCustomer->ustawId(1);
    $oCustomer->ustawName("Mariusz");
    $oCustomer->ustawSurname("Filip");
    $oCustomer->ustawPesel("111111111");
    var_dump($oCustomer);
    // Creating Buckets
    $customersBucket = new Riak\Bucket('Customers');

    print('Location:' . PHP_EOL);
    // Storing Data
    $location = new Riak\Location('1', $customersBucket);
    $orderCustomer = (new Command\Builder\StoreObject($riak))
        ->buildJsonObject($oCustomer)
        ->atLocation($location)
        ->build();
    $orderCustomer->execute();
    // koniec zapis consumer
    print('koniec zapis:' . PHP_EOL);
    $oProduct = new Product();
    $oProduct->ustawId(1);
    $oProduct->ustawPrice(300);
    $oProduct->ustawName("Lapek");
    $aProducts = array();
    $aProducts[] = $oProduct;

    $oOrder = new Order();
    $oOrder->ustawCustomerId(1);
    $oOrder->ustawId(1);
    $oOrder->ustawOrderDate("2015-01-01");
    $oOrder->ustawProducts($aProducts);


    $orderBucket = new Riak\Bucket('Order');
    $loc = new Riak\Location($oOrder->pobierzId(),$orderBucket);
    $orderCustomer = (new Command\Builder\StoreObject($riak))
        ->buildJsonObject($oOrder)
        ->atLocation($loc)
        ->build();
    $orderCustomer->execute();

    print('pobierz dane:' . PHP_EOL);

    // Fetching related data by shared key
    $fetched_customer = (new Command\Builder\FetchObject($riak))
        ->atLocation(new Riak\Location(1, $customersBucket))
        ->build()->execute()->getObject()->getData();

    $fetched_customer->orderSummary =
        (new Command\Builder\FetchObject($riak))
            ->atLocation(new Riak\Location(1, $orderBucket))
            ->build()->execute()->getObject()->getData();

    print("Customer with OrderSummary data: \n");
    echo '<pre>';
    print_r($fetched_customer);
    echo '</pre>';
    // pokaz dane
}catch (Exception $e){
    var_dump($e->getMessage());
}