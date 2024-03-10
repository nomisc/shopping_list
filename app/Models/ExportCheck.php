<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExportCheck extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = ['export_filename','export_checksum'];
}
