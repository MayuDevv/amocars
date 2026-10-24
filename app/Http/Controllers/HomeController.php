<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $featuredCars = Car::with('images')->where('featured', true)->latest()->get();
        $cars = Car::with('images')->latest()->paginate(12)->withQueryString();

        $formatCar = static function (Car $car): array {
            return [
                'id' => $car->id,
                'brand' => $car->brand,
                'model' => $car->model,
                'year' => $car->year,
                'km' => $car->km,
                'fuel' => $car->fuel,
                'price' => $car->price,
                'description' => $car->description,
                'status' => $car->status,
                'images' => $car->images->map(fn ($image) => asset('storage/' . ltrim($image->image, '/')))->values(),
            ];
        };

        $pageData = [
            'featuredCars' => $featuredCars->map($formatCar)->values(),
            'cars' => $cars->getCollection()->map($formatCar)->values(),
            'pagination' => [
                'currentPage' => $cars->currentPage(),
                'lastPage' => $cars->lastPage(),
                'previousPageUrl' => $cars->previousPageUrl(),
                'nextPageUrl' => $cars->nextPageUrl(),
            ],
        ];

        return view('app', compact('pageData'));
    }
}
