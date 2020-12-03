{!! APFrmErrHelp::showErrorsNotice($errors) !!}
@include('flash::message')
<div class="form-body">        
    {!! Form::hidden('id', null) !!}
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'name') !!}">
        {!! Form::label('name', 'Resource Person Name', ['class' => 'bold']) !!}
        {!! Form::text('name', null, array('class'=>'form-control', 'id'=>'name', 'placeholder'=>'Resource Person Name')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'name') !!}
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'degree') !!}">
        {!! Form::label('degree', 'Resource Person Degree', ['class' => 'bold']) !!}
        {!! Form::text('degree', null, array('class'=>'form-control', 'id'=>'degree', 'placeholder'=>'Resource Person Degree')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'degree') !!}
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'academic_qualification') !!}">
        {!! Form::label('academic_qualification', 'Academic Qualification', ['class' => 'bold']) !!}
        {!! Form::text('academic_qualification', null, array('class'=>'form-control', 'id'=>'academic_qualification', 'placeholder'=>'Academic Qualification')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'academic_qualification') !!}
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'training_experience') !!}">
        {!! Form::label('training_experience', 'Resource Person Training Experience', ['class' => 'bold']) !!}
        {!! Form::text('training_experience', null, array('class'=>'form-control', 'id'=>'training_experience', 'placeholder'=>'Resource Person Training Experience')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'training_experience') !!}
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'job_experience') !!}">
        {!! Form::label('job_experience', 'Resource Person Job Experience', ['class' => 'bold']) !!}
        {!! Form::text('job_experience', null, array('class'=>'form-control', 'id'=>'job_experience', 'placeholder'=>'Resource Person Job Experience')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'job_experience') !!}
    </div>
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'description') !!}">
        {!! Form::label('description', 'Resource Person description', ['class' => 'bold']) !!}
        {!! Form::textarea('description', null, array('class'=>'form-control', 'id'=>'description', 'placeholder'=>'Resource Person description')) !!}
        {!! APFrmErrHelp::showErrors($errors, 'description') !!}
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