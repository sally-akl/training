<div class="card">
  <div class="card-header">
    <h3 class="card-title">{{$programme->title}}</h3>
  </div>
  <div class="card-body border-bottom py-3">
    <div class="d-flex">

    </div>
    <div class="table-responsive">
      <table class="table card-table table-vcenter text-nowrap datatable">
        <tbody>

          <tr>
            <th>
              @if($programme->type == "exercises")
               @lang('site.programme_title')
               @else
                 <span>Program  Title</span>
               @endif
             </th><td>{{$programme->title}}</td>
          </tr>
          <tr>
            <th>   @if($programme->type == "exercises")
               @lang('site.programme_title')
               @else
                 <span>Program  Title</span>
               @endif
                (ar)</th><td>{{$programme->title_ar}}</td>
          </tr>
          <tr>
            <th>@lang('site.programme_type')</th><td>{{$programme->type}}</td>
          </tr>
          <tr>
            <th>@if($programme->type == "exercises")
               @lang('site.programme_desc')
            @else
              <span>Program  Description</span>
            @endif</th><td>{{$programme->desc}}</td>
          </tr>
          <tr>
            <th>@if($programme->type == "exercises")
               @lang('site.programme_desc')
            @else
              <span>Program  Description</span>
            @endif (ar)</th><td>{{$programme->desc_ar}}</td>
          </tr>
          @if($programme->type == "exercises")
          <tr>
            <th>Number of sets</th><td>{{$programme->number_of_sets}}</td>
          </tr>
          <tr>
            <th>Number of reps</th><td>{{$programme->num_of_reps}}</td>
          </tr>
          @endif
          @if($programme->type == "food supplements")
          <tr>
            <th>Serving size</th><td>{{$programme->serving_size}}</td>
          </tr>
          @endif
          @if($programme->media_type == "vedio" && $programme->type == "exercises")
          <tr>
            <th>Video</th><td>{!! $programme->vedio !!}</td>
          </tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>
</div>
@if($programme->media_type == "image")
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Programme images</h3>
  </div>
  <div class="card-body border-bottom py-3">
    <div class="table-responsive">

      <table class="table card-table table-vcenter text-nowrap datatable">
        <thead>
          <tr>
            <th>
              Image
            </th>
          </tr>
        </thead>
        <tbody>
        	@foreach ($programme->images as $key => $image)
          <tr>
            <td><img src="{{url('/')}}{{$image->image}}" width="200" height="200"/></td>

          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

  </div>
</div>
@include("dashboard/utility/modal_delete")
@endif

@if($programme->type == "dietary meals")
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Food nutritional values</h3>
  </div>
  <div class="card-body border-bottom py-3">
    <div class="table-responsive">

      <table class="table card-table table-vcenter text-nowrap datatable">
        <thead>
          <tr>
            <th>
              Serving size
            </th>
            <th>
              Calories
            </th>
            <th>
            Carbs
            </th>
            <th>
              Protein
            </th>
            <th>
            Fat
            </th>
          </tr>
        </thead>
        <tbody>
        	@foreach ($programme_integrate as $key => $integrate)
          <tr>
            <td>{{$integrate->serving_size}}</td>
            <td>{{$integrate->calories}}</td>
            <td>{{$integrate->carbs}}</td>
            <td>{{$integrate->protein}}</td>
            <td>{{$integrate->fat}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

  </div>
</div>
@endif
