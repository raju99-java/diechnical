<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use App\Model\Franchise;
use Closure;

class Daysleft
{
    public function handle($request, Closure $next)

    {
        $id=Auth()->guard('franchise')->user()->id;
        $franchise = Franchise::where('id',$id)->where('type_id','=','3')->first();

            if($franchise->days_left == '0') {

                    return redirect()->route('franchise-dashboard');

            }


            return $next($request);

    }
}
