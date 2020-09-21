<?php

namespace Database\Seeders;

use App\Models\WaGroup;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WaGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $waGroup = new WaGroup();
        $waGroup->segmentations_id = DB::table('segmentations')->get(['id'])->last()->id;
        $waGroup->name = 'Riqueza Digital 28/09 G1';
        $waGroup->description = '🟡 ATENÇÃO AQUI. Esse Grupo é Para Você Receber os Avisos e Links das Aulas da Semana da Riqueza Digital

        Dia e Horário da Aulas
        Aula 1️⃣ - SEG - 05/10 - 20h 🕣
        Aula 2️⃣ - TER - 06/10 - 20h 🕣
        Aula 3️⃣ - QUA - 07/10 - 20h 🕣
        Aula 4️⃣ - QUI - 08/10 - 20h 🕣
        
        As aulas são Ao Vivo e Gratuitas
        
        Você vai aprender o que precisa fazer para finalmente conseguir ganhar dinheiro pela internet mais rápido com menos esforço.';
        $waGroup->edit_data = 'only_admins';
        $waGroup->send_message = 'only_admins';
        $waGroup->seats = 200;
        $waGroup->image_path = 'groups/1/JvROgKK3NDk2zjuboNlzOZcX5wzC6ROnbyt22MxP.png';
        $waGroup->save();
    }
}
