<?php

namespace Tests\Unit;

use App\User;
use App\Property;
use Tests\TestCase;
use App\Actions\Property\{FindProperty, PublishProperty};

class PublishPropertyTest extends TestCase
{

    /**
     * @test
     */
    public function it_should_unpublish_a_published_property()
    {
        $property = factory(Property::class)->create([
            'user_id' => factory(User::class)->create()->id,
            'published_at' => now()
        ]);

        $result = (new PublishProperty(new FindProperty()))->execute('published', $property->id);

        $this->assertEquals($result->published_at, null);
    }

    public function it_should_the_publish_an_unpulished_property()
    {
        $property = factory(Property::class)->create([
            'user_id' => factory(User::class)->create()->id,
            'published_at' => null
        ]);

        $result = (new PublishProperty(new FindProperty()))->execute('unpublished', $property->id);

        $this->assertTrue($result);
    }

}
