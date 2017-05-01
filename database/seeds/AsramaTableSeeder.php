<?php

use App\Models\Asrama;
use Illuminate\Database\Seeder;

class AsramaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('asrama')->truncate();

        foreach ($this->getAsrama() as $asrama) {
            $asramas = new Asrama();   
            $asramas->nama_asrama = $asrama;   
            $asramas->save();   
        }
    }

    private function getAsrama()
    {
        return [
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
