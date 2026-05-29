<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $fillable = [
        'category_id','supplier_id','name','generic_name',
        'brand','dosage_form','strength','price','stock_quantity',
        'reorder_level','expiry_date','batch_number','description'
    ];

    public function category() { return $this->belongsTo(Category::class); }
    public function supplier()  { return $this->belongsTo(Supplier::class); }
    public function saleItems() { return $this->hasMany(SaleItem::class); }
    public function purchaseItems() { return $this->hasMany(PurchaseItem::class); }
    public function stockAdjustments() { return $this->hasMany(StockAdjustment::class); }
}