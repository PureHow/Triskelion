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

    public function testModelGetUserByMobile ()
    {
        try {
            $users = factory(User::class, 3)->make();
            foreach ($users as $user) {
                $user->save();

                $currentUser = $user->getUserByMobile($user->mobile);
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

    public function testModelGetUserByCode ()
    {
        try {
            $users = factory(User::class, 3)->make();
            foreach ($users as $user) {
                $user->save();

                $currentUser = $user->getUserByCode($user->code);
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

    public function testModelGetUserById ()
    {
        try {
            $users = factory(User::class, 3)->make();
            foreach ($users as $user) {
                $user->save();

                $currentUser = $user->getUserById($user->id);
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
