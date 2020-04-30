<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Product as ProductResource;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Interfaces\ProductInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Validator;

class ProductController extends BaseController
{

    /**
     * Interface de produto
     *
     * @var ProductInterface
     */
    private $productInterface;

    /**
     * Construtor da classe
     *
     * @param ProductInterface $product
     */
    public function __construct(ProductInterface $productInterface)
    {
        $this->productInterface = $productInterface;
    }

    /**
     * Retorna todos os produtos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $products = $this->productInterface->getProducts();

            return $this->sendResponse(ProductResource::collection($products), 'Products retrieved successfully.');
        } catch (Exception $e) {
            Log::critical('Falha na API ao retornas os produto: ' . $e->getMessage());
            $this->sendError('Desculpe algo deu errado', [], 500);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $input = $request->all();

            $validator = Validator::make($input, [
                'name' => 'required|string',
                'price' => 'required|numeric|between:0,99999999',
                'quantity' => 'required|between:1,99999',
                'description' => 'required'
            ]);

            if($validator->fails()){
                return $this->sendError('Erro de validação.', $validator->errors());
            }

            $product = $this->productInterface->insertProduct($input);

            return $this->sendResponse(new ProductResource($product), 'Product created successfully.');
        } catch (Exception $e) {
            Log::critical('Falha na API ao inserir produto: ' . $e->getMessage());
            $this->sendError('Desculpe algo deu errado', [], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->productInterface->getProduct($id);

        if (is_null($product)) {
            return $this->sendError('Product not found.');
        }

        return $this->sendResponse(new ProductResource($product), 'Product retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        try {
            $this->productInterface->deleteProduct($id);

            return $this->sendResponse([], 'Product deleted successfully.');
        } catch (Exception $e) {
            Log::critical('Falha na API ao deletar produto: ' . $e->getMessage());
            $this->sendError('Desculpe algo deu errado', [], 500);
        }
    }
}
