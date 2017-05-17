<?php

use App\Models\RoomList;
use Illuminate\Database\Seeder;

class RoomListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('room_lists')->truncate();

        foreach ($this->getRoomLists() as $menu) {
            if ($menu['is_parent']) {
                $m = array_except($menu, 'child');

                $m = RoomList::create($m);

                foreach ($menu['child'] as $child) {
                    $child = array_add($child, 'parent', $m->id);

                    RoomList::create($child);
                }
            } else {
                RoomList::create($menu);
            }
        }
    }

    private function getRoomLists()
    {
        return [
            ['is_parent' => true, 'name' => 'ASPA 1', 'pattern' => 'pa-1', 'child' => [
                ['name' => 'Riyadusshalihin', 'pattern' => 'pa-1'],
                ['name' => 'Kaelani', 'pattern' => 'pa-1'],
                ['name' => 'Fathul Qorib', 'pattern' => 'pa-1'],
                ['name' => 'Iqna', 'pattern' => 'pa-1'],
                ['name' => "Fathul Mu'in", 'pattern' => 'pa-1'],
                ['name' => 'Jalalain', 'pattern' => 'pa-1'],
                ['name' => 'Fathul Majid', 'pattern' => 'pa-1'],
                ['name' => 'Daruri', 'pattern' => 'pa-1'],
                ['name' => 'Imriti', 'pattern' => 'pa-1'],
                ['name' => "Riyadul Badi'ah", 'pattern' => 'pa-1'],
            ]],
            ['is_parent' => true, 'name' => 'ASPA 2', 'pattern' => 'pa-2', 'child' => [
                ['name' => 'Kamar 01', 'pattern' => 'pa-2'],
                ['name' => 'Kamar 02', 'pattern' => 'pa-2'],
                ['name' => 'Kamar 03', 'pattern' => 'pa-2'],
                ['name' => 'Kamar 04', 'pattern' => 'pa-2'],
                ['name' => 'Kamar 05', 'pattern' => 'pa-2'],
                ['name' => 'Kamar 06', 'pattern' => 'pa-2'],
                ['name' => 'Kamar 07', 'pattern' => 'pa-2'],
                ['name' => 'Kamar 08', 'pattern' => 'pa-2'],
                ['name' => 'Kamar 09', 'pattern' => 'pa-2'],
                ['name' => 'Kamar 10', 'pattern' => 'pa-2'],
                ['name' => 'Kamar 11', 'pattern' => 'pa-2'],
                ['name' => 'Kamar 12', 'pattern' => 'pa-2'],
                ['name' => 'Kamar 13', 'pattern' => 'pa-2'],
                ['name' => 'Kamar 14', 'pattern' => 'pa-2'],
                ['name' => 'Kamar 15', 'pattern' => 'pa-2'],
                ['name' => 'Kamar 16', 'pattern' => 'pa-2'],
                ['name' => 'Kamar 17', 'pattern' => 'pa-2'],
                ['name' => 'Kamar 18', 'pattern' => 'pa-2'],
                ['name' => 'Kamar 19', 'pattern' => 'pa-2'],
                ['name' => 'Kamar 20', 'pattern' => 'pa-2'],
                ['name' => 'Kamar 21', 'pattern' => 'pa-2'],
                ['name' => 'Kamar 22', 'pattern' => 'pa-2'],
                ['name' => 'Kamar 23', 'pattern' => 'pa-2'],
                ['name' => 'Kamar 24', 'pattern' => 'pa-2'],
                ['name' => 'Kamar 25', 'pattern' => 'pa-2'],
                ['name' => 'Kamar 26', 'pattern' => 'pa-2'],
                ['name' => 'Kamar 27', 'pattern' => 'pa-2'],
                ['name' => 'Kamar 28', 'pattern' => 'pa-2'],
                ['name' => 'Kamar 29', 'pattern' => 'pa-2'],
                ['name' => 'Kamar 30', 'pattern' => 'pa-2'],
            ]],
            ['is_parent' => true, 'name' => 'ASPA 3', 'pattern' => 'pa-3', 'child' => [
                ['name' => 'Al-Munawwar', 'pattern' => 'pa-3'],
                ['name' => 'Al-Muhajirin', 'pattern' => 'pa-3'],
                ['name' => 'Al-Anshor', 'pattern' => 'pa-3'],
                ['name' => 'Al-Faidzin', 'pattern' => 'pa-3'],
                ['name' => 'Al-Mukhlisin', 'pattern' => 'pa-3'],
                ['name' => 'Al-Muttaqin', 'pattern' => 'pa-3'],
                ['name' => 'Al-Muhsinin', 'pattern' => 'pa-3'],
                ['name' => 'An-Najah', 'pattern' => 'pa-3'],
                ['name' => 'ITC', 'pattern' => 'pa-3'],
            ]],
            ['is_parent' => true, 'name' => 'ASPA 4', 'pattern' => 'pa-4', 'child' => [
                ['name' => 'OSPAI', 'pattern' => 'pa-4'],
                ['name' => 'Al-Mukaromah', 'pattern' => 'pa-4'],
                ['name' => 'Atina', 'pattern' => 'pa-4'],
                ['name' => 'Az-Ziyan', 'pattern' => 'pa-4'],
                ['name' => 'Al-Huda', 'pattern' => 'pa-4'],
                ['name' => 'Al-Furqon', 'pattern' => 'pa-4'],
                ['name' => 'Al-Irfan', 'pattern' => 'pa-4'],
            ]],
            ['is_parent' => true, 'name' => 'ASPI 1', 'pattern' => 'pi-1', 'child' => [
                ['name' => 'Aziyan', 'pattern' => 'pi-1'],
                ['name' => 'Teteh', 'pattern' => 'pi-1'],
                ['name' => 'Ahmad Zainuddin', 'pattern' => 'pi-1'],
                ['name' => 'Mama Sulaiman', 'pattern' => 'pi-1'],
                ['name' => 'Zetmut A', 'pattern' => 'pi-1'],
                ['name' => 'Zetmut B', 'pattern' => 'pi-1'],
                ['name' => 'Abdul Ghofur', 'pattern' => 'pi-1'],
                ['name' => 'Almasturiyah', 'pattern' => 'pi-1'],
                ['name' => 'Al-Ianah', 'pattern' => 'pi-1'],
                ['name' => 'Al-Azhar', 'pattern' => 'pi-1'],
                ['name' => 'Ulul Albab', 'pattern' => 'pi-1'],
                ['name' => 'Zainul Millah', 'pattern' => 'pi-1'],
                ['name' => 'Sofnis', 'pattern' => 'pi-1'],
                ['name' => 'Ibadurrahman', 'pattern' => 'pi-1'],
            ]],
            ['is_parent' => true, 'name' => 'ASPI 1C', 'pattern' => 'pi-1c', 'child' => [
                ['name' => 'Ruhama', 'pattern' => 'pi-1c'],
                ['name' => 'Rufaqa', 'pattern' => 'pi-1c'],
                ['name' => 'Ruwaida', 'pattern' => 'pi-1c'],
            ]],
            ['is_parent' => true, 'name' => 'ASPI 2', 'pattern' => 'pi-2', 'child' => [
                ['name' => 'Mekkah', 'pattern' => 'pi-2'],
                ['name' => 'Arafah', 'pattern' => 'pi-2'],
                ['name' => 'Madinah', 'pattern' => 'pi-2'],
                ['name' => 'Ali', 'pattern' => 'pi-2'],
                ['name' => 'Hasan Al-Banna', 'pattern' => 'pi-2'],
                ['name' => 'Yusuf Qordowi', 'pattern' => 'pi-2'],
                ['name' => 'Alfiyah', 'pattern' => 'pi-2'],
                ['name' => 'Ziyan', 'pattern' => 'pi-2'],
                ['name' => 'Tsaqofah', 'pattern' => 'pi-2'],
                ['name' => 'Al-Fajr', 'pattern' => 'pi-2'],
                ['name' => 'As-Sohwah', 'pattern' => 'pi-2'],
                ['name' => 'Shafa Marwah', 'pattern' => 'pi-2'],
            ]],
            ['is_parent' => true, 'name' => 'ASPI 3A', 'pattern' => 'pi-3a', 'child' => [
                ['name' => 'K.H. Ucu Djajuli', 'pattern' => 'pi-3a'],
                ['name' => 'K.H. Abdul Halim', 'pattern' => 'pi-3a'],
                ['name' => 'K.H. E.Fahruddin Masturo', 'pattern' => 'pi-3a'],
                ['name' => 'K.H. Iyan Tibyani', 'pattern' => 'pi-3a'],
                ['name' => 'K.H. Khoer Afandi', 'pattern' => 'pi-3a'],
            ]],
            ['is_parent' => true, 'name' => 'ASPI 3B', 'pattern' => 'pi-3b', 'child' => [
                ['name' => 'Intan', 'pattern' => 'pi-3b'],
                ['name' => 'Permata', 'pattern' => 'pi-3b'],
                ['name' => 'Mutiara', 'pattern' => 'pi-3b'],
                ['name' => 'Berlian 1', 'pattern' => 'pi-3b'],
                ['name' => 'Berlian 2', 'pattern' => 'pi-3b'],
                ['name' => 'Berlian 3', 'pattern' => 'pi-3b'],
            ]],
            ['is_parent' => true, 'name' => 'ASPI 3C', 'pattern' => 'pi-3c', 'child' => [
                ['name' => 'Kamar 01', 'pattern' => 'pi-3c'],
                ['name' => 'Kamar 02', 'pattern' => 'pi-3c'],
                ['name' => 'Kamar 03', 'pattern' => 'pi-3c'],
                ['name' => 'Kamar 04', 'pattern' => 'pi-3c'],
            ]],
            ['is_parent' => true, 'name' => 'ASPI 4A', 'pattern' => 'pi-4a', 'child' => [
                ['name' => 'Al-Muslih', 'pattern' => 'pi-4a'],
                ['name' => 'Al-Musthofa', 'pattern' => 'pi-4a'],
                ['name' => 'Al-Muchtar', 'pattern' => 'pi-4a'],
            ]],
            ['is_parent' => true, 'name' => 'ASPI 4B', 'pattern' => 'pi-4b', 'child' => [
                ['name' => 'Al-Ittihad', 'pattern' => 'pi-4b'],
                ['name' => 'Darussalam', 'pattern' => 'pi-4b'],
                ['name' => 'Al-Mutmainnah', 'pattern' => 'pi-4b'],
                ['name' => 'Al-Atiqiyah', 'pattern' => 'pi-4b'],
                ['name' => 'Al-Falah', 'pattern' => 'pi-4b'],
                ['name' => 'Al-Istiqamah', 'pattern' => 'pi-4b'],
                ['name' => 'At-Taubah', 'pattern' => 'pi-4b'],
                ['name' => 'Al-Muroqobah', 'pattern' => 'pi-4b'],
                ['name' => 'Al-Mauidzoh', 'pattern' => 'pi-4b'],
                ['name' => 'Al-Hikmah', 'pattern' => 'pi-4b'],
                ['name' => 'Ad-Dakwah', 'pattern' => 'pi-4b'],
            ]],
            ['is_parent' => true, 'name' => 'ASPI 5', 'pattern' => 'pi-5', 'child' => [
                ['name' => 'Ibnu Sina', 'pattern' => 'pi-5'],
                ['name' => 'Ibnu Rusydi', 'pattern' => 'pi-5'],
            ]],
            ['is_parent' => true, 'name' => 'ASPI 6', 'pattern' => 'pi-6', 'child' => [
                ['name' => 'Ummu Kultsum', 'pattern' => 'pi-6'],
                ['name' => 'Ummu Habibah', 'pattern' => 'pi-6'],
                ['name' => 'Siti Hafsah', 'pattern' => 'pi-6'],
                ['name' => 'Siti Khodizah', 'pattern' => 'pi-6'],
                ['name' => 'Ummu Salamah', 'pattern' => 'pi-6'],
                ['name' => 'Siti Saodah', 'pattern' => 'pi-6'],
            ]],
            ['is_parent' => true, 'name' => 'ASPI 7', 'pattern' => 'pi-7', 'child' => [
                ['name' => 'Shafwatut Taffasir A', 'pattern' => 'pi-7'],
                ['name' => 'Shafwatut Taffasir B', 'pattern' => 'pi-7'],
                ['name' => 'Ibnu Katsir', 'pattern' => 'pi-7'],
                ['name' => "Mutawally Sya'rowi", 'pattern' => 'pi-7'],
                ['name' => "Hasyim As'ary", 'pattern' => 'pi-7'],
                ['name' => "Abdul Mu'ti", 'pattern' => 'pi-7'],
                ['name' => "Al-Ghazali", 'pattern' => 'pi-7'],
                ['name' => "Tarbiyah Islamiyah", 'pattern' => 'pi-7'],
                ['name' => "Husnul Khatimah", 'pattern' => 'pi-7'],
            ]],
        ];
    }
}