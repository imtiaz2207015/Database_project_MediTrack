<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $fillable = [
        'customer_id','sale_id','doctor_name',
        'doctor_phone','notes','prescribed_date'
    ];
    public function customer() { return $this->belongsTo(Customer::class); }
    public function sale()     { return $this->belongsTo(Sale::class); }
}