<?php

namespace Tests\Feature;

use App\Company;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompanyTest extends TestCase
{
    public function testsCompaniesAreCreaetedCorrectly()
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
        factory(Company::class)->create([
            'name' => 'Test company 1'
        ]);

        factory(Company::class)->create([
            'name' => 'Test company 2'
        ]);

        $this->json('GET', 'api/companies')
            ->assertStatus(200)
            ->assertJson([
                ['name' => 'Test company 1'],
                ['name' => 'Test company 2'],
            ])
            ->assertJsonStructure([
                '*' => ['id', 'name', 'created_at', 'updated_at'],
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
}
