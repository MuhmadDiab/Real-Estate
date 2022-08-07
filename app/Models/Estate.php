<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estate extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates=['deleted_at'];
    use HasFactory;

    protected $table = "estates";

    protected $fillable = [

        'name',
        'description'   ,
        'roomnumber',
        'state',
        'price',
        'local',
        'lan',
        'lat',
        'bathroomnumber',
        'bedroomnumber',
       'propartytype',

    ];
    public function user()
    {
      return $this->belongsTo(User::class);

    }
    public function comment()
    {
      return $this->hasMany(Comment::class);
    }
    public function photo()
    {
      return $this->hasMany(Photo::class);
    }
    public function view()
    {
      return $this->hasMany(View::class);
    }

    public function like()
    {

      return $this->hasMany(Like::class);

    }
    //
    protected $hidden = [
        'updated_at',
        'created_at'
    ];
}
