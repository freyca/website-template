<?php

namespace Tests\Feature\Filament;

use App\Filament\User\Resources\Addresses\Pages\CreateAddress;
use App\Filament\User\Resources\Addresses\Pages\EditAddress;
use App\Filament\User\Resources\Addresses\Pages\ListAddress;
use App\Models\Address;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AddressResourceTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create([
            'email' => 'test@example.com',
        ]);
        $this->actingAs($this->user);
    }

    public function test_it_can_list_addresses(): void
    {
        $addresses = Address::factory()->count(3)->for($this->user)->create();

        $component = Livewire::test(ListAddress::class)
            ->assertSuccessful();

        foreach ($addresses as $address) {
            $component->assertSee($address->address);
        }
    }

    public function test_it_can_render_create_address_page(): void
    {
        Livewire::test(CreateAddress::class)
            ->assertSuccessful();
    }

    public function test_it_can_create_an_address(): void
    {
        Livewire::test(CreateAddress::class)
            ->fillForm([
                'name' => 'Test Address',
                'surname' => 'Test Surname',
                'address' => '123 Test Street',
                'city' => 'Test City',
                'state' => 'Test State',
                'zip_code' => '12345',
                'country' => 'ES',
                'phone' => '+34123456789',
                'address_type' => 'shipping',
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('addresses', [
            'name' => 'Test Address',
            'user_id' => $this->user->id,
        ]);
    }

    public function test_it_can_edit_an_address(): void
    {
        $address = Address::factory()->for($this->user)->create();

        Livewire::test(EditAddress::class, ['record' => $address->id])
            ->fillForm([
                'name' => 'Updated Address',
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('addresses', [
            'id' => $address->id,
            'name' => 'Updated Address',
        ]);
    }

    public function test_it_can_view_an_address(): void
    {
        $address = Address::factory()->for($this->user)->create();

        Livewire::test(EditAddress::class, ['record' => $address->id])
            ->assertSchemaStateSet([
                'name' => $address->name,
                'address' => $address->address,
            ]);
    }
}
