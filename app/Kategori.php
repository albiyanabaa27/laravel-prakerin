<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
class Kategori extends Model
{
    protected $fillable = ['nama_kategori', 'slug'];
    public $timestamps = true;

    public function artikel() {
        return $this->hasMany('App\Artikel', 'id_kategori');
    }

    public function getRouteKeyName() {
        return 'slug';
    }

    // public static function boot() {
	// 	parent::boot();
	// 	self::deleting(function($kategori) {
	// 	// mengecek apakah artikel tercantum dengan kategori tersebut
	// 	if ($kategori->artikel->count() > 0) {
	// 	// menyiapkan pesan error
	// 	$html = 'Kategori tidak bisa dihapus karena masih memiliki artikel!';
	// 	$html .= '<ul>';
	// 		foreach ($kategori->artikel as $data)
	// 		{
	// 			$html .= "$data->judul";
	// 		}
	// 		$html .= '</ul>';
	// 		Session::flash("flash_notification", [
	// 		"level"=>"danger",
	// 		"message"=>$html
	// 		]);
	// 		// membatalkan proses penghapusan
	// 		return false;
	// 		}
	// 	});
	// }
}
