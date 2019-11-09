<?php

namespace Tests\Feature;

use App\User;
use Laravel\Passport\Passport;
use Tests\Factories\PropertyFactory;
use Tests\FeatureTestCase;

class BookingTest extends FeatureTestCase
{
    private $propertyFactory;

    public function setUp(): void
    {
        parent::setUp();

        $this->propertyFactory = new PropertyFactory();
    }
    /**
     * @test
     */
    public function it_should_book_property()
    {
        $this->withoutExceptionHandling();

        $property = $this->propertyFactory->ownedBy()->published()->create()->all();

        $property = array_shift($property);

        $response = $this->post($this->endpoint."/properties/$property->id/book", [
            'from' => '1 October 2019',
            'to' => '3 October 2019'
        ]);

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function it_should_fail_if_from_date_is_greater_than_to()
    {
        $property = $this->propertyFactory->ownedBy()->published()->create()->all();

        $property = array_shift($property);

        $response = $this->post($this->endpoint."/properties/$property->id/book", [
            'from' => '4 October 2019',
            'to' => '3 October 2019'
        ]);

        $response->assertStatus(400);
    }

    /**
     * @test
     */
    public function it_should_fail_if_from_is_not_a_date()
    {
        $property = $this->propertyFactory->ownedBy()->published()->create()->all();

        $property = array_shift($property);

        $response = $this->post($this->endpoint."/properties/$property->id/book", [
            'from' => 'not a date',
            'to' => '3 October 2019'
        ]);

        $response->assertStatus(400);
    }

    /**
     * @test
     */
    public function it_should_fail_if_to_is_not_a_date()
    {
        $property = $this->propertyFactory->ownedBy()->published()->create()->all();

        $property = array_shift($property);

        $response = $this->post($this->endpoint."/properties/$property->id/book", [
            'from' => '1 October 2019',
            'to' => 'not a date'
        ]);

        $response->assertStatus(400);
    }

    /**
     * @test
     */
    public function it_should_fail_if_from_is_not_passed()
    {
        $property = $this->propertyFactory->ownedBy()->published()->create()->all();

        $property = array_shift($property);

        $response = $this->post($this->endpoint."/properties/$property->id/book", [
            'to' => '3 October 2019'
        ]);

        $response->assertStatus(400);
    }

    /**
     * @test
     */
    public function it_should_fail_if_to_is_a_passed()
    {
        $property = $this->propertyFactory->ownedBy()->published()->create()->all();

        $property = array_shift($property);

        $response = $this->post($this->endpoint."/properties/$property->id/book", [
            'from' => '3 October 2019'
        ]);

        $response->assertStatus(400);
    }
}
