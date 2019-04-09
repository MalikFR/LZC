<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Alert;

class Kategori extends Model
{
    protected $table = 'kategoris';
    protected $fillable = ['nama'];
    public $timestamps = true;

    public function barang()
    {
        return $this->hasMany('App\Barang', 'kategori_id');
    }

    public static function boot()
    {
        parent::boot();


        self::deleting(function ($kategoris) {
            // mengecek apakah penulis masih punya buku
            if ($kategoris->barang->count() > 0) {
                // menyiapkan pesan error
                $html = 'Penulis tidak bisa dihapus karena masih memiliki buku : ';
                $html .= '<ul>';
                foreach ($kategoris->barang as $barangs) {
                    $html .= "<li>$barangs->title</li>";
                }
                $html .= '</ul>';


                Alert::Warning('Karena Masih ada barang', 'Tidak Bisa Menghapus')->autoclose(5000);

                // membatalkan proses penghapusan
                return false;
            }
        });
    }
}
