<?php

namespace Tests\Feature;

use App\Company;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompanyTest extends TestCase
{
    public function testsCompaniesAreCreatedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $payload = ['name' => 'Test company name'];

        $this->json('POST', 'api/companies', $payload, $headers)
            ->assertStatus(201);

        $company = Company::find(1);
        $this->assertEquals($company->id, 1);
    }

    public function testsCompaniesAreListedCorrectly()
    {
        factory(Company::class, 10)->create();

        $this->json('GET', 'api/companies')
            ->assertStatus(200)
            ->assertJsonStructure([
                '*' => ['id', 'name', 'description', 'average_rating'],
            ]);
    }

    public function testCompaniesNotCreatedWithTooLongName()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];

        $payload = ['name' => 'sOxZkIpXC0ytqOICCH48JEK9ubYmFLc1wmK06reX9ICz16HjZR6Me67MU7Ry2vWCoc5t4n1nTMdL3ImOZbNYTlAv05XYUmYiyV7vmiMg40Q32omflZ4o8SQM1nW9hFiGAqhjjD6ocC1QD84zJhanMTp2pn0aiMp0qe7aahihiUhNHxd6DvC1rEpOw84vuPMv'];
        $this->json('POST', 'api/companies', $payload, $headers)
            ->assertStatus(422);
    }

    public function testCompanyNameSanitizedOnCreation()
    {

        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];

        $payload = ['name' => '  <p>Параграф.</p><!-- Комментарий --> <a href="#fragment">Еще текст</a>  <script>alert(\'Boo!\');</script>'];
        $this->json('POST', 'api/companies', $payload, $headers)
            ->assertStatus(201);
        $this->assertEquals(
            Company::find(1)->toArray()['name'],'Параграф. Еще текст  alert(&#39;Boo!&#39;);');
    }

    public function testCompanyNotApprovedOnCreation()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];

        $payload = ['name' => 'Скучная компания', 'approved' => 1];
        $this->json('POST', 'api/companies', $payload, $headers)
            ->assertStatus(201);

        $company = Company::find(1);
        self::assertEquals(0, $company->approved);
    }

    public function testAdminCreateApprovedCompany()
    {
        $user = User::create([
            'name' => 'Admin',
            'login' => 'admin',
            'role' => 'admin',
            'password' => bcrypt('password'),
        ]);
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];

        $payload = ['name' => 'Скучная компания', 'approved' => 1];
        $this->json('POST', 'api/companies', $payload, $headers)
            ->assertStatus(201);

        $company = Company::find(1);
        self::assertEquals(1, $company->approved);
    }

    public function testUserCanNotCreateApprovedCompany()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];

        $payload = ['name' => 'Скучная компания', 'approved' => 1];
        $this->json('POST', 'api/companies', $payload, $headers)
            ->assertStatus(201);

        $company = Company::find(1);
        self::assertEquals(0, $company->approved);
    }

    public function testAdminCanApproveCompany()
    {
        factory(Company::class)->create();
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'role' => 'admin',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];

        $this->json('PUT', 'api/companies/1', [
            'approved' => 1
        ], $headers)->assertStatus(200);

        $company = Company::find(1);
        self::assertEquals(1, $company->approved);
    }
}
