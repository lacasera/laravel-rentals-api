<?php

namespace App;

use Carbon\Carbon;
use App\Scopes\PublishedScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use SoftDeletes;

    protected $guarded = [];

   protected $casts = [
      'features' => 'array',
      'created_at' => 'Datetime',
      'published_at' => 'Datetime'
   ];

   protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
   ];

   public function scopePublished($query)
   {
        return $query->where('published_at', '<>', null);
   }

   public function images()
   {
        return $this->hasMany(Image::class);
   }

    public function publish()
    {
        $this->attributes['published_at'] = now();

        return $this->save();
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function unpublish()
    {
        $this->attributes['published_at'] = null;

        return $this->save();
    }

    public function book($from, $to, $user_id)
    {
       $booking = Booking::create([
            'user_id' => $user_id,
            'property_id' => $this->attributes['id'],
            'start_date' => Carbon::parse($from)->timestamp,
            'end_date' => Carbon::parse($to)->timestamp
        ]);

       if ($booking) {
           $this->attributes['is_booked'] = true;
           return $this->save();
       }

       return false;
    }

}
