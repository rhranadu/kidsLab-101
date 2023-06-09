@extends('admin.layouts.master')
@section('title', 'Attandance - Admin')
@section('body')
@include('admin.message')


<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
            <h1 class="box-title">{{ __('adminstaticword.Attandance') }}</h1>
        </div>
    	 <div class="box-body">
          <!-- Nav tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs" id="nav-tab" role="tablist">
              <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><i class="flaticon-optimization" aria-hidden="true"></i> {{ __('adminstaticword.Courses') }}</a></li>
              <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><i class="flaticon-graduation" aria-hidden="true"></i> {{ __('adminstaticword.LiveClass') }}</a></li>
            
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane fade in active" id="home">
              	<br>
              	@include('admin.attandance.index')
              </div>
              <div role="tabpanel" class="fade tab-pane" id="profile">
              	<br>
              	@include('admin.attandance.liveclass')
              </div>
             
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection


