<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiHarian extends Model
{
    use HasFactory;

    protected $table = 't_transaksi_harian';

    protected $primaryKey = 'NO_RECORDS';

    public $timestamps = false;

    protected $fillable = [
        'STOCK_CODE', 'DATE_TRANSACTION', 'OPEN', 'HIGH', 'LOW', 'CLOSE',
        'CHANGE', 'VOLUME', 'VALUE', 'FREQUENCY'
    ];

    public function emiten()
    {
        return $this->belongsTo(Emiten::class, 'STOCK_CODE', 'STOCK_CODE');
    }
}
