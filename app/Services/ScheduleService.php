<?php
namespace App\Services;

class ScheduleService
{
    public function parseToViewEvent($schedules)
    {
        $result = [];
        foreach ($schedules as $schedule) {
            $start_time = $end_time = [];
            foreach ($schedule->scheduleFrames as $scheduleFrame) {    
                array_push($start_time, $scheduleFrame->frame->start_time);  
                array_push($end_time, $scheduleFrame->frame->end_time); 
            }
            $result[] = [
                'id'   => $schedule->id,
                'title' => $schedule->doctor->name,
                'start' => $schedule->start_date . ' ' . min($start_time),
                'end' => $schedule->end_date . ' ' . max($end_time),
            ];
        }

        return $result;
    }
}