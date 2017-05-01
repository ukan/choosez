<?php

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->truncate();

        foreach ($this->getMenus() as $menu) {
            if ($menu['is_parent']) {
                $m = array_except($menu, 'child');

                $m = Menu::create($m);

                foreach ($menu['child'] as $child) {
                    $child = array_add($child, 'parent', $m->id);

                    Menu::create($child);
                }
            } else {
                Menu::create($menu);
            }
        }
    }

    private function getMenus()
    {
        return [
            ['is_parent' => false, 'name' => str_slug('Dashboard'), 'display_name' => 'Dashboard', 'icon' => 'tachometer', 'href' => 'admin/dashboard', 'pattern' => 'dashboard'],
        /* Super Admin */
            ['is_parent' => true, 'name' => str_slug('Super Admin Account Management'), 'display_name' => 'Account Management', 'icon' => 'users', 'href' => '#', 'pattern' => 'user-trustees', 'child' => [
                ['name' => str_slug('Super Admin Menu Management'), 'display_name' => 'Menu Management', 'icon' => 'bars', 'href' => 'admin/user-trustees/menus', 'pattern' => 'user-trustees'],
                ['name' => str_slug('Super Admin Role Management'), 'display_name' => 'Role Management', 'icon' => 'user-secret', 'href' => 'admin/user-trustees/roles', 'pattern' => 'user-trustees'],
                ['name' => str_slug('Super Admin User Management'), 'display_name' => 'User Management', 'icon' => 'users', 'href' => 'admin/user-trustees/users', 'pattern' => 'user-trustees'],
            ]],
            ['is_parent' => false, 'name' => str_slug('manage-teacher'), 'display_name' => 'Teacher Management', 'icon' => 'user', 'href' => 'admin/manage-teacher/', 'pattern' => 'manage-teacher'],
            ['is_parent' => true, 'name' => str_slug('admin-academic'), 'display_name' => 'Academic Management', 'icon' => 'book', 'href' => '#', 'pattern' => 'academic-management', 'child' => [
                ['is_parent' => false, 'name' => str_slug('admin-book-management'), 'display_name' => 'Book Management', 'icon' => 'book', 'href' => 'admin/academic-management/books', 'pattern' => 'academic-management'],    
            ]],
            
            ['is_parent' => true, 'name' => str_slug('admin-organization'), 'display_name' => 'Organization Management', 'icon' => 'user', 'href' => '#', 'pattern' => 'organization', 'child' => [
                ['is_parent' => false, 'name' => str_slug('admin-ministry-management'), 'display_name' => 'Ministry Management', 'icon' => 'user', 'href' => 'admin/organization/center/kementerian', 'pattern' => 'organization'],
                ['is_parent' => false, 'name' => str_slug('admin-proker-management'), 'display_name' => 'Proker Management', 'icon' => 'book', 'href' => 'admin/organization/center/proker', 'pattern' => 'organization'],
                ['is_parent' => false, 'name' => str_slug('admin-organigram-management'), 'display_name' => 'Organigram Management', 'icon' => 'user', 'href' => 'admin/organization/center/organigram', 'pattern' => 'organization'],
            ]],
        /* Member */
            ['is_parent' => false, 'name' => str_slug('Member Area My Profile'), 'display_name' => 'My Profile', 'icon' => 'user', 'href' => 'my-profile', 'pattern' => 'my_profile'],
        /* HQ Admin */
            ['is_parent' => false, 'name' => str_slug('HQ Admin Manage LCW'), 'display_name' => 'Manage LCW', 'icon' => 'desktop', 'href' => 'admin/lcw-page/manage-lcw', 'pattern' => 'manage-lcw'],
            ['is_parent' => false, 'name' => str_slug('HQ Admin History'), 'display_name' => 'History', 'icon' => 'history', 'href' => 'admin/log-history-page/log-history', 'pattern' => 'history'],      
        ];
    }
}
