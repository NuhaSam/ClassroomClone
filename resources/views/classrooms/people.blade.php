@include('partial.header')
@include('partial/classroomHeader')

<div class="container">
    <h1>{{ $classroom->name }} # {{ $classroom->id }}</h1>
    <br>

    @foreach($people as $group)
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h3>{{ $group->first()->pivot->role }}</h3>
        @if($group->first()->pivot->role == 'Student')
        <span>Student Count: {{$count}}</span>
        @endif
    </div>

    <table class="table table-striped">
        <thead>
            <th></th>
            <th>Name</th>
            <th>Role</th>
            <th></th>
        </thead>
        <tbody>
            @foreach($group as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->pivot->role}}</td>
                @can('people.delete',$classroom)
                <td>
                    <form method="post" action="{{ route('classrooms.people.destroy',$classroom->id) }}">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <button type="submit" name="delete" class="btn btn-outline-danger">Leave</button>
                      {{-- @if($owner)
                        else
                        <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                        @endif --}}
                    </form>
                </td>
                @endcan
            </tr>
            @endforeach
        </tbody>
    </table>
    @endforeach
</div>