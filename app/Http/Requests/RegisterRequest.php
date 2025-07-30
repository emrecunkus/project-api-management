<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Kullanıcıların bu isteği yapmaya izin verilip verilmediğini kontrol eder.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true; // Herkese izin veriyoruz
    }

    /**
     * İstek verileri için doğrulama kuralları.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email|max:255',
            'password' => 'required|string|confirmed|min:8',
            'role' => 'required|string|in:admin,customer',
        ];
    }

    /**
     * Hata mesajlarını özelleştir.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Adınız gerekli.',
            'email.required' => 'E-posta adresiniz gerekli.',
            'email.email' => 'Lütfen geçerli bir e-posta adresi girin.',
            'email.unique' => 'Bu e-posta adresi zaten kayıtlı.',
            'password.required' => 'Şifreniz gerekli.',
            'password.confirmed' => 'Şifreniz eşleşmiyor.',
            'password.min' => 'Şifreniz en az 8 karakter olmalıdır.',
            'role.required' => 'Rolünüz gerekli.',
            'role.in' => 'Geçerli bir rol seçmelisiniz: admin veya customer.',
        ];
    }
}
