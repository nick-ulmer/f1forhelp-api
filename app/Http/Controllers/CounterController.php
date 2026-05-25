<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use OpenApi\Attributes as OA;

#[OA\Info(title: "F1ForHelp API", version: "1.0.0")]
class CounterController extends Controller
{
    #[OA\Get(path: "/api/counter", summary: "Get current count")]
    #[OA\Response(response: 200, description: "Success")]
    public function getCount()
    {
        $counter = Counter::firstOrCreate(['id' => 1], ['count' => 0]);
        return response()->json(['count' => $counter->count]);
    }

    #[OA\Post(path: "/api/counter/increment", summary: "Increment the counter")]
    #[OA\Response(response: 200, description: "Success")]
    public function increment()
    {
        $counter = Counter::firstOrCreate(['id' => 1], ['count' => 0]);
        $counter->count++;
        $counter->save();
        return response()->json(['count' => $counter->count]);
    }
}
