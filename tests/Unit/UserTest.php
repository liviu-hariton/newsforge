<?php

namespace Tests\Unit;

use App\Models\Article;
use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_a_user_has_articles(): void
    {
        $user = User::find(5);

        $this->assertCount(1, $user->articles);
    }
}
