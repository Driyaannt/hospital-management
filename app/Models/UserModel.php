<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class UserModel extends Model
{
    use HasFactory, Notifiable;

    // Tentukan nama tabel secara manual
    protected $table = 'users'; // Ganti 'users' dengan nama tabel yang benar

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
    ];

    // Kolom yang harus disembunyikan
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
