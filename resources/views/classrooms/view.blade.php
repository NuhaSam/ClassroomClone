@include('partial/header');
<h1>Classroom Info</h1>
<div class="row">

<h2> {{ $classroom->name}}</h2>
<h5> {{ $classroom->subject}}</h5>
    <!-- <div class="col md3"> -->
    <div class="col-md-9">

        <!-- <div class="col md-3"> -->
            <div class="border rounded p-3 text-center">
                
                <span class="text-success fs-3 "> {{ $classroom->code }}</span>
            </div>
        </div>
    
</div>
    <!-- </div> -->
</div>