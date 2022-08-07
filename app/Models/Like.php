<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Estate;
class Like extends Model
{
    use HasFactory;
    protected $fillable = ['user_id',
    'estate_id'];
    public function user()
    {
      return $this->belongsTo(User::class);

    }
    public function estate()
    {
      return $this->belongsTo(Estate::class);

    }
    protected $hidden = [

        'created_at',
        'updated_at',

    ];
}
