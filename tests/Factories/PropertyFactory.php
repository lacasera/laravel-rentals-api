<?php
/**
 * Created by PhpStorm.
 * User: lacasera
 * Date: 10/22/19
 * Time: 4:48 PM
 */
namespace Tests\Factories;

use App\Image;

use App\Property;
use App\User;

use Laravel\Passport\Passport;

class PropertyFactory
{
    protected $count;

    protected $images = null;

    protected $user = null;

    protected $publish = false;

    protected $isBooked = false;

    public function ownedBy($user = null)
    {
        $this->user = $user ?? factory(User::class)->create();

        Passport::actingAs($this->user);

        return $this;
    }

    public function withImages($count = 1)
    {
        $this->images = factory(Image::class, $count)->raw();

        return $this;
    }

    public function published()
    {
        $this->publish = true;

        return $this;
    }

    public function booked($isBooked = false)
    {
        $this->isBooked = $isBooked;

        return $this;
    }

    public function create($persist = true, $count =  1)
    {
        $method = $persist ? 'create' : 'raw';

        $overrides = [];

        $overrides['is_booked'] = $this->isBooked;

        if ($this->user) {
            $overrides['user_id'] = $this->user->id;
        }

        if ($persist) {
            $overrides['published_at'] = now() ;
        } else {
            $overrides['publish'] = $this->publish;
        }

        if (isset($this->images)) {
            $overrides['images'] = $this->images;
        }

        return factory(Property::class, $count)->{$method}($overrides);
    }
}