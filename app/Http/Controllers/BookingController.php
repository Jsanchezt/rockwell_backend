<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Notifications\ReservationReceivedAdminNotification;
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
            $temporalUser = new TemporalUser($request->get('email'));
            $admin = new TemporalUser('char2296@hotmail.com');

            $temporalUser->notify(new ReservationReceivedNotification(
                implode(',',$this->getServices($request->all())),
                $request->get('staff'), $request->get('date'),
                $request->get('select_time'), $request->get('name'),
                $request->get('email'), $request->get('phone'),
                $request->get('message')
            ));

            $admin->notify(new ReservationReceivedAdminNotification(
                implode(',',$this->getServices($request->all())),
                $request->get('staff'), $request->get('date'),
                $request->get('select_time'), $request->get('name'),
                $request->get('email'), $request->get('phone'),
                $request->get('message')
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

    function index(){
        return Booking::where('date', date("Y-m-d") )->orderBy('id', 'desc')->get();
    }


    function index_by_date($date){
        return Booking::where('date', $date )->orderBy('id', 'desc')->get();
    }


}
