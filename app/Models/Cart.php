<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Abbasudo\Purity\Traits\Filterable;
use Abbasudo\Purity\Traits\Sortable;

class Cart extends Model
{
    use HasFactory;
    use Searchable;
    use Filterable;
    use Sortable;

    protected $fillable = [
        'product_id',
        // 'order_id',
        'user_id',
        'price',
        'status',
        'quantity',
        'amount'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function order()
    // {
    //     return $this->belongsTo(Order::class);
    // }
}



