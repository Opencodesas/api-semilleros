<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\BaseClauses;
use App\Models\Contractor;
use App\Models\Disciplines;
use App\Models\Ethnicity;
use App\Models\InfoContractor;
use App\Models\MethodologistVisitPersonalized;
use App\Models\MunicipalityUser;
use App\Models\UserHierarchy;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            // ZoneSeeder::class,
            ZoneTableSeeder::class,
            UsersTableSeeder::class,
            // UserSeeder::class,
            ModuleSeeder::class,
            ModuleItemSeeder::class,
            RolesTableSeeder::class,
            // RoleSeeder::class,
            PermissionSeeder::class,
            RolesUsersTableSeeder::class,
            // RoleUserSeeder::class,
            GroupSeeder::class,
            PermissionRoleSeeder::class,
            ValidityPeriodsSeeder::class,
            ProfileSeeder::class,
            DepartmentsSeeder::class,
            CitySeeder::class,
            StatusSeeder::class,
            BankSeeder::class,
            BankAccountTypeSeeder::class,
            MunicipalitiesTableSeeder::class,
            // MunicipalitySeeder::class,
            ObjectSeeder::class,
            DisciplinesTableSeeder::class,
            DisciplinesUsersTableSeeder::class,
            // DisciplinesSeeder::class,
            DirectionSeeder::class,
            ZoneUserTableSeeder::class,
            // ZoneUserSeeder::class,
            // MunicipalityUserSeeder::class,
            EthnicitySeeder::class,
            EventSupportSeederer::class,
            EvaluationSeeder::class,
            MonthsSeeder::class,
            MethodologistVisitPersonalizedSeeder::class,
            CoordinatorVisitSeeder::class,
            SidewalkSeeder::class,
            Health_Entities_Seeder::class,
            RolesActivitiesSeeder::class,
            RolesObjectsActivitiesSeeder::class
        ]);
    }
}
