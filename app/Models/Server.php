<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class Server extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
'location',
'serial_number',
'model',
'activate_date',
'status',
    ];
    protected function serializeDate(DateTimeInterface $date)
{
    return $date->format('Y-m-d H:i:s');
}
}
