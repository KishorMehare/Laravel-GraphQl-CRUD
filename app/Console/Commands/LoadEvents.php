<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;

class LoadEvents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:load-events';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command: To load Events from Json to DB table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $json = '[
            {
              "name": "start",
              "timestamp": 1534182206,
              "user_id": "user134",
              "activity_id": "Math-1"
            },
            {
              "name": "next",
              "timestamp": 1534182306,
              "user_id": "user134",
              "activity_id": "Math-1"
            },
            {
              "name": "next",
              "timestamp": 1534182396,
              "user_id": "user134",
              "activity_id": "Math-1"
            },
            {
              "name": "next",
              "timestamp": 1534183306,
              "user_id": "user134",
              "activity_id": "Math-1"
            },
            {
              "name": "stop",
              "timestamp": 1534183409,
              "user_id": "user134",
              "activity_id": "Math-1"
            },
            {
              "name": "start",
              "timestamp": 1534182206,
              "user_id": "user144",
              "activity_id": "Math-1"
            },
            {
              "name": "start",
              "timestamp": 1534182207,
              "user_id": "user135",
              "activity_id": "Math-1"
            },
            {
              "name": "next",
              "timestamp": 1534182306,
              "user_id": "user144",
              "activity_id": "Math-1"
            },
            {
              "name": "next",
              "timestamp": 1534182306,
              "user_id": "user135",
              "activity_id": "Math-1"
            },
            {
              "name": "next",
              "timestamp": 1534182396,
              "user_id": "user144",
              "activity_id": "Math-1"
            },
            {
              "name": "next",
              "timestamp": 1534183306,
              "user_id": "user144",
              "activity_id": "Math-1"
            },
            {
              "name": "next",
              "timestamp": 1534182396,
              "user_id": "user135",
              "activity_id": "Math-1"
            },
            {
              "name": "next",
              "timestamp": 1534183306,
              "user_id": "user135",
              "activity_id": "Math-1"
            },
            {
              "name": "stop",
              "timestamp": 1534183609,
              "user_id": "user135",
              "activity_id": "Math-1"
            },
            {
              "name": "stop",
              "timestamp": 1534184409,
              "user_id": "user144",
              "activity_id": "Math-1"
            },
            {
              "name": "start",
              "timestamp": 1534182206,
              "user_id": "user164",
              "activity_id": "Math-1"
            },
            {
              "name": "start",
              "timestamp": 1534182206,
              "user_id": "user164",
              "activity_id": "Math-1"
            },
            {
              "name": "next",
              "timestamp": 1534183306,
              "user_id": "user137",
              "activity_id": "eng-4.1"
            },
            {
              "name": "start",
              "timestamp": 1534182207,
              "user_id": "user137",
              "activity_id": "Math-1"
            },
            {
              "name": "next",
              "timestamp": 1534182306,
              "user_id": "user164",
              "activity_id": "Math-1"
            },
            {
              "name": "start",
              "timestamp": 1534182207,
              "user_id": "user137",
              "activity_id": "eng-4.1"
            },
            {
              "name": "next",
              "timestamp": 1534182306,
              "user_id": "user137",
              "activity_id": "Math-1"
            },
            {
              "name": "next",
              "timestamp": 1534183306,
              "user_id": "user164",
              "activity_id": "Math-1"
            },
            {
              "name": "next",
              "timestamp": 1534182396,
              "user_id": "user137",
              "activity_id": "Math-1"
            },
            {
              "name": "stop",
              "timestamp": 1534183459,
              "user_id": "user164",
              "activity_id": "eng-4.1"
            },
            {
              "name": "next",
              "timestamp": 1534183306,
              "user_id": "user137",
              "activity_id": "Math-1"
            },
            {
              "name": "start",
              "timestamp": 1534182206,
              "user_id": "user164",
              "activity_id": "eng-4.1"
            },
            {
              "name": "stop",
              "timestamp": 1534183409,
              "user_id": "user137",
              "activity_id": "Math-1"
            },
            {
              "name": "stop",
              "timestamp": 1534183409,
              "user_id": "user164",
              "activity_id": "Math-1"
            },
            {
              "name": "next",
              "timestamp": 1534182396,
              "user_id": "user164",
              "activity_id": "Math-1"
            },
            {
              "name": "next",
              "timestamp": 1534182306,
              "user_id": "user137",
              "activity_id": "eng-4.1"
            },
            {
              "name": "next",
              "timestamp": 1534182396,
              "user_id": "user164",
              "activity_id": "eng-4.1"
            },
            {
              "name": "next",
              "timestamp": 1534183306,
              "user_id": "user164",
              "activity_id": "eng-4.1"
            },
            {
              "name": "stop",
              "timestamp": 1534183409,
              "user_id": "user137",
              "activity_id": "eng-4.1"
            },
            {
              "name": "start",
              "timestamp": 1534182206,
              "user_id": "user134",
              "activity_id": "geo-2-3"
            },
            {
              "name": "next",
              "timestamp": 1534182306,
              "user_id": "user134",
              "activity_id": "geo-2-3"
            },
            {
              "name": "start",
              "timestamp": 1534182206,
              "user_id": "user139",
              "activity_id": "geo-2-3"
            },
            {
              "name": "start",
              "timestamp": 1534182206,
              "user_id": "user139",
              "activity_id": "eng-4.1"
            },
            {
              "name": "next",
              "timestamp": 1534182396,
              "user_id": "user134",
              "activity_id": "geo-2-3"
            },
            {
              "name": "next",
              "timestamp": 1534182400,
              "user_id": "user134",
              "activity_id": "geo-2-3"
            },
            {
              "name": "next",
              "timestamp": 1534183316,
              "user_id": "user134",
              "activity_id": "geo-2-3"
            },
            {
              "name": "start",
              "timestamp": 1534182206,
              "user_id": "user122",
              "activity_id": "geo-2-3"
            },
            {
              "name": "stop",
              "timestamp": 1534183629,
              "user_id": "user134",
              "activity_id": "geo-2-3"
            },
             {
              "name": "next",
              "timestamp": 1534182396,
              "user_id": "user139",
              "activity_id": "eng-4.1"
            },
            {
              "name": "stop",
              "timestamp": 1534183409,
              "user_id": "user139",
              "activity_id": "eng-4.1"
            },
            {
              "name": "next",
              "timestamp": 1534183306,
              "user_id": "user139",
              "activity_id": "eng-4.1"
            },
            {
              "name": "next",
              "timestamp": 1534182410,
              "user_id": "user122",
              "activity_id": "geo-2-3"
            },
            {
              "name": "next",
              "timestamp": 1534183306,
              "user_id": "user122",
              "activity_id": "geo-2-3"
            },
            {
              "name": "next",
              "timestamp": 1534182396,
              "user_id": "user122",
              "activity_id": "geo-2-3"
            },
            {
              "name": "next",
              "timestamp": 1534182309,
              "user_id": "user122",
              "activity_id": "geo-2-3"
            },
            {
              "name": "stop",
              "timestamp": 1534183449,
              "user_id": "user122",
              "activity_id": "geo-2-3"
            }

        ]';

        //convert json into associative array
        $data = json_decode($json, true);

        foreach ($data as $item) {
            // insert event from above json
            $events= Event::insert($item);

        }
    }
}
