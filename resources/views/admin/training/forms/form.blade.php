{!! APFrmErrHelp::showErrorsNotice($errors) !!}
@include('flash::message')
<div class="form-body">
    {!! Form::hidden('id', null) !!}
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'title') !!}">
        {!! Form::label('title', 'Training title', ['class' => 'bold']) !!}
        {!! Form::text('title', null, array('class'=>'form-control', 'id'=>'title', 'placeholder'=>'Training title')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'title') !!}
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'course_time') !!}">
        {!! Form::label('course_time', 'Training Time Schedule', ['class' => 'bold']) !!}
        {!! Form::text('course_time', null, array('class'=>'form-control', 'id'=>'course_time', 'placeholder'=>'Training Time Schedule')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'course_time') !!}
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'description') !!}">
        {!! Form::label('description', 'Training description', ['class' => 'bold']) !!}
        {!! Form::textarea('description', null, array('class'=>'form-control', 'id'=>'description', 'placeholder'=>'Training description')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'description') !!}
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'duration') !!}">
        {!! Form::label('duration', 'Training Duration Time', ['class' => 'bold']) !!}
        {!! Form::text('duration', null, array('class'=>'form-control', 'id'=>'duration', 'placeholder'=>'Training Duration Time')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'duration') !!}
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'venue') !!}">
        {!! Form::label('venue', 'Training Venue', ['class' => 'bold']) !!}
        {!! Form::text('venue', null, array('class'=>'form-control', 'id'=>'venue', 'placeholder'=>'Training Venue')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'venue') !!}
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'no_of_class') !!}">
        {!! Form::label('no_of_class', 'No Of Class/Sessions', ['class' => 'bold']) !!}
        {!! Form::text('no_of_class', null, array('class'=>'form-control', 'id'=>'no_of_class', 'placeholder'=>'No Of Class/Sessions')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'no_of_class') !!}
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'class_schedule') !!}">
        {!! Form::label('class_schedule', 'Training Class Schedule', ['class' => 'bold']) !!}
        {!! Form::text('class_schedule', null, array('class'=>'form-control', 'id'=>'class_schedule', 'placeholder'=>'Training Class Schedule')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'class_schedule') !!}
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'start_date') !!}">
        {!! Form::label('start_date', 'Training Start Date', ['class' => 'bold']) !!}
        {!! Form::text('start_date', null, array('class'=>'form-control datepicker', 'id'=>'start_date', 'placeholder'=>'Training Start Date', 'autocomplete'=>'off')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'start_date') !!}
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'expiry_date') !!}">
        {!! Form::label('expiry_date', 'Last Date Of Registration', ['class' => 'bold']) !!}
        {!! Form::text('expiry_date', null, array('class'=>'form-control datepicker', 'id'=>'expiry_date', 'placeholder'=>'Last Date Of Registration', 'autocomplete'=>'off')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'expiry_date') !!}
    </div>
 
    <div class="form-actions">
        {!! Form::button('Update <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>', array('class'=>'btn btn-large btn-primary', 'type'=>'submit')) !!}
    </div>
</div>
@push('css')
<style type="text/css">
    .datepicker>div {
        display: block;
    }
</style>
@endpush
@push('scripts')
@include('admin.shared.tinyMCEFront') 
<script type="text/javascript">
    $(document).ready(function () {
        $('.select2-multiple').select2({
            placeholder: "Select Required Skills",
            allowClear: true
        });
        $(".datepicker").datepicker({
            autoclose: true,
            format: 'yyyy-m-d'
        });
    });
</script>
@endpush