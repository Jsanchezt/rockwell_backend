<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Notifications\ReservationReceivedNotification;
use Illuminate\Http\Request;
use App\TemporalUser;

class BookingController extends Controller
{
    /**
     * @throws BookingController
     */
    public function store(Request $request){
        $booking = new Booking();
        $booking->fill($request->all());
        $booking->service = implode(',',$this->getServices($request->all()));
        $booking->save();

        /** @var TYPE_NAME $exception */
        try {
            $temporalUser = new TemporalUser($request->all('email'));

            $temporalUser->notify(new ReservationReceivedNotification(
                implode(',',$this->getServices($request->all())),
                $request->all('staff'), $request->all('date'),
                $request->all('selectTime'), $request->all('name'),
                $request->all('email'), $request->all('phone'),
                $request->all('message')
            ));

        } catch (\Exception $exception){
            info($exception->getMessage());
        }

        return response()->json(["result"=>"success"]);
    }


    function getServices($array) {
        return array_filter($array, function($key) {
            return strpos($key, 'service') === 0;
        }, ARRAY_FILTER_USE_KEY);
    }

}
