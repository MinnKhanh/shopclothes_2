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
        if ($quantity > 0) {
            $oldquantity = 0;
            $newProduct = ['productInfo' => $product, 'price' => 0, 'quantity' => 0, 'inventoryNumber' => $product['quantity']];
            if ($this->products) {
                if (array_key_exists($id . '_' . $product['idsize'], $this->products)) {
                    $newProduct = $this->products[$id . '_' . $product['idsize']];
                    $this->totalMoney -= floatval($this->products[$id . '_' . $product['idsize']]['price']);
                    $this->totalQuantity -= floatval($this->products[$id . '_' . $product['idsize']]['quantity']);
                    $oldquantity = floatval($this->products[$id . '_' . $product['idsize']]['quantity']);
                }
            }
            $newProduct['quantity'] += $quantity;
            if ($newProduct['quantity'] > $product['quantity']) {
                $newProduct['quantity'] = $product['quantity'];
            }
            $newProduct['price'] = $newProduct['quantity'] * $product['price'];
            $this->products[$id . '_' . $product['idsize']] = $newProduct;
            $this->totalMoney += $newProduct['price'];
            $this->totalQuantity += $newProduct['quantity'];
            //dd($oldquantity, $newProduct['quantity']);
            $this->updateQuantity($oldquantity, $newProduct['quantity'], $id, $product['idsize']);
        }
    }
    public function ChangeProduct($id, $quantity, $size)
    {
        if ($this->products) {
            if (array_key_exists($id . '_' . $size, $this->products)) {
                $oldquantity = 0;
                $this->totalMoney = $this->totalMoney - $this->products[$id . '_' . $size]['price'];
                $this->totalQuantity = $this->totalQuantity - $this->products[$id . '_' . $size]['quantity'];
                $oldquantity = $this->products[$id . '_' . $size]['quantity'];
                $this->products[$id . '_' . $size]['quantity'] += $quantity;
                if ($this->products[$id . '_' . $size]['quantity'] <= 0) {
                    unset($this->products[$id . '_' . $size]);
                    $this->updateQuantity($oldquantity, 0, $id, $size);
                } else {
                    if ($this->products[$id . '_' . $size]['quantity'] > $this->products[$id . '_' . $size]['inventoryNumber']) {
                        $this->products[$id . '_' . $size]['quantity'] = $this->products[$id . '_' . $size]['inventoryNumber'];
                    }

                    $this->products[$id . '_' . $size]['price'] = $this->products[$id . '_' . $size]['quantity'] * $this->products[$id . '_' . $size]['productInfo']['price'];
                    $this->totalMoney += $this->products[$id . '_' . $size]['price'];
                    $this->totalQuantity += $this->products[$id . '_' . $size]['quantity'];
                    $this->updateQuantity($oldquantity, $this->products[$id . '_' . $size]['quantity'], $id, $size);
                }
            }
        }
    }
    public function changeQuantityProduct($id, $quantity, $size)
    {

        if ($this->products) {
            if (array_key_exists($id . '_' . $size, $this->products)) {
                $oldquantity = 0;
                $this->totalMoney -= $this->products[$id . '_' . $size]['price'];
                $this->totalQuantity -= $this->products[$id . '_' . $size]['quantity'];
                $oldquantity = $this->products[$id . '_' . $size]['quantity'];
                $this->products[$id . '_' . $size]['quantity'] = $quantity;
                if ($this->products[$id . '_' . $size]['quantity'] <= 0) {
                    unset($this->products[$id . '_' . $size]);
                    $this->updateQuantity($oldquantity, 0, $id, $size);
                } else {
                    if ($this->products[$id . '_' . $size]['quantity'] > $this->products[$id . '_' . $size]['inventoryNumber']) {
                        $this->products[$id . '_' . $size]['quantity'] = $this->products[$id . '_' . $size]['inventoryNumber'];
                    }
                    $this->products[$id . '_' . $size]['price'] = $this->products[$id . '_' . $size]['quantity'] * $this->products[$id . '_' . $size]['productInfo']['price'];
                    $this->totalMoney += $this->products[$id . '_' . $size]['price'];
                    $this->totalQuantity += $this->products[$id . '_' . $size]['quantity'];
                    $this->updateQuantity($oldquantity, $this->products[$id . '_' . $size]['quantity'], $id, $size);
                }
                //dd($this->totalMoney); //, $this->products[$id . '_' . $size]['price']);
            }
        }
    }
    public function removeProductInCart($id, $size)
    {
        $this->totalMoney -= $this->products[$id . '_' . $size]['price'];
        $this->totalQuantity -= $this->products[$id . '_' . $size]['quantity'];
        $this->updateQuantity($this->products[$id . '_' . $size]['quantity'], 0, $id, $size);
        unset($this->products[$id . '_' . $size]);
    }
    public function removeCart()
    {
        foreach ($this->products as $item) {
            $this->updateQuantity($item['quantity'], 0, $item['productInfo']['idProductDetail'], $item['productInfo']['idsize']);
        }
    }
    public function updateQuantity($oldquantity, $newquanity, $id, $size)
    {
        $product = ProductSize::where('id_productdetail', $id)->where('size', $size)->first();
        $product->quantity = $product->quantity + $oldquantity - $newquanity;
        $product->save();

        dd($product);
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
