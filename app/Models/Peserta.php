<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kegiatan;

class Peserta extends Model
{
  use HasFactory;

  public const STATUS_ABSEN = [
    1 => 'Hadir',
    0 => 'Belum Hadir',
  ];

  public $table = 'peserta';

  protected $fillable = [
    'nama_peserta',
    'asal_instansi',
    'no_tlp',
    'no_peserta',
    'no_urut',
    'kegiatan_id',
    'status_absen',
  ];

  public function getStatusAbsenAliasAttribute()
  {
    return self::STATUS_ABSEN[$this->status_absen] ?? null;
  }

  // public function kegiatan()
  // {
  //   return $this->belongsTo(Kegiatan::class);
  // }

  // public function pendaftaran()
  // {
  //   return $this->belongsTo(Pendaftaran::class);
  // }
}
