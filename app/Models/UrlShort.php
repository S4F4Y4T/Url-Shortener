<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrlShort extends Model
{
    protected $table = 'url_short'; // Specify the table name

    protected $fillable = [
        'long_url', 'short_url', 'user_id', 'count'// Define the columns you want to be mass assignable
    ];
}
