@extends('layouts.authorized')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" rel="stylesheet">
<style>
    #calendar {
        max-width: 900px;
        margin: 0 auto;
        font-family: Arial, sans-serif;
    }
    .fc-event {
        background-color: #3788d8;
        border-color: #3788d8;
        color: white;
    }
    .fc-event:hover {
        background-color: #285ea8;
        border-color: #285ea8;
    }


</style>
<div class="container my-4">
    <div class="calendar-container">
        <div class="calendar-header">
            <h3>My Calendar</h3>
            <button>Button</button>
        </div>
        <div class="calendar">
            <!-- Day Names Row -->
            <div class="day-name">Sun</div>
            <div class="day-name">Mon</div>
            <div class="day-name">Tue</div>
            <div class="day-name">Wed</div>
            <div class="day-name">Thu</div>
            <div class="day-name">Fri</div>
            <div class="day-name">Sat</div>

            <!-- Day Cells (Days of the month) -->
            <div class="day">1</div>
            <div class="day">2</div>
            <div class="day">3</div>
            <div class="day">4</div>
            <div class="day">5</div>
            <div class="day">6</div>
            <div class="day">7</div>
            <div class="day">8</div>
            <div class="day">9</div>
            <div class="day">10</div>
            <div class="day">11</div>
            <div class="day">12</div>
            <div class="day">13</div>
            <div class="day">14</div>
            <div class="day">15</div>
            <div class="day">16</div>
            <div class="day">17</div>
            <div class="day">18</div>
            <div class="day">19</div>
            <div class="day">20</div>
            <div class="day">21</div>
            <div class="day">22</div>
            <div class="day">23</div>
            <div class="day">24</div>
            <div class="day">25</div>
            <div class="day">26</div>
            <div class="day">27</div>
            <div class="day">28</div>
            <div class="day">29</div>
            <div class="day">30</div>
            <div class="day">31</div>

            <!-- Tasks (Example Task Types) -->
            <div class="task task--warning">
                <div class="task__detail">
                    <h4>Task Title</h4>
                    <p>Details of the warning task...</p>
                </div>
                Task 1 (Warning)
            </div>
            <div class="task task--danger">
                <div class="task__detail">
                    <h4>Urgent Task</h4>
                    <p>Details of the urgent task...</p>
                </div>
                Task 2 (Danger)
            </div>
            <div class="task task--info">
                <div class="task__detail">
                    <h4>Information Task</h4>
                    <p>Details of the information task...</p>
                </div>
                Task 3 (Info)
            </div>
            <div class="task task--primary">
                <div class="task__detail">
                    <h4>Primary Task</h4>
                    <p>Details of the primary task...</p>
                </div>
                Task 4 (Primary)
            </div>
        </div>
    </div>
</div>

    {{-- @foreach($tasks as $task)
    @endforeach  --}}
    <!-- <div id="calendar"></div> -->
    <div id="calendar" class="calendar-container"></div>
    <!-- Edit/Delete Event Modal -->
    <div class="modal fade" id="editEventModal" tabindex="-1" role="dialog" aria-labelledby="editEventModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editEventModalLabel">Edit Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                	<form id="editEventForm" action="{{ route('task.calendar.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <input type="hidden" name="eventId" id="eventId" value="0">
                        <div class="form-group">
                            <label for="eventTitle">Task Title</label>
                            <input name="task_title" type="text" class="form-control" id="eventTitle" placeholder="Enter task title" required>
                        </div>

                        <div class="form-group">
                            <label for="task_date">Start Task Date</label>
                            <input name="task_date" type="date" class="form-control" id="task_date" placeholder="Enter task date" required>
                            </div>

                        <div class="form-group">
                            <label for="task_time">Start Task Time</label>
                            <input name="task_time" type="time" class="form-control" id="task_time" placeholder="Enter task time" required>
                            </div>


                        <div class="form-group">
                            <label for="end_task_date">End Task Date</label>
                            <input name="end_task_date" type="date" class="form-control" id="end_task_date" placeholder="Enter task date" required>
                        </div>

                        <div class="form-group">
                            <label for="end_task_time">End Task Time</label>
                            <input name="end_task_time" type="time" class="form-control" id="end_task_time" placeholder="Enter task time" required>
                        </div>

                        <div class="form-group">
                            <label for="eventDescription">Task Description</label>
                            <textarea name="task_description" class="form-control" id="eventDescription" placeholder="Enter task description" required></textarea>
                        </div>
			                <div class="modal-footer">
			                    <!-- <button type="button" class="btn btn-danger" id="deleteEvent">Delete</button> -->
			                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			                    <button type="submit" class="btn btn-primary" id="saveEvent">Save / Update</button>
			                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <h2 style="text-align: center; color: red;">Task Table</h2>
        <hr>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Task Title</th>
                    <th>Start Task Date</th>
                    <th>Start Task Time</th>
                    <th>End Task Date</th>
                    <th>End Task Time</th>
                    <th>Task Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @forelse($tasks as $task)
                <tr>
                    <td>{{ $task->task_title }}</td>
                    <td>{{ $task->task_date->diffForHumans() }}</td>
                    <td>{{ $task->task_time->format('h:i A') }}</td>
                    <td>{{ $task->end_task_date->diffForHumans() }}</td>
                    <td>{{ $task->end_task_time->format('h:i A') }}</td>
                    <td>
                        {{ $task->task_description }}<br>
                        {{ $task->end_task_time->format('h:i A') }}
                    </td>
                    <td>
                        <button style="display: inline;" type="button" class="edit-task btn btn-primary" data-task-id="{{ $task->id }}">Edit</button>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No Tasks Available</td>
                    </tr>
                @endforelse
                
            </tbody>
        </table>
    </div>
    {{-- end table --}}
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $('body').on('click', '.edit-task', function(event) {
            event.preventDefault(); // Prevent the default link behavior

            var taskId = $(this).data('task-id'); // Get the value of data-task-id
            console.log('Task ID:', taskId); // Log the task ID to ensure it's correct

            $.ajax({
                url: '{{ route('Get.Task.Data') }}',
                method: 'GET',
                data: {
                    task_id: taskId
                },
                success: function(response) {
                    if (response && response['task']) {
                        $('#eventId').val(taskId);
                        $('#eventTitle').val(response['task']['task_title'] || '');

                        // Handle task_date
                        if (response['task']['task_date']) {
                            let isoDate = response['task']['task_date'];
                            let date = new Date(isoDate);
                            if (!isNaN(date.getTime())) { // Check if date is valid
                                let formattedDate = date.toISOString().split('T')[0];
                                $('#task_date').val(formattedDate);
                            } else {
                                console.error('Invalid task date:', isoDate);
                            }
                        } else {
                            $('#task_date').val(''); // Clear the input if no date is provided
                        }

                        // Handle end_task_date
                        if (response['task']['end_task_date']) {
                            let isoDate = response['task']['end_task_date'];
                            let date = new Date(isoDate);
                            if (!isNaN(date.getTime())) { // Check if date is valid
                                let formattedDate = date.toISOString().split('T')[0];
                                $('#end_task_date').val(formattedDate);
                            } else {
                                console.error('Invalid end task date:', isoDate);
                            }
                        } else {
                            $('#end_task_date').val(''); // Clear the input if no date is provided
                        }

                        // Handle task_time
                        $('#task_time').val(response['time'] || '');

                        // Handle end_task_time
                        $('#end_task_time').val(response['endtime'] || '');

                        // Handle task_description
                        $('#eventDescription').val(response['task']['task_description'] || '');

                        // Show the modal
                        $('#editEventModal').modal('show');
                    } else {
                        console.error('Response data is incomplete or missing the task object');
                    }
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error('AJAX Error:', xhr);
                }
            });
        });

        $(document).ready(function() {
            var currentEvent;
            var isNewEvent = false;
            var events = [
                {
                    id: 1,
                    title: 'Task 1',
                    description: 'Description 1',
                    start: '2024-06-26',
                    end: '2024-06-27'
                },
                {
                    id: 2,
                    title: 'Task 2',
                    description: 'Description 2',
                    start: '2024-06-28',
                    end: '2024-06-29'
                }
            ];

            // Initialize calendar
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                editable: true,
                events: events,
                dayClick: function(date) {
                    isNewEvent = true;
                    currentEvent = {
                        start: date.format(),
                        end: date.format()
                    };
                    $('#eventTitle').val('');
                    $('#task_date').val('');
                    $('#task_time').val('');
                    $('#eventDescription').val('');
                    $('#editEventModal').modal('show');
                },
                eventClick: function(event) {
                    isNewEvent = false;
                    currentEvent = event;
                    $('#eventId').val(event.id);
                    $('#eventTitle').val(event.title);
                    $('#task_date').val(event.start.format('YYYY-MM-DD'));
                    $('#task_time').val(event.start.format('HH:mm'));
                    $('#eventDescription').val(event.description);
                    $('#editEventModal').modal('show');
                }
            });

            // Save changes to event
            $('#saveEvent').click(function() {
                var title = $('#eventTitle').val();
                var date = $('#task_date').val();
                var time = $('#task_time').val();
                var description = $('#eventDescription').val();
                if (title && date && time && description) {
                    if (isNewEvent) {
                        var newEvent = {
                            id: events.length + 1,
                            title: title,
                            description: description,
                            start: date + 'T' + time,
                            end: date + 'T' + time
                        };
                        events.push(newEvent);
                        $('#calendar').fullCalendar('renderEvent', newEvent, true);
                    } else {
                        currentEvent.title = title;
                        currentEvent.start = date + 'T' + time;
                        currentEvent.end = date + 'T' + time;
                        currentEvent.description = description;
                        $('#calendar').fullCalendar('updateEvent', currentEvent);
                    }
                    $('#editEventModal').modal('hide');
                }
            });

            // Delete event
            $('#deleteEvent').click(function() {
                if (!isNewEvent) {
                    var index = events.findIndex(event => event.id === currentEvent.id);
                    if (index !== -1) {
                        events.splice(index, 1);
                        $('#calendar').fullCalendar('removeEvents', currentEvent.id);
                        $('#editEventModal').modal('hide');
                    }
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: @json($tasks->map(function($task) {
                    return [
                        'title' => $task->title, // Assuming each task has a title
                        'start' => $task->date // Assuming each task has a date field
                    ];
                }))
            });

            calendar.render();
        });
    </script>
@endsection
