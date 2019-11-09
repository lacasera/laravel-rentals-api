<?php

namespace Tests\Feature;

use App\User;
use Tests\FeatureTestCase;

class LoginTest extends FeatureTestCase
{
    /**
     * @test
     */
    public function it_should_log_a_user_in()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $response = $this->post('api/v1/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response->assertOk();
    }

    /**
     * @test
     */
    public function it_should_return_the_correct_response_data()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $response = $this->post('api/v1/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response->assertExactJson([
            'access_token' => $response->json('access_token'),
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'id' => $user->id
            ]
        ]);
    }

    /**
     * @test
     */
    public function it_should_return_404_when_user_is_not_found()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('api/v1/login', [
            'email' => 'nonexisting@email.com',
            'password' => 'password'
        ]);

        $response->assertNotFound();
    }

    /**
     * @test
     */
    public function it_should_return_400_if_email_is_missing_from_request()
    {
        $response = $this->post('api/v1/login', [
            'password' => 'password'
        ]);

       $this->assertEquals($response->status(), 400);
    }

    /**
     * @test
     */
    public function it_should_return_400_if_email_is_not_valid()
    {
        $response = $this->post('api/v1/login', [
            'email' => 'nonexisting'
        ]);

        $this->assertEquals($response->status(), 400);
    }

    /**
     * @test
     */
    public function it_should_return_400_if_password_is_missing_from_request()
    {
        $response = $this->post('api/v1/login', [
            'email' => 'nonexisting@email.com'
        ]);

        $this->assertEquals($response->status(), 400);
    }
}