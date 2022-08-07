<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Estate;
use App\Models\User;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['comment','user_id',
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
        'id','user'

    ];

}
