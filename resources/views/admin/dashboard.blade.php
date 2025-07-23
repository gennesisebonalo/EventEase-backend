<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventEase Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f4f7f6;
        }
        .header {
            background-color: #004080;
            color: white;
            padding: 15px 30px;
            font-size: 1.5rem;
        }
        .container {
            display: flex;
        }
        .sidebar {
            width: 250px;
            background-color: #002b5c;
            color: white;
            padding: 20px;
        }
        .sidebar a {
            display: block;
            color: white;
            padding: 12px 15px;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: #0056b3;
        }
        .main-content {
            flex-grow: 1;
            padding: 20px;
        }
        .main-content h1 {
            color: #333;
        }
        .btn {
            background-color: #0056b3;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #004080;
            color: white;
        }
    </style>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
</head>
<body>
    <div class="header">
        EventEase Admin Dashboard
    </div>
    <div class="container">
        <div class="sidebar">
            <h2>Navigation</h2>
            <a href="/admin" class="active">Dashboard</a>
            <a href="{{ route('events.index') }}">Manage Events</a>
            <a href="#">Manage Users</a>
            <a href="#">Reports</a>
            <a href="#">Settings</a>
            <a href="#">Logout</a>
        </div>
        <div class="main-content">
            <h1>Manage Events</h1>
            <a href="{{ route('events.create') }}" class="btn">+ Add New Event</a>
            <table>
                <thead>
                    <tr>
                        <th>Event Name</th>
                        <th>Date</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events as $event)
                        <tr>
                            <td>{{ $event->title }}</td>
                            <td>{{ \Carbon\Carbon::parse($event->start_time)->format('F d, Y') }}</td>
                            <td>{{ $event->venue->name }}</td>
                            <td>{{ get_event_status($event->start_time, $event->end_time) }}</td>
                            <td class="actions">
                                <a href="{{ route('events.edit', $event->id) }}">✏️</a>
                                <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete">❌</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        Pusher.logToConsole = true;

        var pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
            cluster: '{{ env("PUSHER_APP_CLUSTER") }}'
        });

        var channel = pusher.subscribe('events');
        channel.bind('App\\Events\\NewEventCreated', function(data) {
            alert('A new event has been created: ' + data.event.title);
        });
    </script>
</body>
</html>
