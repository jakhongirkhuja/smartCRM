<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Ticket extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $fillable = [
        'customer_id',
        'theme',
        'message',
        'status',
        'reply_at',
        'user_id'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getStatusChangeAttribute()
    {
        if ($this->status === 'new') {
            return 'Новая';
        } elseif ($this->status === 'progress') {
            return 'В работе';
        } elseif ($this->status === 'done') {
            return 'Обработана';
        }
        return $this->status;
    }
}
