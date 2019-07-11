<?php

use App\Company;
use Illuminate\Database\Seeder;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::truncate();

        $companies = [
            'Сокольский Док АО "С-Док"',
            'Монза ООО «МОНЗА»',
            'Биоват ООО «Биоват-Профиль»',
            'Логартхаус ООО "Логартхаус"',
            'ЛПК-35 ООО ЛПК-35',
            'Вологодский северный лес ООО "Вологодский Северный Лес»',
            'AGAX-домостроение ИП Аксеновский',
            'Новый дом ООО «Новый дом»',
            'Вологодский ДСК ООО "Вологодский ДСК"',
            'Объединенная домостроительная компания ООО "ОДК"',
            'Тардом ООО «Бревенчатый дом»',
            'Кластер Вологодский Дом',
        ];
        foreach ($companies as $company ) {
            $company = new Company([
                'name' => $company,
                'description' => '',
                'approved' => 1
            ]);
            $company->save();
        }
    }
}
