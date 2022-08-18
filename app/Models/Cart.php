<?php

namespace App\Models;

class Cart
{
    public $products = null;
    public $totalMoney = 0;
    public $totalQuantity = 0;
    public function __construct($cart)
    {
        if ($cart) {
            $this->products = $cart->products;
            $this->totalMoney = $cart->totalMoney;
            $this->totalQuantity = $cart->totalQuantity;
        }
    }
    public function AddCart($product, $id, $quantity)
    {
        $newProduct = ['productInfo' => $product, 'price' => 0, 'quantity' => 0, 'inventoryNumber' => $product->quantity];
        if ($this->products) {
            if (array_key_exists($id, $this->products)) {
                $newProduct = $this->products[$id];
                $this->totalMoney -= $this->products[$id]['price'];
                $this->totalQuantity -= $this->products[$id]['quantity'];
            }
        }
        $newProduct['quantity'] += $quantity;
        if ($newProduct['quantity'] > $product->quantity) {
            $newProduct['quantity'] = $product->quantity;
        }
        $newProduct['price'] = $newProduct['quantity'] * $product->price;
        $this->products[$id] = $newProduct;
        $this->totalMoney += $newProduct['price'];
        $this->totalQuantity += $newProduct['quantity'];
    }
    public function ChangeProduct($id, $quantity)
    {
        if ($this->products) {
            if (array_key_exists($id, $this->products)) {
                $this->totalMoney -= $this->products[$id]['price'];
                $this->totalQuantity -= $this->products[$id]['quantity'];
                $this->products[$id]['quantity'] += $quantity;
                if ($this->products[$id]['quantity'] <= 0) {
                    $this->removeProductInCart($id);
                } else {
                    if ($this->products[$id]['quantity'] > $this->products[$id]['inventoryNumber']) {
                        $this->products[$id]['quantity'] = $this->products[$id]['inventoryNumber'];
                    }
                    $this->products[$id]['price'] = $this->products[$id]['quantity'] * $this->products[$id]['productInfo']->price;
                    $this->totalMoney += $this->products[$id]['price'];
                    $this->totalQuantity += $this->products[$id]['quantity'];
                }
            }
        }
    }
    public function removeProductInCart($id)
    {
        unset($this->products[$id]);
    }
    public function getTotalMoney()
    {
        return $this->totalMoney;
    }
    public function getTotalQuantity()
    {
        return $this->totalQuantity;
    }
    public function getProductInCart()
    {
        return $this->products;
    }
}
