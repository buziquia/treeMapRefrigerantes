<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TreeMapController extends Controller
{
    public function index()
    {
        $data = [
            [
                "name" => "Refrigerantes",
                "children" => [
                    [
                        "name" => "Coca-Cola",
                        "size" => 100,
                        "color" => "green",
                        "previous_sales" => 90,
                        "growth_percentage" => 11.11,
                    ],
                    [
                        "name" => "Pepsi",
                        "size" => 85,
                        "color" => "green",
                        "previous_sales" => 70,
                        "growth_percentage" => 21.43,
                    ],
                    [
                        "name" => "Fanta",
                        "size" => 70,
                        "color" => "green",
                        "previous_sales" => 60,
                        "growth_percentage" => 16.67,
                    ],
                    [
                        "name" => "Sprite",
                        "size" => 40,
                        "color" => "red",
                        "previous_sales" => 80,
                        "growth_percentage" => -50,
                    ],
                    [
                        "name" => "Dr Pepper",
                        "size" => 30,
                        "color" => "red",
                        "previous_sales" => 35,
                        "growth_percentage" => -14.29,
                    ],
                    [
                        "name" => "7UP",
                        "size" => 25,
                        "color" => "red",
                        "previous_sales" => 30,
                        "growth_percentage" => -16.67,
                    ],
                ],
            ],
        ];

        return view('tree_map', [
            'data' => json_encode($data)
        ]);
    }
}
