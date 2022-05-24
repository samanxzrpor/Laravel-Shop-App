<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Spatie\Permission\Models\Role;
use Tests\Feature\UserTest;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Authenticate User and Give Role To Admin Panel Process
     * @return TestCase
     */

    protected function authentication(): TestCase
    {
        $user = User::factory()->create();
        Role::create([
            'name' => 'Admin'
        ]);
        $user->assignRole('Admin');
        return $this->actingAs($user , 'sanctum');
    }

}
