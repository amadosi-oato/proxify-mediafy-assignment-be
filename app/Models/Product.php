<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'id',
        'feed_product_id',
        'sku',
        'name',
        'qty',
        'status',
        'visibility',
        'price',
        'type_id',
        'description',
        'image',
        'tags',
    ];

    protected $casts = [
        'visibility' => 'boolean',
        'tags' => 'array'
    ];
}
