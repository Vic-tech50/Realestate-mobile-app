<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = [
        'agent_id',
        'title',
        'type',
        'listing_type',
        'address',
        'city',
        'state',
        'price',
        'price_period',
        'property_id',
        'bedrooms',
        'bathrooms',
        'garage',
        'description',
        'thumbnail',
        'images',
        'status',
        'size',
        'is_featured',
        'video',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }
}
