<?php
namespace Database\Seeders;
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
        $this->call(LanguagesSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(WebmasterSettingsSeeder::class);
        $this->call(WebmasterBannersSeeder::class);
        $this->call(WebmasterSectionsSeeder::class);
        $this->call(SettingsSeeder::class);
        $this->call(CountriesSeeder::class);
        $this->call(ContactsGroupsSeeder::class);
        $this->call(MenusSeeder::class);
        $this->call(BannersSeeder::class);
        $this->call(TopicsSeeder::class);
        $this->call(WebmailGroupsSeeder::class);
    }
}
