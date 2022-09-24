<?php

namespace Tests\Feature\Controllers;

use App\Models\User;

class SettingsControllerTest extends \Tests\TestCase
{
    /** @test */
    public function an_authenticated_user_can_add_an_issue()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->get('/settings')
            ->assertOk()
            ->assertViewIs('settings.index')
            ->assertSee('Settings');

    }

    /** @test */
    public function an_unauthenticated_user_cannot_add_an_issue()
    {
        $this->get('/settings')
            ->assertRedirect('login');
    }

    /** @test */
    public function an_authenticated_user_can_store_an_issue()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $fees = [
            'fee' => [
                'basic_fee' => [
                    'slug' => 'basic_fee',
                    'value' => '0.1'
                ]
            ]
        ];

        $this->post('/settings/fees', $fees)
            ->assertRedirect('settings');
    }

    /** @test */
    public function it_throws_error_when_value_is_not_numeric()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $fees = [
            'fee' => [
                'basic_fee' => [
                    'slug' => 'basic_fee',
                    'value' => 'basic fee'
                ]
            ]
        ];

        $result = $this->post('/settings/fees', $fees);
        $result->assertSessionHasErrors('fee.basic_fee.value');
    }
}
