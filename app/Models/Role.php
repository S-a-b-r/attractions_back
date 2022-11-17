<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected const ROLE_ADMIN = 1;
    protected const ROLE_USER = 2;
    use HasFactory;
}
