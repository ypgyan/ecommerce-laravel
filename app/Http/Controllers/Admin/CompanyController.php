<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CompanyService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CompanyController extends Controller
{
    /**
     * Serviço de empresas
     *
     * @var CompanyService
     */
    private $service;

    /**
     * Construtor da classe
     *
     * @param CompanyService $companyService
     * @return void
     */
    public function __construct(CompanyService $companyService)
    {
        $this->service = $companyService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $company = $this->service->getUserCompany(Auth::user()->id);
            if(!empty($company)) {
                return redirect()->route('company.edit', [$company->id]);
            }else{
                return redirect()->route('company.create');
            }
        } catch (Exception $e) {
            Log::critical('Falha ao acessar company index: ' . $e->getMessage());
            return redirect()->back()->withErrors("Algo deu errado =(");
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
            return view('admin.company.company-create');
        } catch (Exception $e) {
            Log::critical('Falha ao acessar a tela de criação de empresa: ' . $e->getMessage());
            return redirect()->route('home')->withErrors("Algo deu errado =(");
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
            'name' => 'required|string|min:3',
            'email' => 'required|unique:companies',
            'cnpj' => 'required|unique:companies|min:14|max:14',
            'description' => 'required',
            'company_type' => 'required'
        ]);

        try {
            $company = $this->service->insertCompany($validatedData);
            return redirect()->route('company.edit', [$company->id])->withSuccess('Empresa criada com sucesso');
        } catch (Exception $e) {
            Log::critical('Falha na criação de empresa: ' . $e->getMessage());
            return redirect()->route('home')->withErrors("Algo deu errado =(");
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
            $company = $this->service->getCompany($id);
            return view('admin.company.company-edit', compact('company'));
        } catch (Exception $e) {
            Log::critical('Falha ao acessar a tela de edição de empresa: ' . $e->getMessage());
            return redirect()->route('home')->withErrors("Algo deu errado =(");
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
        $validatedData = $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|string',
            'cnpj' => 'required|min:14|max:14',
            'description' => 'required',
            'company_type' => 'required'
        ]);

        try {
            $this->service->updateCompany($validatedData, $id);
            return redirect()->route('company.edit', [$id])->withSuccess('Empresa atualziada com sucesso');
        } catch (Exception $e) {
            Log::critical('Falha ao atualizar empresa: ' . $e->getMessage());
            return redirect()->route('home')->withErrors("Algo deu errado =(");
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

    /**
     * Grid com todas as Empresas cadastradas
     *
     * @return void
     */
    public function listCompanies()
    {
        try {
            $companies = $this->service->getCompanies();
            return view('admin.company.company-grid', compact('companies'));
        } catch (Exception $e) {
            Log::critical('Falha ao atualizar empresa: ' . $e->getMessage());
            return redirect()->route('home')->withErrors("Algo deu errado =(");
        }
    }
}
