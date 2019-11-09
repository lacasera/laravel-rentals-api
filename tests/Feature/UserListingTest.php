<?php

namespace Tests\Feature;

use App\User;
use Tests\FeatureTestCase;
use Tests\Factories\PropertyFactory;

class UserListingTest extends FeatureTestCase
{
    protected $propertyFactory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->propertyFactory = new PropertyFactory();
    }

    /**
     * @test
     */
    public function it_should_return_property_listings_belonging_to_a_user()
    {
        $user = factory(User::class)->create();

         $this->propertyFactory->ownedBy($user)->published()->create(3, true);

        $response = $this->get('/api/v1/me/listings');

        $this->assertEquals( $response->json('results')[0]['user_id'], $user->id);
    }
}
