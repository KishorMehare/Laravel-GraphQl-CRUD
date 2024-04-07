<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return EventResource::collection(Event::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        $validatedData = $request->validated();
        $eventsReqData = $validatedData['events'];
        $dateTimeNow = now();
        $eventdata = [];

        foreach ($eventsReqData as $evdata){
            $evdata['created_at'] = $dateTimeNow;
            $evdata['updated_at'] = $dateTimeNow;
            $eventdata[]=$evdata;
        }
        $intValue = Event::insert($eventdata);
        return response()->json($intValue, 201);
    }


    /**
     * common function to convert seconds to hh:mm:sec.
     */

    public function sectoTime($seconds) {
        $t = round($seconds);
        return sprintf('%02d:%02d:%02d', ($t/3600),($t/60%60), $t%60);
    }
    /**
     * Display the specified resource.
     */
    public function StudTimeSpentPerActivity(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|array',
            'activity_id' => 'required|string'
        ]);

        $activity_id = $validatedData['activity_id'];
        $usrIds = '"'.implode('","', $validatedData['user_id']).'"';
        //dd($usrIds);
        $actTime = DB::select(/** @lang text */ 'select
                                    start_log.activity_id, start_log.user_id,
                                        SEC_TO_TIME(end_log.timestamp - start_log.timestamp) as timespan
                                    FROM
                                        events AS start_log
                                    INNER JOIN
                                        events AS end_log ON (
                                                    start_log.activity_id = end_log.activity_id
                                                    AND
                                                    start_log.user_id=end_log.user_id
                                                    AND
                                                    end_log.timestamp > start_log.timestamp)
                                    WHERE start_log.name = "start"
                                                AND ( end_log.name = "next" )
                                                AND
                                                start_log.activity_id=:activity_id1
                                                AND
                                                start_log.user_id IN ('.$usrIds.')
                                    GROUP BY start_log.activity_id , start_log.user_id',
                                ['activity_id1' => $activity_id]);
        return response()->json($actTime);

    }

    public function StudentActivity(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|array',
            'activity_id' => 'required|string'
        ]);

        $activity_id = $validatedData['activity_id'];
        $usrIds = '"' . implode('","', $validatedData['user_id']) . '"';
        $actTime = DB::select(/** @lang text */ "select * from events where activity_id=:activity_id and user_id IN ({$usrIds})",['activity_id'=>$activity_id]);

        $userQuizs=array();
        foreach ($actTime as $key=>$quez){
            $userQuizs[$quez->user_id][$key]['quiz_id']=$quez->id;
            $userQuizs[$quez->user_id][$key]['activity_id']=$quez->activity_id;
            $userQuizs[$quez->user_id][$key]['name']=$quez->name;
            $userQuizs[$quez->user_id][$key]['timestamp']=$quez->timestamp;

        }

        $studQuiz= array();
        foreach($userQuizs as $usrId=>$quiz){
            $iquiz=array_values($quiz);
            for($i=0;$i<count($quiz)-1;$i++){
                //dd($quiz[$i]['quiz_id']);
                $studQuiz[$usrId][$i]['quiz_id']=$iquiz[$i]['quiz_id'];
                $studQuiz[$usrId][$i]['activity_id']=$iquiz[$i]['activity_id'];
                $studQuiz[$usrId][$i]['name']=$iquiz[$i]['name'];
                $studQuiz[$usrId][$i]['timetaken'] = $this->sectoTime($iquiz[$i + 1]['timestamp'] - $iquiz[$i]['timestamp']);
            }
        }
        return response()->json($studQuiz);
    }

    public function averageActivity()
    {
        $events=array();
        $activity_ids = DB::table('events')->select('activity_id')->distinct()->get();
        foreach ($activity_ids as $actIds) {
            $actTime = DB::select(/** @lang text */ 'select
                                        start_log.activity_id, start_log.user_id,
                                        end_log.timestamp - start_log.timestamp as timespan
                                    FROM
                                        events AS start_log
                                    INNER JOIN
                                        events AS end_log ON (
                                                    start_log.activity_id = end_log.activity_id
                                                    AND
                                                    start_log.user_id=end_log.user_id
                                                    AND
                                                    end_log.timestamp > start_log.timestamp)
                                    WHERE start_log.name = "start"
                                                AND end_log.name = "stop"
                                                AND start_log.activity_id=:activity_id1
                                    GROUP BY
                                        start_log.activity_id , start_log.user_id',
                                ['activity_id1' => $actIds->activity_id]);
            if(!empty($actTime)) {
                $timeSpan = array_column($actTime, 'timespan');

                $avgTime = round(array_sum($timeSpan) / count($timeSpan));

                $events[$actIds->activity_id] = $this->sectoTime($avgTime);
            }
        }
        return response()->json($events);
    }

}
