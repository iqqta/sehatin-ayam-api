<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Pesan Validasi
    |--------------------------------------------------------------------------
    |
    | Hanya berisi validasi yang benar-benar digunakan di aplikasi ini.
    |
    */

    // Validasi yang digunakan
    'required' => 'Kolom :attribute wajib diisi.',
    'exists' => ':attribute yang dipilih tidak valid.',
    'unique' => ':attribute sudah digunakan.',
    'numeric' => 'Kolom :attribute harus berupa angka.',
    'string' => 'Kolom :attribute harus berupa teks.',
    'between' => [
        'numeric' => 'Kolom :attribute harus antara :min sampai :max.',
    ],
    'max' => [
        'numeric' => 'Kolom :attribute tidak boleh lebih besar dari :max.',
    ],
    'min' => [
        'numeric' => 'Kolom :attribute harus setidaknya :min.',
    ],
    'lte' => [
        'numeric' => 'Kolom :attribute harus kurang dari atau sama dengan :value.',
    ],
    'gte' => [
        'numeric' => 'Kolom :attribute harus lebih besar dari atau sama dengan :value.',
    ],

    /*
    |--------------------------------------------------------------------------
    | Nama Atribut
    |--------------------------------------------------------------------------
    |
    | Digunakan untuk mengganti nama field dengan yang lebih ramah pengguna.
    |
    */

    'attributes' => [
        'code' => 'kode',
        'name' => 'nama',
        'description' => 'deskripsi',
        'disease_id' => 'penyakit',
        'symptom_id' => 'gejala',
        'mb' => 'MB',
        'md' => 'MD',
        'treat' => 'penanganan',
    ],

];

