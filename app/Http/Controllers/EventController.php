<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;


class EventController extends Controller
{
    public function createEvent()
    {
        return view('event');
    }
    public function store(Request $request)
    {
        $event= new Event();
        $event->title=$request->get('title');
        $event->start_date=$request->get('startdate');
        $event->end_date=$request->get('enddate');
        $event->save();
        return redirect('event')->with('success', 'Event has been added');
    }
    public function calender()
            {
                
                $cnt = 0;
                $events = [];
                $data = Event::all();
                
                if($data->count())
                 {
                    foreach ($data as $key => $value) 
                    {
                        $events[] = Calendar::event(
                            $value->title,
                            false,
                            new \DateTime($value->start_date),
                            new \DateTime($value->end_date),
                            null,
                            // Add color
                            [
                                'color' => $value->color,
                                'textColor' => '#000000'
                            ]
                        );
                    }
                }
                $calendar = Calendar::addEvents($events);
                // var_dump($calendar);

                return view('calendar', compact('calendar'));
            }
}
