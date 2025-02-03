<?php
namespace Database\Factories;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartFactory extends Factory
{
    protected $model = Cart::class;

    public function definition()
    {
        return [
            'product_id' => Product::factory(),
            'user_id' => User::factory(),
            // 'order_id' => Order::factory(),
            'price' => $this->faker->randomFloat(2, 10, 500),
            'status' => $this->faker->randomElement(['new', 'progress', 'delivered', 'cancel']),
            'quantity' => $this->faker->numberBetween(1, 5),
            'amount' => fn (array $attr) => $attr['price'] * $attr['quantity'],
        ];
    }
}
