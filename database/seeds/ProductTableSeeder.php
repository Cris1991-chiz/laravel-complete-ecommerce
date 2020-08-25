<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 25; $i++) {
        Product::create([      
            'name' => 'Phantom 3 Standard Quadcopter Drone with 2.7K HD Video Camera' . $i,
            'slug' => 'drone1-' . $i,
            'brand' => 'DJI',
            'details' => '2.7K video and 12MP stills from the 3-axis stabilized integrated camera.',
            'price' => 1599.99,
            'image' => 'drone1.jpg',
        ]);
        }

        for($i = 1; $i <= 5; $i++) {
        Product::create([
            'name' => 'DJI Spark, Fly More Combo, Red' . $i,
            'slug' => 'drone2-' . $i,
            'brand' => 'DJI',
            'details' => '2-Axis Stabilized Gimbal Camera 12MP Still Photos / 1080p/30 Video Gesture.',
            'price' => 567.95,
            'image' => 'drone2.jpg',   
        ]);
        }

        for($i = 1; $i <= 5; $i++) {
        Product::create([
            'name' => 'Spark Fly More Combo, Alpine White' . $i,
            'slug' => 'drone3-' . $i,
            'brand' => 'DJI',
            'details' => 'Intelligent Flight ModesSmart, reliable, and incredibly intuitiveQuickShotVideos.',
            'price' => 567.95,
            'image' => 'drone3.jpg',   
        ]);
        }
        
        for($i = 1; $i <= 4; $i++) {
        Product::create([
            'name' => 'Phantom 3 Standard Quadcopter Drone with 2.7K HD Video Camera' . $i,
            'slug' => 'drone4-' . $i,
            'brand' => 'DJI',
            'details' => '2.7K video and 12MP stills from the 3-axis stabilized integrated camera.',
            'price' => 1599.99,
            'image' => 'drone4.jpg',   
        ]);
        }
        
        for($i = 1; $i <= 3; $i++) {
        Product::create([
            'name' => 'Phantom 3 Advanced Renewed Unit (Renewed)' . $i,
            'slug' => 'drone5-' . $i,
            'brand' => 'DJI',
            'details' => 'Advanced Quadcopter Drone with 2.7K HD Video Camera offers up to 23 minutes flying time.',
            'price' => 1799.99,
            'image' => 'drone5.jpg',     
        ]);
        }
        
        for($i = 1; $i <= 2; $i++) {
        Product::create([
            'name' => 'Inspire 2 Drone Compatible with 5.2K Gimbal Cameras' . $i,
            'slug' => 'drone6-' . $i,
            'brand' => 'DJI',
            'details' => 'Intelligent flight modes. Obstacle Sensing Range : 0-16.4 feet (0-5 m).',
            'price' => 3299.00,
            'image' => 'drone6.jpg',          
        ]);
        }
        
        for($i = 1; $i <= 5; $i++) {
        Product::create([
            'name' => 'Mavic 2 Pro UAV with Hasselblad Camera 3-Axis Gimbal HDR 4K Video' . $i,
            'slug' => 'drone7-' . $i,
            'brand' => 'DJI',
            'details' => 'Equipped with a Hasselblad L1D-20c camera with a 20MP 1” CMOS Sensor.',
            'price' => 1354.00,
            'image' => 'drone7.jpg',    
        ]);
        }
        
        for($i = 1; $i <= 4; $i++) {
        Product::create([
            'name' => 'Spark Remote Control Combo (White)' . $i,
            'slug' => 'drone8-' . $i,
            'brand' => 'DJI',
            'details' => '2-Axis Stabilized Gimbal Camera 12MP Still Photos/ 1080P/30 Video gesture.',
            'price' => 545.00,
            'image' => 'drone8.jpg',   
        ]);
        }       
    }
}
