<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FoodpandaController extends Controller
{
    /**
     * Home page.
     */
    public function home()
    {
        $restaurants = $this->getSampleRestaurants();
        
        return view('home', [
            'restaurants' => $restaurants,
        ]);
    }

    /**
     * Dashboard for authenticated users.
     */
    public function dashboard()
    {
        return view('dashboard', [
            'user' => Auth::user(),
            'restaurants' => $this->getSampleRestaurants(),
        ]);
    }

    /**
     * Restaurant listing page.
     */
    public function restaurants()
    {
        return view('restaurants', [
            'restaurants' => $this->getSampleRestaurants(),
        ]);
    }

    /**
     * Menu page.
     */
    public function menu($restaurantId)
    {
        $restaurants = collect($this->getSampleRestaurants());
        $restaurant = $restaurants->firstWhere('id', (int) $restaurantId);

        if (!$restaurant) {
            return redirect()->route('restaurants')->with('error', 'Restaurant not found');
        }

        return view('menu', [
            'restaurant' => $restaurant,
            'menuItems' => $this->getMenuItems($restaurantId),
        ]);
    }

    /**
     * Orders page.
     */
    public function orders()
    {
        return view('orders', [
            'orders' => session('orders', []),
        ]);
    }

    /**
     * Add to order.
     */
    public function addToOrder(Request $request)
    {
        $itemId = $request->input('item_id');
        $restaurantId = $request->input('restaurant_id');
        
        $menuItems = collect($this->getMenuItems($restaurantId));
        $item = $menuItems->firstWhere('id', $itemId);

        if ($item) {
            $orders = session('orders', []);
            $key = "{$restaurantId}_{$itemId}";
            
            if (isset($orders[$key])) {
                $orders[$key]['quantity']++;
            } else {
                $orders[$key] = [
                    'item' => $item,
                    'restaurant_id' => $restaurantId,
                    'quantity' => 1,
                ];
            }
            session(['orders' => $orders]);
        }

        return back()->with('success', 'Item added to order!');
    }

    /**
     * Get sample restaurants.
     */
    private function getSampleRestaurants(): array
    {
        return [
            [
                'id' => 1,
                'name' => 'Pizza Palace',
                'cuisine' => 'Italian',
                'rating' => 4.5,
                'delivery_time' => '25-35 min',
                'image' => 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=300',
                'description' => 'Authentic Italian pizzas baked in a wood-fired oven.',
            ],
            [
                'id' => 2,
                'name' => 'Burger Barn',
                'cuisine' => 'American',
                'rating' => 4.3,
                'delivery_time' => '20-30 min',
                'image' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=300',
                'description' => 'Juicy gourmet burgers with premium toppings.',
            ],
            [
                'id' => 3,
                'name' => 'Sushi Supreme',
                'cuisine' => 'Japanese',
                'rating' => 4.8,
                'delivery_time' => '30-40 min',
                'image' => 'https://images.unsplash.com/photo-1579871494447-9811cf80d66c?w=300',
                'description' => 'Fresh sushi and sashimi prepared by expert chefs.',
            ],
            [
                'id' => 4,
                'name' => 'Taco Town',
                'cuisine' => 'Mexican',
                'rating' => 4.4,
                'delivery_time' => '15-25 min',
                'image' => 'https://images.unsplash.com/photo-1565299507177-b0ac66763828?w=300',
                'description' => 'Authentic Mexican tacos and burritos.',
            ],
            [
                'id' => 5,
                'name' => 'Curry House',
                'cuisine' => 'Indian',
                'rating' => 4.6,
                'delivery_time' => '35-45 min',
                'image' => 'https://images.unsplash.com/photo-1585937421612-70a008356fbe?w=300',
                'description' => 'Rich and flavorful Indian curries and biryanis.',
            ],
            [
                'id' => 6,
                'name' => 'Noodle House',
                'cuisine' => 'Chinese',
                'rating' => 4.2,
                'delivery_time' => '25-35 min',
                'image' => 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?w=300',
                'description' => 'Traditional Chinese noodles and dim sum.',
            ],
        ];
    }

    /**
     * Get menu items for a restaurant.
     */
    private function getMenuItems($restaurantId): array
    {
        $menus = [
            1 => [ // Pizza Palace
                ['id' => 1, 'name' => 'Margherita Pizza', 'price' => 12.99, 'description' => 'Fresh tomatoes, mozzarella, basil'],
                ['id' => 2, 'name' => 'Pepperoni Pizza', 'price' => 14.99, 'description' => 'Classic pepperoni with cheese'],
                ['id' => 3, 'name' => 'Vegetarian Pizza', 'price' => 13.99, 'description' => 'Mixed vegetables, olives'],
            ],
            2 => [ // Burger Barn
                ['id' => 1, 'name' => 'Classic Burger', 'price' => 9.99, 'description' => 'Beef patty, lettuce, tomato'],
                ['id' => 2, 'name' => 'Cheese Burger', 'price' => 11.99, 'description' => 'Double cheese, pickles'],
                ['id' => 3, 'name' => 'Bacon Burger', 'price' => 13.99, 'description' => 'Crispy bacon, BBQ sauce'],
            ],
            3 => [ // Sushi Supreme
                ['id' => 1, 'name' => 'California Roll', 'price' => 8.99, 'description' => 'Crab, avocado, cucumber'],
                ['id' => 2, 'name' => 'Salmon Sashimi', 'price' => 14.99, 'description' => 'Fresh salmon slices'],
                ['id' => 3, 'name' => 'Tuna Roll', 'price' => 10.99, 'description' => 'Fresh tuna, rice, nori'],
            ],
            4 => [ // Taco Town
                ['id' => 1, 'name' => 'Beef Taco', 'price' => 3.99, 'description' => 'Ground beef, salsa, cheese'],
                ['id' => 2, 'name' => 'Chicken Burrito', 'price' => 8.99, 'description' => 'Grilled chicken, beans, rice'],
                ['id' => 3, 'name' => 'Quesadilla', 'price' => 7.99, 'description' => 'Cheese, peppers, onions'],
            ],
            5 => [ // Curry House
                ['id' => 1, 'name' => 'Chicken Tikka', 'price' => 13.99, 'description' => 'Tender chicken in creamy sauce'],
                ['id' => 2, 'name' => 'Lamb Biryani', 'price' => 15.99, 'description' => 'Spiced rice with lamb'],
                ['id' => 3, 'name' => 'Paneer Butter', 'price' => 11.99, 'description' => 'Cottage cheese in tomato gravy'],
            ],
            6 => [ // Noodle House
                ['id' => 1, 'name' => 'Chow Mein', 'price' => 10.99, 'description' => 'Stir-fried noodles, vegetables'],
                ['id' => 2, 'name' => 'Kung Pao Chicken', 'price' => 12.99, 'description' => 'Spicy chicken, peanuts'],
                ['id' => 3, 'name' => 'Dim Sum Platter', 'price' => 14.99, 'description' => 'Assorted dumplings'],
            ],
        ];

        return $menus[$restaurantId] ?? [];
    }
}
