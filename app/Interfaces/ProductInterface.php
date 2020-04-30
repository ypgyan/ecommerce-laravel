<?php

namespace App\Interfaces;

interface ProductInterface {
    public function getProducts();
    public function getProduct(string $productId);
    public function insertProduct(array $productData);
    public function deleteProduct(string $productId);
    public function validateProductOwner(string $productId);
}
