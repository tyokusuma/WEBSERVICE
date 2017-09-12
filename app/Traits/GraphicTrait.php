<?php 

namespace App\Traits;

use App\Graphic;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

trait GraphicTrait 
{
	protected function add($type, User $user) {
		$graphicdate = Carbon::now()->toDateString();
        $findGraphic = Graphic::where('user_id', $user->id)->where('date', $graphicdate)->where('type', $type)->first();
        
        if($findGraphic == null) { //buat data graphic baru
            $graphic = new Graphic([
                    'user_id' => $user->id, 
                    'date' => $graphicdate,
                    'count_created' => 1,
                    'count_cancel' => 0,
                    'count_success' => 0,
                    'type' => $type,
                ]);
            $graphic->save();
        } else { //uda ada data graphic nya
            $findGraphic->count_created = $findGraphic->count_created + 1;
            $findGraphic->save();
        }
        return $status = 'OK';
	}

	protected function update($type, User $user, $status) {
		$findGraphic = Graphic::where('user_id', $user->id)->where('date', Carbon::now()->toDateString())->where('type', $type)->first();
        $errors = array();
        if($findGraphic == null) {
            $errors->not_found = 'Can\'t find the graphic data';
        }

        if($findGraphic->count_cancel == null) {
            $findGraphic->count_cancel = 0; 
        }

        if($status == 'cancel') {
            $findGraphic->count_cancel = $findGraphic->count_cancel + 1;
        } else {
            $findGraphic->count_success = $findGraphic->count_success + 1;
        }

        $findGraphic->save();

        if($errors == null) {
            return $errors;
        } else {
            return $status = 'OK';
        }
	}
}