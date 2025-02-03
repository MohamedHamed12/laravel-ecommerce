<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

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


//         Schema::create('carts', function (Blueprint $table) {
//             $table->id();
//             $table->unsignedBigInteger('product_id');
//             $table->unsignedBigInteger('order_id')->nullable();
//             $table->unsignedBigInteger('user_id')->nullable();
//             $table->float('price');
//             $table->enum('status',['new','progress','delivered','cancel'])->default('new');
//             $table->integer('quantity');
//             $table->float('amount');
//             $table->foreign('product_id')->references('id')->on('products')->onDelete('CASCADE');
//             $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
//             $table->foreign('order_id')->references('id')->on('orders')->onDelete('SET NULL');
//             $table->timestamps();
