<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BedModel extends Model
{
    use HasFactory;

    protected $table = 'm_beds';
    protected $primaryKey = 'id';

    protected $fillable = [
        'category',
        'bed_number',
        'status'
    ];

    // Fungsi untuk mendapatkan bed yang kosong
    public static function getAvailableBeds()
    {
        return self::where('status', 'Available')->get();
    }
}
