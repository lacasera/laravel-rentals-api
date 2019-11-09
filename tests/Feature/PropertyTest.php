<?php

namespace Tests\Feature;

use App\Property;
use App\User;
use Tests\FeatureTestCase;
use Tests\Factories\PropertyFactory;
use Illuminate\Support\Facades\Event;

class PropertyTest extends FeatureTestCase
{
    private $propertyFactory;

    public function setUp(): void
    {
        parent::setUp();

        $this->propertyFactory = new PropertyFactory();
    }
    /**
     * @test
     *
     * @return void
     */
    public function user_can_add_a_property()
    {
        $property = $this->propertyFactory->ownedBy()->withImages(3)->create(false);

        $response = $this->post($this->endpoint.'/properties', array_shift($property));

        $response->assertStatus(201);

        $this->assertEquals('success',   $response->json()['status']);

        $this->assertArrayHasKey('results', $response->json());
    }

    /**
     * @test
     */
    public function it_should_fail_if_an_unauthenticated_user_is_adding_a_property()
    {
        $this->withExceptionHandling();

        $property = $this->propertyFactory->withImages(3)->create(false);

        $property = array_shift($property);

        $response = $this->post($this->endpoint.'/properties', $property);

       $response->assertStatus(401);
    }

    /**
     * @test
     */
    public function it_should_fail_if_title_is_missing()
    {
        $property = $this->propertyFactory->ownedBy()->withImages()->create(false);

        $property['title'] = '';

        $response  = $this->post($this->endpoint.'/properties', $property);

        $this->assertEquals($response->status(), 400);
    }

    /**
     * @test
     */
    public function it_should_fail_if_price_is_missing()
    {
        $property = $this->propertyFactory->ownedBy()->withImages()->create(false);

        $property['price'] = '';

        $response  = $this->post($this->endpoint.'/properties', $property);

        $this->assertEquals($response->status(), 400);
    }

    /**
     * @test
     */
    public function it_should_fail_if_pricing_frequency_is_missing()
    {
        $property = $this->propertyFactory->ownedBy()->withImages()->create(false);

        $property['pricing_frequency'] = '';

        $response  = $this->post($this->endpoint.'/properties', $property);

        $this->assertEquals($response->status(), 400);
    }

    /**
     * @test
     */
    public function it_should_fail_if_description_is_missing()
    {
        $property = $this->propertyFactory->ownedBy()->withImages()->create(false);

        $property['description'] = '';

        $response  = $this->post($this->endpoint.'/properties', $property);

        $this->assertEquals($response->status(), 400);
    }

    /**
     * @test
     */
    public function it_should_fail_if_features_is_missing()
    {
        $property = $this->propertyFactory->ownedBy()->withImages()->create(false);

        $property['features'] = '';

        $response  = $this->post($this->endpoint.'/properties', $property);

        $this->assertEquals($response->status(), 400);
    }

    /**
     * @test
     */
    public function it_should_fail_if_images_is_missing()
    {

        $property = $this->propertyFactory->ownedBy()->create(false);

        $response  = $this->post($this->endpoint.'/properties', $property);

        $this->assertEquals($response->status(), 400);
    }


    /**
     * @test
     */
    public function it_should_fail_if_publish_is_missing()
    {

        $property = $this->propertyFactory->ownedBy()->withImages()->create(false);

        $property['publish'] = '';

        $response  = $this->post($this->endpoint.'/properties', $property);

        $this->assertEquals($response->status(), 400);
    }

    /**
     * @test
     */
    public function it_should_unpublish_a_listing_if_its_published()
    {
        $property = $this->propertyFactory->ownedBy()->published()->create(true)->all();

        $result = array_shift($property);

        $response = $this->patch("{$this->endpoint}/properties/{$result['id']}/state", [
            'state' => 'published'
        ]);

        $response->assertOk();

        $updateProperty = $response->json('results');

        $this->assertEquals($updateProperty['published_at'], null);
    }

    /**
     * @test
     */
    public function it_should_fail_if_state_is_not_one_of_published_or_unpublished()
    {
        $property = $this->propertyFactory->ownedBy()->published()->create(true)->all();

        $result = array_shift($property);

        $response = $this->patch("{$this->endpoint}/properties/{$result['id']}/state", [
            'state' => 'publish'
        ]);

        $this->assertEquals($response->status(), 400);
    }

    /**
     * @test
     */
    public function it_should_delete_a_property_successfully()
    {
        Event::fake();

        $property = $this->propertyFactory->ownedBy()->published()->create(true)->all();

        $result = array_shift($property);

        $response = $this->delete("{$this->endpoint}/properties/{$result['id']}");

       $this->assertEquals(204, $response->status());
    }

    /**
     * @test
     */
    public function it_should_return_404_if_property_is_not_found()
    {
        $this->withExceptionHandling();

        $response = $this->get("$this->endpoint/properties/56");

        $response->assertNotFound();
    }

    /**
     * @test
     */
    public function it_should_get_a_property_by_id()
    {
       $user = factory(User::class)->create();

       $property = $this->propertyFactory->ownedBy($user)->create(true)->toArray();

       $property = array_shift($property);

       $response = $this->get("$this->endpoint/properties/{$property['id']}");

       $id = $response->json('results')['id'];

       $response->assertOk();
       $this->assertEquals($id, $property['id']);
    }
}
