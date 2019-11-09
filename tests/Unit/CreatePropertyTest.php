<?php

namespace Tests\Unit;

use App\Actions\Property\CreateProperty;
use Illuminate\Support\Arr;
use Tests\Factories\PropertyFactory;
use Tests\FeatureTestCase;
use Tests\TestCase;

class CreatePropertyTest extends FeatureTestCase
{
    private $propertyFactory;

    private $createPropertyAction;

    public function setUp():void
    {
        parent::setUp();

        $this->propertyFactory = new PropertyFactory();

        $this->createPropertyAction = new CreateProperty();
    }

    /**
     * @test
     */
    public function it_should_save_property_with_images()
    {
        $property = $this->propertyFactory->ownedBy()->withImages()->create(false);

        $results = $this->createPropertyAction->execute(array_shift($property))->toArray();

        $propertyImages = Arr::pull($results, 'images');

        $savedProperty = Arr::except($results, 'images');

        $this->assertDatabaseHas('images', $propertyImages->toArray()[0]);
        $this->assertDatabaseHas('properties', Arr::except($savedProperty, 'features'));
    }
}
