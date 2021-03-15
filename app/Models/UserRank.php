<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRank extends Model
{
	use HasFactory;
	
    protected $table = 'user_rank';
	public $timestamps = false;
	
	protected $fillable = [
        'rank', 'name', 'default',
    ];
}
