<?php

namespace App\Services;

use App\Models\Company;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;

class CompanyService
{
    /**
     * Retorna a empresa pelo ID
     *
     * @param integer $id
     * @return Company
     */
    public function getCompany(int $id)
    {
        try {
            $company = Company::where('id', $id)->first();
            return $company;
        } catch (QueryException $q) {
            Log::critical('Falha em getCompany: ' . $q->getMessage());
        } catch (Exception $e) {
            Log::critical('Falha em getCompany: ' . $e->getMessage());
        }
    }

    /**
     * Undocumented function
     *
     * @param integer $userId
     * @return boolean
     */
    public function getUserCompany(int $userId)
    {
        try {
            $company = Company::where('user_id', $userId)->first();
            return $company;
        } catch (QueryException $q) {
            Log::critical('Falha em getUserCompany: ' . $q->getMessage());
        } catch (Exception $e) {
            Log::critical('Falha em getUserCompany: ' . $e->getMessage());
        }
    }

    /**
     * Insere a empresa
     *
     * @param Array $companyData
     * @return Company
     */
    public function insertCompany(Array $companyData)
    {
        try {
            $company = new Company();
            $company->user_id = Auth::user()->id;
            $company->name = $companyData['name'];
            $company->cnpj = $companyData['cnpj'];
            $company->description = $companyData['description'];
            $company->company_type = $companyData['company_type'];

            $company->save();
            return $company;
        } catch (QueryException $q) {
            Log::critical('Falha em insertCompany: ' . $q->getMessage());
        } catch (Exception $e) {
            Log::critical('Falha em insertCompany: ' . $e->getMessage());
        }
    }

    /**
     * Atualiza a Empresa
     *
     * @param Array $userData
     * @param integer $id
     * @return void
     */
    public function updateCompany(Array $companyData, int $id): void
    {
        try {
            $user = Company::where('id', $id)->first();
            $company->name = $companyData['name'];
            $company->description = $companyData['description'];
            $company->company_type = $companyData['company_type'];

            $user->save();
        } catch (QueryException $q) {
            Log::critical('Falha em updateCompany: ' . $q->getMessage());
        } catch (Exception $e) {
            Log::critical('Falha em updateCompany: ' . $e->getMessage());
        }
    }

    /**
     * Deleta a Empresa
     *
     * @param integer $userId
     * @return void
     */
    public function deleteCompany(int $userId): void
    {
        try {
            User::destroy($userId);
        } catch (QueryException $q) {
            Log::critical('Falha em deleteUser: ' . $q->getMessage());
        } catch (Exception $e) {
            Log::critical('Falha em deleteUser: ' . $e->getMessage());
        }
    }
}
