@include('partial/header')
<h1 style="color: blue;">Classroom Info</h1>
<div class="row border rounded p-2 text-center">

<h2> {{ $classroom->name}}</h2>
<h5> {{ $classroom->subject}}</h5>
    <!-- <div class="col md3"> -->
    <div class="col-md-2 rounded">

        <!-- <div class="col md-3"> -->
            <div class="border rounded p-2 text-center">
                
                <span class="text-success fs-3 "> {{ $classroom->code }}</span>
            </div>
            <h6> Invitation Link </h6>
            <p>{{ $invitation_link }}</p>
        </div>
    
</div>
    <!-- </div> -->
