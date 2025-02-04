<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class CartControllerTest extends TestCase
{
    use RefreshDatabase;

    // Test for fetching all carts
    public function test_can_get_all_carts()
    {
        // Act: Call the API endpoint to get carts
        $response = $this->getJson('/api/carts');

        // Assert: Check if the response is successful and contains the expected number of carts
        $response->assertStatus(Response::HTTP_OK);
    }

    // // Test for adding a cart item
    public function test_can_add_cart_item()
    {
        // Arrange: Create a product, user, and order
        $product = Product::factory()->create();
        $user = User::factory()->create();
        // $order = Order::factory()->create()/;

        // Act: Send a POST request to create a cart item
        $response = $this->postJson('/api/carts', [
            'product_id' => $product->id,
            'user_id' => $user->id,
            // 'order_id' => $order->id,
            'price' => 100.0,
            'quantity' => 2,
            'amount' => 200.0,
            'status' => 'new',
        ]);

    //     // Assert: Check if the cart item was created successfully
        $response->assertStatus(Response::HTTP_CREATED)
                 ->assertJson([
                     'product_id' => $product->id,
                     'user_id' => $user->id,
                    //  'order_id' => $order->id,
                     'price' => 100.0,
                     'quantity' => 2,
                     'amount' => 200.0,
                     'status' => 'new',
                 ]);
    }

    // // Test for fetching a single cart item
    public function test_can_get_single_cart_item()
    {
        // Arrange: Create a cart item
        $cart = Cart::factory()->create();

        // Act: Call the endpoint to get the specific cart
        $response = $this->getJson('/api/carts/' . $cart->id);

        // Assert: Check if the response contains the cart data
        $response->assertStatus(Response::HTTP_OK)
                 ->assertJson([
                     'id' => $cart->id,
                     'product_id' => $cart->product_id,
                     'user_id' => $cart->user_id,
                    //  'order_id' => $cart->order_id,
                     'price' => $cart->price,
                     'quantity' => $cart->quantity,
                    //  'amount' => $cart->amount,
                     'status' => $cart->status,
                 ]);
    }

    // // Test for updating a cart item
    // public function test_can_update_cart_item()
    // {
    //     // Arrange: Create a cart item
    //     $cart = Cart::factory()->create();

    //     // Act: Send a PUT request to update the cart item
    //     $response = $this->putJson('/api/carts/' . $cart->id, [
    //         'quantity' => 5,  // Update the quantity
    //         'amount' => 500.0, // Update the amount
    //     ]);

    //     // Assert: Check if the cart item was updated successfully
    //     $response->assertStatus(Response::HTTP_OK)
    //              ->assertJson([
    //                  'id' => $cart->id,
    //                  'quantity' => 5,
    //                  'amount' => 500.0,
    //              ]);
    // }

    // // Test for deleting a cart item
    public function test_can_delete_cart_item()
    {
        // Arrange: Create a cart item
        $cart = Cart::factory()->create();

        // Act: Send a DELETE request to delete the cart item
        $response = $this->deleteJson('/api/carts/' . $cart->id);

        // Assert: Check if the cart item was deleted successfully
        $response->assertStatus(Response::HTTP_OK)
                 ->assertJson([
                     'message' => 'Cart item deleted successfully'
                 ]);

        // Assert: Ensure the cart item no longer exists in the database
        $this->assertDatabaseMissing('carts', ['id' => $cart->id]);
    }

    // // Test validation failure (missing required fields)
    public function test_validation_fails_when_required_fields_are_missing()
    {
        // Act: Send a POST request without necessary fields
        $response = $this->postJson('/api/carts', []);

        // Assert: Ensure validation errors are returned
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
                 ->assertJsonValidationErrors(['product_id', 'price', 'quantity']);
    }
}
