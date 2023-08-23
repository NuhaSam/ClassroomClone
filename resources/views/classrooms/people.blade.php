@include('partial.header')

<div class="container">
     <h1>{{ $classroom->name }} # {{ $classroom->id }}</h1> 
<br>

  @foreach($people as $group)
        <h3> {{ $group->first()->pivot->role }}</h3>
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
                <td>
                    <form method="post" action="{{ route('classrooms.people.destroy',$classroom->id) }}">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endforeach
</div>