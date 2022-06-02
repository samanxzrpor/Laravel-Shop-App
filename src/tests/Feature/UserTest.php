<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Review;
use App\Models\User;
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


    public function testOrderingByActivation()
    {
        $comments = Comment::factory(100)->create();

        $reviews = Review::factory(100)->create();

        $response = $this->authentication()->getJson(route('users.index' , ['orderBy' => 'activation']));
    }


    public function testChangeUserRoleByTrueRoles()
    {
        $user = User::factory()->create();

        $response = $this->authentication()->postJson(route('users.changeRole' , [$user]) ,[
            'role' => 'Admin'
        ])->assertSuccessful();
        $this->assertDatabaseHas('model_has_roles' , ['model_id' => $user->id]);
    }


    public function testChangeUserRoleByWrongRoles()
    {
        $user = User::factory()->create();

        $response = $this->authentication()->postJson(route('users.changeRole' , [$user]) ,[
            'role' => 'Adminn'
        ]);
        $response->assertJsonValidationErrors(['role']);
    }
}
