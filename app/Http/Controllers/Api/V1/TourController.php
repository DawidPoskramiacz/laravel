<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Travel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TourResource;
use App\Http\Requests\ToursListRequest;

class TourController extends Controller
{
    public function index(Travel $travel, ToursListRequest $request)
    {
        $tours = $travel->tours()
        ->when($request->priceFrom, function ($query) use ($request){
            $query->where('price', '>=', $request->priceFrom*100);
        });

        return TourResource::collection($tours);
    }
}
