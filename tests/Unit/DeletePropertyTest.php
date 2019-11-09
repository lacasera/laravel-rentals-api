<?php

namespace Tests\Unit;

use App\User;
use App\Property;
use Tests\TestCase;
use App\Actions\Property\{
    FindProperty,
    DeleteProperty
};
use Illuminate\Support\Facades\Event;

class DeletePropertyTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_delete_a_property()
    {
        Event::fake();

        $property = factory(Property::class)->create([
            'user_id' => factory(User::class)->create()->id,
            'published_at' => now()
        ]);

        $result = (new DeleteProperty( new FindProperty()))->execute($property->id);

        $this->assertTrue($result);
    }
}
