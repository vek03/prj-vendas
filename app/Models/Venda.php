<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Venda extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id_seller',
        'id_client',
        'method',
    ];

    public function seller(): BelongsTo
    {
        return $this->BelongsTo(User::class, 'id_seller');
    }


    public function client(): BelongsTo
    {
        return $this->BelongsTo(Cliente::class, 'id_client');
    }


    public function items(): HasMany
    {
        return $this->HasMany(Item_Venda::class, 'id_sale');
    }


    public function payments(): HasMany
    {
        return $this->HasMany(Parcela::class, 'id_sale');
    }
}
