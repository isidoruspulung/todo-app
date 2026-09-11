<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    // Tambahkan baris ini untuk mengizinkan kolom-kolom tersebut diisi
    protected $fillable = [
        'title',
        'description',
        'is_completed',
        'completed_at',
    ];
}
