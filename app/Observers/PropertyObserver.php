<?php

namespace App\Observers;

use App\Image;
use App\Property;
use App\Services\CDN\CdnInterface;
use Illuminate\Database\Eloquent\Collection;

class PropertyObserver
{
    protected $cdn;

    public function __construct(CdnInterface $cdn)
    {
        $this->cdn = $cdn;
    }

    /**
     * Handle the property "deleted" event.
     *
     * @param  \App\Property  $property
     * @return void
     */
    public function deleted(Property $property)
    {
        $propertyImages =  Image::where('property_id', $property->id)->get()->cloudinaryIds();

        return $this->cdn->delete($propertyImages);
    }

}
