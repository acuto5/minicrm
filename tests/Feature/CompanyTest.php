<?php

namespace Tests\Feature;

use App\Company;
use App\User;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class CompanyTest
 * @package Tests\Feature
 */
class CompanyTest extends TestCase
{
    use RefreshDatabase;

    /**
    * @test
    */
    public function not_logged_user_cannot_browse_companies_list(): void
    {
        $response = $this->get('/company');

        $response->assertStatus(302);
    }

    /**
    * @test
    */
    public function logged_in_user_can_browse_companies_list(): void
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get('/company');

        $response->assertStatus(200);
    }

    /**
    * @test
    */
    public function if_none_company_created_message_shown(): void
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get('/company');

        $response->assertSee('No companies registered yet!');
    }

    /**
    * @test
    */
    public function logged_in_user_can_see_companies_list(): void
    {
        $user = factory(User::class)->create();
        $company = factory(Company::class)->create();

        $response = $this->actingAs($user)->get('/company');

        $response->assertSee($company->name);
    }

    /**
     * @test
     */
    public function a_logged_in_user_can_create_company(): void
    {
        $user = factory(User::class)->create();
        $company = factory(Company::class)->create();

        $this->actingAs($user)->post('/company');

        $this->assertDatabaseHas('companies', [
            'name' => $company->name,
            'email' => $company->email,
            'logo' => $company->logo,
            'website' => $company->website,
        ]);
    }

    /**
    * @test
    */
    public function a_logged_in_user_can_edit_company(): void
    {
        $user = factory(User::class)->create();
        $company = factory(Company::class)->create();

        $this->actingAs($user)->put('/company/'. $company->id);

        $updatedCompany = [
            'name' => 'New name',
            'email' => 'new@email.com',
            'logo' => 'logo.jpeg',
            'website' => 'http://www.new-website.com',
        ];

        $company->update($updatedCompany);

        $this->assertDatabaseHas('companies', $updatedCompany);
    }

    /**
    * @test
    */
    public function a_logged_in_user_can_delete_company(): void
    {
        $user = factory(User::class)->create();
        $company = factory(Company::class)->create();
        factory(Company::class)->create();

        $this->actingAs($user)->delete('/company/'. $company->id);

        $company->delete();

        $this->assertDatabaseMissing('companies', ['id' => 1]);
    }

    /**
    * @test
    */
    public function company_name_field_is_required(): void
    {
        $this->withExceptionHandling();

        $user = factory(User::class)->create();
        $company = factory(Company::class)->make([
            'name' => '',
        ]);

        $response = $this->actingAs($user)->post('/company', $company->toArray());

        $response->assertSessionHasErrors('name');
    }

    /**
     * @test
     */
    public function company_name_field_max_50_symbols(): void
    {
        $this->withExceptionHandling();

        $user = factory(User::class)->create();
        $company = factory(Company::class)->make([
            'name' => str_repeat('a', 51),
        ]);

        $response = $this->actingAs($user)->post('/company', $company->toArray());

        $response->assertSessionHasErrors('name');
    }
}
