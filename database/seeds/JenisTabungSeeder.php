<?php

use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\DB;
use App\JenisTabung;

class JenisTabungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JenisTabung::truncate();
        $this->insertJenisTabung();
    }

    private function insertJenisTabung()
    {
        $record = [
            'Powder',
            'Clean Agent',
            'CO2',
        ];

        $data = [];
        foreach($record as $item) {
            $data[] = [
                'uuid' => Uuid::uuid4()->toString(),
                'nama_tabung' => $item
            ];
        }

        DB::table('jenis_tabung')->insert($data);
    }
}
