<?php
declare(strict_types=1);
error_reporting(E_ALL);
ini_set('display_errors','1');

class ProductIdException extends Exception{
    protected $code = 404;
    protected $message = 'Can\'t find product';
}
class ProductIdExists extends ProductIdException {
    protected $code = 404;
    protected $message = 'ID already exists';
}

class Product{
    private $id;
    private $name;
    private $description;
    public function setId($id){
        $this->id = $id;
    }
    public function setName($name){
        $this->name = $name;
    }
    public function setDecsription($description = ''){
        $this->description = $description;
    }
    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }
    public function getDescription(){
        return $this->description;
    }
}
function getProduct(int $id){
    $productsDecode = json_decode(file_get_contents('db1.txt'), true);
    if(checkProduct($id) == false){
        foreach ($productsDecode as $product){
            if($product['id']==$id){
                print_r($product['name']);
            }
        }
    }elseif(checkProduct($id)==true){
        throw new ProductIdException();
    }
}
function checkProduct(int $id){
    $productsDecode = json_decode(file_get_contents('db1.txt'), true);
    $flag = true;
    foreach ($productsDecode as $product) {
        if ($product['id'] === $id) {
            $flag = false;
        }
    }
    return $flag;
}
function setProduct(Product $product,int $id,string $name, string $desctiption){
        if(checkProduct($id) == false){
            throw new ProductIdExists();
        }elseif(checkProduct($id) == true){
        $product->setId($id);
        $product->setName($name . $product->getId());
        $product->setDecsription($desctiption);
        $arr = ['id' => $product->getId(),
            'name' => $product->getName(),
            'description' => $product->getDescription()];
        $file = file_get_contents('db1.txt');
        $tempArray = json_decode($file);
        array_push($tempArray, $arr);
        $jsonData = json_encode($tempArray);
        file_put_contents('db1.txt', $jsonData);
        }
}
$product = new Product();


try{
    //setProduct($product,107,'Phone','');
    getProduct(108);
} catch (ProductIdExists $exception) {
    print_r($exception->getMessage());
    print_r("<br>");
    print_r('ProductIdExists');
}catch (ProductIdException $exception){
    print_r($exception->getMessage());
    print_r("<br>");
    print_r('ProductIdException');
} catch (Exception $exception) {
    print_r('Exception');
}
