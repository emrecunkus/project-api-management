<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthService
{
    /**
     * Kullanıcı kaydını gerçekleştirir.
     *
     * @param array $data
     * @return User
     */
    public function register(array $data): User
    {
        // Şifreyi hash'le
        $data['password'] = Hash::make($data['password']);

        // Kullanıcıyı oluştur
        return User::create($data);
    }

    /**
     * Kullanıcı girişini gerçekleştirir.
     *
     * @param array $credentials
     * @return string|null
     */
    public function login(array $credentials): ?string
    {
        // Kullanıcıyı doğrula
        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        // Başarılı girişte API token oluştur
        $user = Auth::user();
        return $user->createToken('auth_token')->plainTextToken;
    }

    /**
     * Kullanıcı çıkışını gerçekleştirir.
     *
     * @param User $user
     * @return void
     */
    public function logout(User $user)
    {
        $user->tokens->each(function ($token) {
            $token->delete();
        });
    }
}
