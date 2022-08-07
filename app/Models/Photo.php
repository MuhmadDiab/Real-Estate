<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Estate;
class Photo extends Model
{
  use HasFactory;
  protected $fillable = [ 'photo','estate_id'];
  public function estate()
  {
    return $this->belongsTo(Estate::class);
  }
  protected $hidden = 
  [
    'created_at',
    'updated_at',
  ];
}