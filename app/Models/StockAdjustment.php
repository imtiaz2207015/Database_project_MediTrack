<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class StockAdjustment extends Model
{
    protected $fillable = ['medicine_id','user_id','type','quantity','reason'];
    public function medicine() { return $this->belongsTo(Medicine::class); }
    public function user()     { return $this->belongsTo(User::class); }
}