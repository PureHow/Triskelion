<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Triskelion\Models\User;
use DB;
use Exception;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testModelGetUserByEmail ()
    {
        try {
            $users = factory(User::class, 3)->make();
            foreach ($users as $user) {
                $user->save();

                $currentUser = $user->getUserByEmail($user->email);
                $currentUser === $user ?? $this->assertTrue(false);
            }

            $this->assertTrue(true);
        } catch (Exception $e) {
            Log::error('Test failed!', [$e]);
            $this->assertTrue(false);
        } finally {
            User::truncate();
        }
    }
}
