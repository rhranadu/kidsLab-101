@extends('admin/layouts.master')
@section('title', 'Edit Session/Batch - Admin')
@section('body')

<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-12">

      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{ __('adminstaticword.EditSessionBatch') }}</h3>
        </div>
       
        <div class="panel-body">

          <form id="demo-form" method="post" action="{{url('batch-setting/'.$sessionBatch->id)}}
              "data-parsley-validate class="form-horizontal form-label-left" autocomplete="off" enctype="multipart/form-data">
              {{ csrf_field() }}
              {{ method_field('PUT') }}

            <div class="row">
              <div class="col-md-6">
                <label for="exampleInputTit1e">{{ __('adminstaticword.Title') }}:<sup class="redstar">*</sup></label>
                <input type="text" class="form-control" name="title" id="exampleInputTitle" value="{{$sessionBatch->title}}">
              </div>
             
            </div>
              <br>
              <div class="row">
                  <div class="col-md-12">
                      <label for="b_name">{{ __('adminstaticword.StartDate') }}:<sup class="redstar">*</sup></label>
                      <input class="date form-control" type="text" name="start_date" value="{{$sessionBatch->startDate}}">
                  </div>
              </div>
              <br>
              <div class="row">
                  <div class="col-md-12">
                      <label for="b_name">{{ __('adminstaticword.EndDate') }}:<sup class="redstar">*</sup></label>
                    <input class="date form-control" type="text" name="end_date" value="{{$sessionBatch->endDate}}">
                  </div>
              </div>

          </br>

            <div class="row">
              <div class="col-md-3">
                <label for="exampleInputTit1e">{{ __('adminstaticword.Status') }}:</label>
                <li class="tg-list-item">              
                  <input class="tgl tgl-skewed" id="status" type="checkbox" name="status" {{ $sessionBatch->status == '1' ? 'checked' : '' }} >
                  <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="status"></label>
                </li>
              </div>
            </div>

            <br>
            <div class="row box-footer">
              <button type="submit" class="btn btn-md col-lg-2 btn-primary">{{ __('adminstaticword.Save') }}</button>
            </div>
          </form>
        </div>
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
@endsection
@section('scripts')
<script type="text/javascript">
    $('.date').datepicker({
        format: 'dd-mm-yyyy'
    });
</script>
@endsection
