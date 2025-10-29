<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;

class Customer extends Model
{
    use HasFactory, HasRoles;
    protected $fillable = ['name', 'phone', 'email'];
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
