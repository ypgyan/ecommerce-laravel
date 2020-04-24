<?php

namespace App\Services;

use App\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;

class UserService
{
    /**
     * Retorna todos os usuários
     *
     * @return Collection
     */
    public function getUsers()
    {
        try {
            $users = User::paginate(10);
            return $users;
        } catch (QueryException $q) {
            Log::critical('Falha em getUsers: ' . $q->getMessage());
        } catch (Exception $e) {
            Log::critical('Falha em getUsers: ' . $e->getMessage());
        }
    }

    /**
     * Retorna o usuário pelo ID
     *
     * @param integer $id
     * @return User
     */
    public function getUser(int $id)
    {
        try {
            $user = User::where('id', $id)->first();
            return $user;
        } catch (QueryException $q) {
            Log::critical('Falha em getUser: ' . $q->getMessage());
        } catch (Exception $e) {
            Log::critical('Falha em getUser: ' . $e->getMessage());
        }
    }

    /**
     * Insere o usuário
     *
     * @param Array $userData
     * @return void
     */
    public function insertUser(Array $userData): void
    {
        try {
            $user = new User();
            $user->name = $userData['user_name'];
            $user->email = $userData['email'];
            $user->password = Hash::make($userData['password']);
            $user->cpf = $userData['cpf'];
            $user->user_type = $userData['user_type'];

            $user->save();
        } catch (QueryException $q) {
            Log::critical('Falha em insertUser: ' . $q->getMessage());
        } catch (Exception $e) {
            Log::critical('Falha em insertUser: ' . $e->getMessage());
        }
    }

    /**
     * Update the user
     *
     * @param Array $userData
     * @param integer $id
     * @return void
     */
    public function updateUser(Array $userData, int $id): void
    {
        try {
            $user = User::where('id', $id)->first();
            $user->name = $userData['user_name'];
            $user->cpf = $userData['cpf'];
            $user->user_type = $userData['user_type'];

            $user->save();
        } catch (QueryException $q) {
            Log::critical('Falha em updateUser: ' . $q->getMessage());
        } catch (Exception $e) {
            Log::critical('Falha em updateUser: ' . $e->getMessage());
        }
    }

    /**
     * Deleta o usuário
     *
     * @param integer $userId
     * @return void
     */
    public function deleteUser(int $userId): void
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
