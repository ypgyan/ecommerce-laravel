<?php

namespace App\Http\Controllers\Admin;

use App\Services\UserService;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Serviço de usuário
     *
     * @var UserService
     */
    private $service;

    /**
     * Construtor da classe
     *
     * @param UserService $userService
     * @return void
     */
    public function __construct(UserService $userService)
    {
        $this->service = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $users = $this->service->getUsers();
            return view('admin.user.user-grid', compact('users'));
        } catch (Exception $e) {
            Log::critical('Falha ao acessar user index: ' . $e->getMessage());
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
            return view('admin.user.create-user');
        } catch (Exception $e) {
            Log::critical('Falha ao acessar user create: ' . $e->getMessage());
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
            'user_name' => 'required|string',
            'cpf' => 'required|unique:users|max:11',
            'user_type' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:6|same:password2',
            'password2' => 'required|min:6'
        ]);

        try {
            $this->service->insertUser($validatedData);
            return redirect()->route('user.index')->withSuccess('Usuário criado com sucesso');
        } catch (Exception $e) {
            Log::critical('Falha ao criar usuário : ' . $e->getMessage());
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $user = $this->service->getUser($id);
            return view('admin.user.user-edit', compact('user'));
        } catch (Exception $e) {
            Log::critical('Falha ao acessar a edição de usuário: ' . $e->getMessage());
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
        //
    }
}
