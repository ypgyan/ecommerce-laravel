<?php

namespace App\Services;

use App\Models\Product;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ProductService
{
    /**
     * Retorna todos os produtos
     *
     * @return Collection
     */
    public function getProducts()
    {
        try {
            $products = Product::paginate(10);
            return $products;
        } catch (QueryException $q) {
            Log::critical('Falha em getProducts: ' . $q->getMessage());
        } catch (Exception $e) {
            Log::critical('Falha em getProducts: ' . $e->getMessage());
        }
    }

    /**
     * Retorna o produto pelo ID
     *
     * @param string $id
     * @return Product
     */
    public function getProduct(string $id)
    {
        try {
            $product = Product::where('id', $id)->first();
            return $product;
        } catch (QueryException $q) {
            Log::critical('Falha em getProduct: ' . $q->getMessage());
        } catch (Exception $e) {
            Log::critical('Falha em getProduct: ' . $e->getMessage());
        }
    }

    /**
     * Insere o produto
     *
     * @param Array $productData
     * @return void
     */
    public function insertProduct(Array $productData): void
    {
        try {
            $product = new Product();
            $product->id = Str::uuid();
            $product->user_id = Auth::user()->id;
            $product->name = $productData['name'];
            $product->quantity = $productData['quantity'];
            $product->price = $productData['price'];
            $product->description = $productData['description'];
            $product->status = $this->getProductStatus($productData['quantity']);

            $product->save();
        } catch (QueryException $q) {
            Log::critical('Falha em insertProduct: ' . $q->getMessage());
            throw $e;
        } catch (Exception $e) {
            Log::critical('Falha em insertProduct: ' . $e->getMessage());
            throw $e;
        }
    }


    /**
     * Deleta o produto
     *
     * @param string $productId
     * @return void
     */
    public function deleteProduct(string $productId): void
    {
        try {
            User::destroy($productId);
        } catch (QueryException $q) {
            Log::critical('Falha em deleteProduct: ' . $q->getMessage());
        } catch (Exception $e) {
            Log::critical('Falha em deleteProduct: ' . $e->getMessage());
        }
    }


    /**
     * Identifica o status do produto de acordo com a quantidade
     *
     * @param integer $quantity
     * @return string
     */
    public function getProductStatus(int $quantity): string
    {
        if ($quantity >= 20) {
            return 'in_stock';
        } elseif ($quantity == 0) {
            return 'out_of_stock';
        } else {
            return 'running_low';
        }
    }

    /**
     * Verifica se o usuário é o dono do produto
     *
     * @param string $productId
     * @return boolean
     */
    public function validateProductOwner(string $productId)
    {
        try {
            $product = Product::where('id', $productId)->first();

            if ($product->user_id == Auth::user()->id) {
                return true;
            } else {
                return false;
            }
        } catch (QueryException $q) {
            Log::critical('Falha em validateProductOwner: ' . $q->getMessage());
        } catch (Exception $e) {
            Log::critical('Falha em validateProductOwner: ' . $e->getMessage());
        }
    }
}
