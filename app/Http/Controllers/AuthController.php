<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Kullanıcı kaydı
     */
    public function register(RegisterRequest $request)
    {
        // Laravel doğrulama başarılı olursa burada devam edilir
        try {
            // Kullanıcıyı kaydet
            $user = $this->authService->register($request->validated());

            // Başarı durumu
            return response()->json(['user' => $user], 201);
        } catch (\Exception $e) {
            // Hata durumunda yanıt döndür
            return response()->json(['message' => 'Registration failed: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Kullanıcı girişi
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            // Giriş başarılıysa token oluştur
            $token = $this->authService->login($credentials);

            return response()->json(['token' => $token]);
        } catch (ValidationException $e) {
            // Bu doğrulama hatası olduğu için, burada yakalanır ve uygun yanıt döner.
            return response()->json(['message' => 'Invalid credentials.'], 401);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }

    /**
     * Kullanıcı çıkışı
     */
    public function logout(Request $request)
    {
        $this->authService->logout($request->user());

        return response()->json(['message' => 'Successfully logged out']);
    }
}
