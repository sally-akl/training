<div class="table-responsive">

  <table class="table card-table table-vcenter text-nowrap datatable">
    <thead>
      <tr>
        <th></th>
        <th>Image</th>
        <th>
           @lang('site.programme_title')
        </th>
        <th>Number of sets</th>

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
            $programme_data = \App\Programme::where("type","exercises")->whereraw("id  not IN(select programme_design_id from ready_plan where day_num='".$day."'  and recepe_id IS NULL)")->paginate(10);
          else
            $programme_data = \App\Programme::where("type","exercises")->where('title', 'LIKE', '%'.$programme_search.'%')->whereraw("id  not IN(select programme_design_id from ready_plan where day_num='".$day."'  and recepe_id IS NULL )")->paginate(10);
        @endphp
        @foreach ($programme_data as $key => $programme)
        <tr>
          <td><input type="checkbox" name="selected_excercise" value="{{$programme->id}}"  /></td>
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
            <div><span>Description :- </span><span>{{ substr($programme->desc,0,100)}}</span></div>
              <div><span>@lang('site.upload_programme') :- </span><span  class="badge bg-blue">{{$programme->media_type}}</span></div>
              <div><span>Number of sets :- </span><span  class="badge bg-azure">{{$programme->number_of_sets}}</span></div>
          </td>
          <td><input type="text" name="selected_text_{{$programme->id}}" value="{{$programme->number_of_sets}}" class="form-control"/></td>

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
