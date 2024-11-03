<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class UserAuthVerifyRequest extends FormRequest
{
    /**
     * Menentukan apakah pengguna diizinkan untuk melakukan permintaan ini.
     * Mengembalikan true berarti semua pengguna diizinkan.
     */
    public function authorize(): bool
    {
        return true; // Mengizinkan semua pengguna untuk mengakses permintaan ini
    }

    /**
     * Mendapatkan aturan validasi yang berlaku untuk permintaan ini.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Mengembalikan array aturan validasi untuk username dan password
        return [
            'username' => 'required',
            'password' => 'required',
        ];
    }
}
