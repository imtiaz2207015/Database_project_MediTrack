<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    protected $fillable = ['purchase_id','medicine_id','quantity','unit_price','subtotal'];
    public function medicine()  { return $this->belongsTo(Medicine::class); }
    public function purchase()  { return $this->belongsTo(Purchase::class); }
}