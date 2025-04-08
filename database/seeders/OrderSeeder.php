<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\User;
use App\Models\Menu;

class OrderSeeder extends Seeder
{
    public function run()
    {
      
        $users = User::all();
        $menus = Menu::all();

      
        if ($users->isEmpty() || $menus->isEmpty()) {
            return; 
        }

        foreach ($users as $user) {
            foreach ($menus as $menu) { 
                Order::create([
                    'user_id' => $user->id,
                    'menu_id' => $menu->id,
                    'amount' => rand(1, 5), 
                    'total_price' => $menu->price * rand(1, 5),
                    'status' => 'sedang dikerjakan',
                ]);
            }
        }
    }
}
