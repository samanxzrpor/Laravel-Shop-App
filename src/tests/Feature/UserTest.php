<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function testGetAllUser()
    {
        $response = $this->authentication()->get(route('users.index'));
        $response->assertStatus(200);
    }


}
