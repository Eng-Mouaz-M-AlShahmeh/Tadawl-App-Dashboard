<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Administrator
        //  - All permissions : add,edit,delete
        //  - All site settings
        //  - All webmaster settings

        $newuser = new User();
        $newuser->name = "admin";
        $newuser->email = "admin@site.com";
        $newuser->password = bcrypt("admin");
        $newuser->permissions_id = "1";
        $newuser->status = "1";
        $newuser->created_by = 1;
        $newuser->save();
    }
}
