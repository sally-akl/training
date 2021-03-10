<div class="table-responsive">

  <table class="table card-table table-vcenter text-nowrap datatable">
    <thead>
      <tr>
        <th></th>
        <th>Image</th>
        <th>
           @lang('site.programme_title')
        </th>
        <th>

        </th>
        <th>Serving size</th>

        <th></th>
      </tr>
    </thead>
    <tbody>
      @php
       $day = $data->day;
       $programme_search = $data->programme_search;

      @endphp
        @php

          if(empty($programme_search))
            $programme_data = \App\Programme::where("type","food supplements")->whereraw("id  not IN(select programme_design_id from ready_plan where day_num='".$day."'  and recepe_id IS NULL)")->paginate(10);
          else
            $programme_data = \App\Programme::where("type","food supplements")->where('title', 'LIKE', '%'.$suplement_search.'%')->whereraw("id  not IN(select programme_design_id from ready_plan where day_num='".$day."' and recepe_id IS NULL)")->paginate(10);

        @endphp
        @foreach ($programme_data as $key => $programme)
        <tr>
          <td><input type="checkbox" name="selected_supplement" value="{{$programme->id}}"  /></td>
          <td>
              @if($programme->media_type == "image")
                 @if(count($programme->images)>0)
                   <img src="{{url('/')}}{{$programme->images[0]->image}}" width="100" height="100" />
                 @endif
              @else
              <iframe width="150" height="150" src="{{$programme->vedio}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>

              @endif
         </td>
          <td>{{$programme->title}}
             <div><span>Serving size :- </span><span  class="badge bg-azure">{{$programme->serving_size}}</span></div>
          </td>
          <td>{{substr($programme->desc,0,100)}}</td>
          <td><input type="text" name="selected_text_serving_{{$programme->id}}" value="{{$programme->serving_size}}" class="form-control"/></td>

          <td>

          </td>


        </tr>
        @endforeach
    </tbody>
  </table>
</div>
<div class="card-footer d-flex align-items-center">
  {{ $programme_data->links('dashboard.vendor.pagination.default')}}
</div>
