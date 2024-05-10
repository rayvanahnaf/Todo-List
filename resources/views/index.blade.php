@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-center">
                    TODO LIST
                </h5>

                <form action="{{ route('todo.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <label for="inputTitle" class="form-label">Name</label>
                    <input type="text" class="form-control" name="title">

                    <button class="btn btn-secondary mt-1" type="submit">Submit</button>

                </form>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="card p-5">
            <div class="card-body"></div>

            <table class="table table-striped table-condensed">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($todo as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $row->title }}</td>
                            <td>
                                <p>Status: {{ $row->status }}</p>
                                <!-- Form untuk mengubah status -->
                                <form action="{{ route('todo.update', $row->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <select name="status" class="form-control">
                                            <option value="Todo" {{ $row->status === 'Todo' ? 'selected' : '' }}>Todo
                                            </option>
                                            <option value="In progress"
                                                {{ $row->status === 'In progress' ? 'selected' : '' }}>In Progress</option>
                                            <option value="Complete" {{ $row->status === 'Complete' ? 'selected' : '' }}>
                                                Complete</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-2">Update Status</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('todo.destroy', $row->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        Delete
                                    </button>
                                </form>
                            </td>
                    </tr> @empty <tr>
                            <td>data empity</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection