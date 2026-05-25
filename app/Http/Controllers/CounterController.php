<?php

namespace App\Http\Controllers;

use App\Models\Counter;

class CounterController extends Controller
{
    public function getCount()
    {
        $counter = Counter::firstOrCreate(['id' => 1], ['count' => 0]);
        return response()->json(['count' => $counter->count]);
    }

    public function increment()
    {
        $counter = Counter::firstOrCreate(['id' => 1], ['count' => 0]);
        $counter->count++;
        $counter->save();
        return response()->json(['count' => $counter->count]);
    }
}
