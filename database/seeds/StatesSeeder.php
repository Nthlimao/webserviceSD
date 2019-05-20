<?php

use Illuminate\Database\Seeder;
use App\State;

class StatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$states = [
            ['id' => 1,  'name' => 'Acre', 'initials' => 'AC'],
            ['id' => 2,  'name' => 'Alagoas', 'initials' => 'AL'],
            ['id' => 3,  'name' => 'Amazonas', 'initials' => 'AM'],
            ['id' => 4,  'name' => 'Amapá', 'initials' => 'AP'],
            ['id' => 5,  'name' => 'Bahia', 'initials' => 'BA'],
            ['id' => 6,  'name' => 'Ceará', 'initials' => 'CE'],
            ['id' => 7,  'name' => 'Distrito Federal', 'initials' => 'DF'],
            ['id' => 8,  'name' => 'Espírito Santo', 'initials' => 'ES'],
            ['id' => 9,  'name' => 'Goiás', 'initials' => 'GO'],
            ['id' => 10, 'name' =>  'Maranhão', 'initials' => 'MA'],
            ['id' => 11, 'name' =>  'Minas Gerais', 'initials' => 'MG'],
            ['id' => 12, 'name' =>  'Mato Grosso do Sul', 'initials' => 'MS'],
            ['id' => 13, 'name' =>  'Mato Grosso', 'initials' => 'MT'],
            ['id' => 14, 'name' =>  'Pará', 'initials' => 'PA'],
            ['id' => 15, 'name' =>  'Paraíba', 'initials' => 'PB'],
            ['id' => 16, 'name' =>  'Pernambuco', 'initials' => 'PE'],
            ['id' => 17, 'name' =>  'Piauí', 'initials' => 'PI'],
            ['id' => 18, 'name' =>  'Paraná', 'initials' => 'PR'],
            ['id' => 19, 'name' =>  'Rio de Janeiro', 'initials' => 'RJ'],
            ['id' => 20, 'name' =>  'Rio Grande do Norte', 'initials' => 'RN'],
            ['id' => 21, 'name' =>  'Rondônia', 'initials' => 'RO'],
            ['id' => 22, 'name' =>  'Roraima', 'initials' => 'RR'],
            ['id' => 23, 'name' =>  'Rio Grande do Sul', 'initials' => 'RS'],
            ['id' => 24, 'name' =>  'Santa Catarina', 'initials' => 'SC'],
            ['id' => 25, 'name' =>  'Sergipe', 'initials' => 'SE'],
            ['id' => 26, 'name' =>  'São Paulo', 'initials' => 'SP'],
            ['id' => 27, 'name' =>  'Tocantins', 'initials' => 'TO']
        ];

        State::insert($states);
    }
}
