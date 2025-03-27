<?php

namespace App\Http\Controllers;

use App\Exceptions\Nip05NotFoundException;
use App\Models\nip05;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class Nip05Controller extends Controller
{
    public function resolve(Request $request)
    {
        $name = $request->input('name');
        try {
            // Attempt to retrieve the original URL from the cache
            $identify = Cache::remember($name, now()->addDays(14), function () use ($name) {
                Log::info("Looking up $name");
                $data = nip05::whereName($name)->first();
                if(!$data){
                  throw new Nip05NotFoundException();
                }
                return $data;
            });

        }catch(\Exception $e){
            return response(['message' => "not here!!!!"], 404);
        }

        if(!$identify)
            return response(['message' => "not here!!!"], 404);

        return response()->json([$identify->name => $identify->pubkey], 200, [], JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);
    }
}


