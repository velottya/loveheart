<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultLatest extends Model
{
    use HasFactory;

    protected $table = 'form_diagnoses';

    protected $fillable = [
        'id', 'name', 'age', 'sex', 'RBP', 'MHR', 'CL', 'date', 'created_at', 'updated_at'
    ];
}
