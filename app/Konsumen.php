<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Alert;

class Konsumen extends Model
{
    protected $table = 'konsumens';
    protected $fillable = ['nik', 'nama', 'nohp', 'alamat'];
    public $timestamps = true;

    public function Peminjaman()
    {
        return $this->hasMany('App\Peminjaman');
    }

    public static function boot()
    {
        parent::boot();


        self::deleting(function ($konsumens) {
            // mengecek apakah penulis masih punya buku
            if ($konsumens->Peminjaman->count() > 0) {
                // menyiapkan pesan error
                $html = 'Penulis tidak bisa dihapus karena masih memiliki buku : ';
                $html .= '<ul>';
                foreach ($konsumens->Peminjaman as $peminjamans) {
                    $html .= "<li>$peminjamans->title</li>";
                }
                $html .= '</ul>';


                Alert::Warning('Karena Konsumen Masih Rental', 'Tidak Bisa Menghapus')->autoclose(5000);

                // membatalkan proses penghapusan
                return false;
            }
        });
    }
}
