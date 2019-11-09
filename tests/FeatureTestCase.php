<?php
/**
 * Created by PhpStorm.
 * User: lacasera
 * Date: 10/17/19
 * Time: 1:27 PM
 */

namespace Tests;
use Illuminate\Foundation\Testing\DatabaseTransactions;

abstract class FeatureTestCase extends TestCase
{
    use DatabaseTransactions;

    protected $endpoint = '/api/v1';

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate');

        $this->artisan('passport:install');
    }
}