<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Events</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            color: #333;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        h1 {
            color: #0056b3;
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
        .btn:hover {
            background-color: #003d80;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #0056b3;
            color: white;
        }
        tr:hover {
            background-color: #f1f9ff;
        }
        .actions a {
            margin-right: 10px;
            color: #007bff;
            text-decoration: none;
        }
        .actions .delete {
            color: #dc3545;
            background: none;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Manage Events</h1>
        <a href="{{ route('events.create') }}" class="btn">Add New Event</a>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Venue</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr>
                        <td>{{ $event->title }}</td>
                        <td>{{ $event->start_time }}</td>
                        <td>{{ $event->end_time }}</td>
                        <td>{{ $event->venue->name }}</td>
                        <td>{{ $event->category->name }}</td>
                        <td class="actions">
                            <a href="{{ route('events.edit', $event->id) }}">Edit</a>
                            <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html> 