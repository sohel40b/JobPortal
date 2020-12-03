<div class="listpgWraper">
    <div class="container">
        <!-- title start -->
        <div class="titleTop">
            <h3>{{__('Training')}} <span>{{__('List')}}</span></h3>
        </div>
        <!-- title end --> 
        <ul class="row compnaieslist">
        @if(isset($trainings) && count($trainings))
            @foreach($trainings as $trainingList)
            <li class="col-md-3 col-sm-6">
                <div class="compint">
                <!--<div class="imgwrap">{{$trainingList->title}}</div>-->
                <h3><a href="">{{$trainingList->title}}</a></h3>
                <div class="loctext"><i class="fa fa-map-marker" aria-hidden="true"></i> {{$trainingList->start_date}}</div>
                <div class="loctext"><i class="fa fa-map-marker" aria-hidden="true"></i> {{$trainingList->course_time}}</div>
                <div class="loctext"><i class="fa fa-map-marker" aria-hidden="true"></i> {{$trainingList->duration}}</div>
                <div class="loctext"><i class="fa fa-map-marker" aria-hidden="true"></i> {{$trainingList->no_of_class}}</div>
                <div class="loctext"><i class="fa fa-map-marker" aria-hidden="true"></i> {{$trainingList->class_schedule}}</div>
                <div class="loctext"><i class="fa fa-map-marker" aria-hidden="true"></i> {{$trainingList->expiry_date}}</div>
                <div class="loctext"><i class="fa fa-map-marker" aria-hidden="true"></i> {{$trainingList->venue}}</div>
                <p>{{str_limit(strip_tags($trainingList->description), 150, '...')}}</p>
                <div class="viewallbtn"><a href="{{ route('training.detail') }}">{{__('View Details')}}</a></div>
                </div>
            </li>
            @endforeach
            @endif
        </ul>
        <!--button start-->
        <div class="viewallbtn"><a href="">{{__('View All Training')}}</a></div>
        <!--button end--> 
    </div>
</div>