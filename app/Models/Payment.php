<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['tenant_id', 'amount', 'payment_date', 'is_settled'];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
