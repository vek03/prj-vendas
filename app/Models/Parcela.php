<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parcela extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];
    public $timestamps = false;

    protected $fillable = [
        'id_sale',
        'num',
        'invoice',
        'value',
    ];


    public function sale(): BelongsTo
    {
        return $this->BelongsTo(Venda::class, 'id_sale');
    }
}
