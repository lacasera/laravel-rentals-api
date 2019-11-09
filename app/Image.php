<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
   protected $guarded = [];

   protected $hidden = [
       'created_at',
       'updated_at',
       'property_id',
   ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
