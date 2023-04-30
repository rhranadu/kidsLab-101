@extends('admin/layouts.master')
@section('title', 'View Session/Batch - Admin')
@section('body')
 
@if ($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif
<section class="content">
  @include('admin.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{ __('adminstaticword.sessionBatch') }}</h3>

          <a type="button"class="btn btn-info btn-sm"  data-toggle="modal" data-target="#myModal">
          + {{ __('adminstaticword.Add') }}
        </a>
        </div>
        <div class="box-header">
         
          <!-- Modal -->
          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">{{ __('adminstaticword.AddSessionBatch') }}</h4>
                </div>
                <div class="modal-body">
                  <form id="demo-form2" method="post" action="{{url('batch-setting/')}}" data-parsley-validate class="form-horizontal form-label-left" autocomplete="off" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="row">
                      <div class="col-md-12">
                        <label for="b_name">{{ __('adminstaticword.Title') }}:<sup class="redstar">*</sup></label>
                        <input placeholder="Enter session or batch title" type="text" class="form-control" name="title" required="">
                      </div>
                    </div>
                    <br>
                      <div class="row">
                          <div class="col-md-12">
                              <label for="b_name">{{ __('adminstaticword.StartDate') }}:<sup class="redstar">*</sup></label>
                              <div>
                                  <input class="date form-control" placeholder="Please Enter Start Date" name="start_date" type="text" >
                              </div>
                          </div>
                      </div>
                      <br>
                      <div class="row">
                          <div class="col-md-12">
                              <label for="b_name">{{ __('adminstaticword.EndDate') }}:<sup class="redstar">*</sup></label>
                              <div>
                                  <input class="date form-control" placeholder="Please Enter End Date" name="end_date" type="text" >
                              </div>
                          </div>
                      </div>
                      <br>


                    <div class="row">

                      <div class="col-md-6">
                        <label for="exampleInputDetails">{{ __('adminstaticword.Status') }}:</label>
                        <li class="tg-list-item">              
                          <input class="tgl tgl-skewed" id="status" type="checkbox" name="status" >
                          <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="status"></label>
                        </li>
                      </div>
                    </div>
                    <br>

                    <br>
                    <button type="submit" class="btn btn-primary">{{ __('adminstaticword.Save') }}</button>
                  </form>
                </div>
              </div>
            </div>
          </div>

        </div>

        <div class="box-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>{{ __('adminstaticword.Title') }}</th>
                  <th>{{ __('adminstaticword.StartDate') }}</th>
                  <th>{{ __('adminstaticword.EndDate') }}</th>
                  <th>{{ __('adminstaticword.Status') }}</th>
                  <th>{{ __('adminstaticword.Edit') }}</th>
                  <th>{{ __('adminstaticword.Delete') }}</th>
                </tr>
              </thead>
              <tbody id="sortable">
                <?php $i=0;?>
                @foreach($sessionOrBatch as $sessionOrBatch)
                <?php $i++;?>
                  <tr class="sortable" id="id-{{ $sessionOrBatch->id }}">
                    <td><?php echo $i;?></td>
                    <td>{{$sessionOrBatch->title}}</td>
                    <td>{{$sessionOrBatch->start_date}}</td>
                    <td>{{$sessionOrBatch->end_date}}</td>
                    <td>
                        <form action="{{ route('sessionBatch.quick',$sessionOrBatch->id) }}" method="POST">
                          {{ csrf_field() }}
                          <button type="Submit" class="btn btn-xs {{ $sessionOrBatch->status ==1 ? 'btn-success' : 'btn-danger' }}">
                            @if($sessionOrBatch->status ==1)
                            {{ __('adminstaticword.Active') }}
                            @else
                            {{ __('adminstaticword.Deactive') }}
                            @endif
                          </button>
                        </form>
                    </td>
            
                    <td>
                      <a class="btn btn-success btn-sm" href="{{url('batch-setting/'.$sessionOrBatch->id)}}"><i class="glyphicon glyphicon-pencil"></i></a></td>
                    <td>
                      <form  method="post" action="{{url('batch-setting/'.$sessionOrBatch->id)}}"data-parsley-validate class="form-horizontal form-label-left">
                          {{ csrf_field() }}
                          {{ method_field('DELETE') }}
                        <button  type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash-o"></i></button>
                      </form>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <!-- /.box-body -->
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
  $( function() {
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();
  } );


   $("#sortable").sortable({
   update: function (e, u) {
    var data = $(this).sortable('serialize');
   
    $.ajax({
        url: "{{ route('session_batch_reposition') }}",
        type: 'get',
        data: data,
        dataType: 'json',
        success: function (result) {
          console.log(data);
        }
    });

  }

});
  </script>

@endsection


