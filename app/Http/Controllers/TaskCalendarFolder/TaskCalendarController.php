<?php

namespace App\Http\Controllers\TaskCalendarFolder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\TaskCalendar;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Response;

class TaskCalendarController extends Controller
 {
    public function CalendarTask()
 {
        $slot = '';
        $user_id = Auth::guard( 'Authorized' )->user()->id;
        $tasks = TaskCalendar::where( 'user_id', $user_id )->latest()->get();

        // Format the task_date using Carbon
        foreach ( $tasks as $task ) {
            $task->formattedDate = Carbon::parse( $task->task_date )->format( 'Y-m-d' );
            $task->formattedDate = Carbon::parse( $task->end_task_date )->format( 'Y-m-d' );
        }

        return view( 'livewire.backend.taskcalendar.task-calendar', compact( 'slot', 'tasks' ) );

    }
    // End Method

    public function TaskCalenderStore( Request $request )
 {
        $user_id = Auth::guard( 'Authorized' )->user()->id;
        // dd( $user_id );


        if ($request->has('eventId') && $request->eventId != 0) {
            $task = TaskCalendar::find($request->eventId);
            $task->task_title = $request->task_title;
            $task->task_date = $request->task_date;
            $task->task_time = $request->task_time;
            $task->end_task_date = $request->end_task_date;
            $task->end_task_time = $request->end_task_time;
            $task->task_description = $request->task_description;
            $task->save();
        }
        else {
            TaskCalendar::insert( [
                'user_id' => $user_id,
                'task_title' => $request->task_title,
                'task_date' => $request->task_date,
                // 'task_time' => $request->task_time,
                'task_time' => $request->input( 'task_time' ), // Store in 24-hour format
                'end_task_date' => $request->end_task_date,
                'end_task_time' => $request->end_task_time,
                'task_description' => $request->task_description,
                'created_at' => Carbon::now(),
            ] );
        }

        return redirect()->back()->with( 'success', 'Your task has been successfully added!' );

    }
    // End Method

    // public function GetTask( Request $request )
    // {
    //     $task = TaskCalendar::find( $request->task_id );
    //     // dd( $task );
    //     return new Response( response()->json( $task )->content(), 200, [ 'Content-Type' => 'application/json' ] );
    // }

    public function GetTask( Request $request )
 {
        $task = TaskCalendar::find( $request->task_id );

        if ( $task ) {
            // Format the date to MM/DD/YYYY
            $date = \Carbon\Carbon::parse( $task->task_date )->format( 'm/d/Y' );

            $enddate = \Carbon\Carbon::parse( $task->end_task_date )->format( 'm/d/Y' );


            // Format the time to HH:MM AM/PM if needed
            $time = \Carbon\Carbon::parse( $task->task_time )->format( 'H:i' );

            $endtime = \Carbon\Carbon::parse( $task->end_task_time )->format( 'H:i' );

            // dd( $task, \Carbon\Carbon::parse( $task->task_date )->format( 'm/d/Y' ), \Carbon\Carbon::parse( $task->task_time )->format( 'H:i' ) );

            return new \Illuminate\Http\Response(
                response()->json( [ 'task' => $task, 'date' => $date, 'time' => $time, 'enddate' => $enddate, 'endtime' => $endtime ] )->content(),
                200,
                [ 'Content-Type' => 'application/json' ]
            );
        } else {
            return new \Illuminate\Http\Response(
                response()->json( [ 'error' => 'Task not found' ] )->content(),
                404,
                [ 'Content-Type' => 'application/json' ]
            );
        }
    }

    public function destroy($id)
    {
        // Find the task by ID
        $task = TaskCalendar::find($id)->delete();
        return redirect()->back()->with( 'success', 'Your task has been deleted successfully added!' );
    }

    public function destroy2($id)
    {
        // Find the task by ID
        $task = TaskCalendar::find($id)->delete();
        return redirect()->back()->with( 'success', 'Your task has been deleted successfully added!' );
    }

}
