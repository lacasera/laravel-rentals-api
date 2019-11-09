<?php

namespace Tests\Unit;

use App\Actions\Property\{
    BookProperty,
    FindProperty
};
use App\Exceptions\PropertyBookedException;
use App\Property;
use App\User;
use Tests\FeatureTestCase;

class BookPropertyTest extends FeatureTestCase
{
    /**
     * @test
     */
    public function it_should_book_a_property()
    {
        $user = factory(User::class)->create();

        $property = factory(Property::class)->create([
            'user_id' => $user->id,
            'published_at' => now()
        ]);

        $from = '1 October 2019';
        $to = '5 October 2019';

        $results = (new BookProperty(new FindProperty()))->execute($user->id, $property->id, $from, $to);

        $this->assertTrue($results);
    }

    /**
     * @test
     */
    public function it_should_throw_an_error_if_property_is_booked()
    {
        $this->expectException(PropertyBookedException::class);
        $user = factory(User::class)->create();

        $property = factory(Property::class)->create([
            'user_id' => $user->id,
            'published_at' => now(),
            'is_booked' => true
        ]);

        $from = '1 October 2019';
        $to = '5 October 2019';

        (new BookProperty(new FindProperty()))->execute($user->id, $property->id, $from, $to);
    }
}
