<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\MerkTabung;
use Ramsey\Uuid\Uuid;

class MerkTabungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MerkTabung::truncate();
        $this->insertMerkTabung();
    }

    private function insertMerkTabung()
    {
        $record = [
            'Alpindo',
            'Altex',
            'Amerex',
            'Bucky',
            'Chubb',
            'Eversafe',
            'Fire Indo',
            'Gunnebo',
            'Hartindo',
            'Hatsuta',
            'Newvo',
            'Protect',
            'Royal',
            'Saverex',
            'Servvo',
            'Solingen',
            'Sonick',
            'Starvvo',
            'Viking',
            'Yamato',
            'Guard All',
            'Combat',
            'Tonata',
            'Montana',
            'Brand Lokal Lain',
        ];

        $data = [];
        foreach($record as $item) {
            $data[] = [
                'uuid' => Uuid::uuid4()->toString(),
                'nama_merk' => $item
            ];
        }

        DB::table('merk_tabung')->insert($data);
    }
}
