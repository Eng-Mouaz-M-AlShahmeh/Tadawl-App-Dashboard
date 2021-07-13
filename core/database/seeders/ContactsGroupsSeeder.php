<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\ContactsGroup;

class ContactsGroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // News Letter Group
        $ContactsGroup = new ContactsGroup();
        $ContactsGroup->name = "Newsletter Emails";
        $ContactsGroup->created_by = 1;
        $ContactsGroup->save();
    }
}
