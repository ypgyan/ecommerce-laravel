<?php

namespace App\Http\Controllers\Admin;

use App\Services\ProductService;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Serviço de usuário
     *
     * @var ProductService
     */
    private $service;

    /**
     * Construtor da classe
     *
     * @param ProductService $productService
     * @return void
     */
    public function __construct(ProductService $productService)
    {
        $this->service = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $products = $this->service->getProducts();
            return view('admin.product.product-grid', compact('products'));
        } catch (Exception $e) {
            Log::critical('Falha ao acessar product index: ' . $e->getMessage());
            return redirect()->back()->withErrors("Falha ao acessar a área de usuários");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            return view('admin.product.product-create');
        } catch (Exception $e) {
            Log::critical('Falha ao acessar product create: ' . $e->getMessage());
            return redirect()->back()->withErrors("Desculpe Alguma coisa deu errado!");
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
        $validatedData = $request->validate([
            'name' => 'required|string',
            'price' => 'required|between:0,99999999',
            'quantity' => 'required|between:1,99999',
            'description' => 'required'
        ]);

        try {
            $this->service->insertProduct($validatedData);
            return redirect()->route('product.index')->withSuccess('Produto criado com sucesso');
        } catch (Exception $e) {
            Log::critical('Falha ao criar produto : ' . $e->getMessage());
            return redirect()->back()->withErrors("Desculpe algo deu errado");
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $product = $this->service->getProduct($id);
            return view('admin.product.product-edit', compact('product'));
        } catch (Exception $e) {
            Log::critical('Falha ao acessar a edição de produto: ' . $e->getMessage());
            return redirect()->back()->withErrors('Desculpe algo deu errado');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $userData = $request->validate([
            'user_name' => 'required|string',
            'cpf' => 'required|max:11',
            'user_type' => 'required'
        ]);

        try {
            $this->service->updateUser($userData, $id);
            return redirect()->route('user.index')->withSuccess('User updated succesfully');
        } catch (Exception $e) {
            Log::warning('Falha ao atualizar usuário: ' . $e->getMessage());
            return redirect()->back()->withErrors('Desculpe algo deu errado');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if ($this->service->validateProductOwner($id)) {
                $this->service->deleteProduct($id);
                return response()->json(['status' => 1], 200);
            }
            abort(403, 'Operação não autorizada');
        } catch (Exception $e) {
            Log::warning('Falha ao deletar usuário: ' . $e->getMessage());
            abort(500, 'Desculpe algo deu errado');
        }
    }
}
