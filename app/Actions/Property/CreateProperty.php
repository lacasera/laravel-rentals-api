<?php
/**
 * Created by PhpStorm.
 * User: lacasera
 * Date: 10/28/19
 * Time: 1:03 PM
 */
namespace App\Actions\Property;

use App\Property;
use Illuminate\Support\Arr;

class CreateProperty
{

    public function execute(array $details): Property
    {
        $data = Arr::except($details,'publish');

        $data = Arr::add($data, 'user_id',  auth()->id());

        if ($details['publish']) {
            $data = Arr::add($data, 'published_at', now());
        }

        $propertyImages = Arr::pull($data, 'images');

        $property = Property::create($data);

        $images = $property->images()->createMany($propertyImages);

        $property->images = $images;

        return $property;
    }
}