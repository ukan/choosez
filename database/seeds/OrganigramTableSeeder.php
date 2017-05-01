<?php

use App\Models\Organigram;
use Illuminate\Database\Seeder;

class OrganigramTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('organigram')->truncate();

        foreach ($this->getOrganigram() as $organ) {
            $org = new Organigram();   
            $org->nama = $organ;   
            $org->save();   
        }
    }

    private function getOrganigram()
    {
        return [
            'Pusat',
            'Jadwal',
            'Asrama Putera 1',
            'Asrama Putera 2',
            'Asrama Putera 3',
            'Asrama Putera 4',
            'Asrama Puteri 1',
            'Asrama Puteri 1C',
            'Asrama Puteri 2',
            'Asrama Puteri 3A',
            'Asrama Puteri 3B',
            'Asrama Puteri 3C',
            'Asrama Puteri 4A',
            'Asrama Puteri 4B',
            'Asrama Puteri 5',
            'Asrama Puteri 6',
            'Asrama Puteri 7',
        ];
    }
}
