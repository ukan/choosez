<?php

use App\Models\Bidang;
use Illuminate\Database\Seeder;

class BidangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bidang')->truncate();

        foreach ($this->getBidang() as $bidang) {
            $bidangs = new Bidang();   
            $bidangs->nama_bidang = $bidang;   
            $bidangs->save();   
        }
    }

    private function getBidang()
    {
        return [
            'Presiden',
            'Sekjen',
            'Kementerian Pendidikan',
            'Kementerian Agama',
            'Kementerian Dalam Negeri',
            'Kementerian Luar Negeri',
            'Kementerian Keuangan',
            'Kementerian Pertahanan dan Keamanan',
            'Kementerian Kesejahteraan',
        ];
    }
}
