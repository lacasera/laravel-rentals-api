<?php

namespace Tests\Unit;

use App\User;
use App\Property;
use Tests\TestCase;
use Tests\Factories\PropertyFactory;
use App\Actions\Property\FindProperty;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FindPropertyTest extends TestCase
{

    /**
     * @test
     */
    public function it_should_find_a_property_by_id()
    {
        $property = factory(Property::class)->create([
            'user_id' => factory(User::class)->create()->id,
            'published_at' => now()
        ]);


        $results = (new FindProperty())->execute($property->id)->toArray();

        $this->assertEquals($results['id'], $property->id);
    }

    /**
     * @test
     */
    public function it_should_throw_an_error_if_property_is_not_found()
    {
        $this->expectException(ModelNotFoundException::class);
        $this->expectExceptionMessage('No query results for model [App\Property] 200');

        (new FindProperty())->execute(200)->toArray();
    }

    /**
     * @test
     */
    public function it_should_get_all_properties()
    {
        $propertyFactory = new PropertyFactory();

        $propertyFactory->ownedBy()->create(true, 3)->toArray();

        $properties = (new FindProperty())->execute()->toArray();

        $this->assertCount(3, $properties);
    }
}
