<div class="table-responsive" style="width: 98%;overflow-x: hidden;">

  <table class="table card-table table-vcenter datatable" style="font-size: 13px;color: #fff;margin-left: 16px;">
    <tbody>
        @php
         $day = $data->day_num;
         $package = $data->package_num;
         $transaction_num = $data->transaction;
         $programme_search = $data->programme_search;
         $week = $data->week;
        @endphp
        @php
          $query = \App\Programme::where("type","exercises")->whereraw("id  not IN(select programme_design_id from package_user_plan where day_num='".$day."' and package_id='".$package."' and transaction_id='".$transaction_num."' and recepe_id IS NULL and section_id  IS NULL)");
          if(isset($programme_search) && !empty($programme_search))
          {
            $query = $query->where('title', 'LIKE', '%'.$programme_search.'%');
          }
          if(isset($data->programme_filter))
          {
            $filt = json_decode($data->programme_filter);
            $exercisetype = [];
            $equipment=[];
            $mechanicstype=[];
            $level=[];
            $Muscles=[];
            foreach($filt as $f)
            {
              $exp = explode("_",$f);
              if($exp[0] == "exercisetype")
                $exercisetype[] = $exp[1];
              if($exp[0] == "equipment")
                $equipment[] = $exp[1];
              if($exp[0] == "mechanicstype")
                $mechanicstype[] = $exp[1];
              if($exp[0] == "level")
                $level[] = $exp[1];
              if($exp[0] == "Muscles")
                $Muscles[] = $exp[1];

            }

            if(count($exercisetype) > 0)
              $query = $query->wherein('exercise_type',$exercisetype);
            if(count($equipment) > 0)
              $query = $query->wherein('equipment',$equipment);
            if(count($mechanicstype) > 0)
              $query = $query->wherein('mechanics_type',$mechanicstype);
            if(count($level) > 0)
              $query = $query->wherein('level',$level);
            if(count($Muscles) > 0)
              $query = $query->wherein('muscles',$Muscles);

          }
          $programme_data = $query->paginate(10);
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
            <div><p>Description :-  {{ $programme->desc}}</p></div>
              <div><span>@lang('site.upload_programme') :- </span><span  class="badge bg-blue">{{$programme->media_type}}</span></div>
              <div><span>Number of sets :- </span><span  class="badge bg-azure">{{$programme->number_of_sets}}</span></div>
          </td>
          <td><input type="text" name="selected_text_{{$programme->id}}" value="{{$programme->number_of_sets}}" class="form-control"/></td>

          <td>
            <a href="#" class="btn  btn-xs  show_details "  bt-data="{{$programme->id}}" style="background-color: #ea380f;border: 1px solid #ea380f;color: #fff;">
              <i class="fa fa-eye" aria-hidden="true"></i> Details
            </a>
          </td>


        </tr>
        @endforeach
    </tbody>
  </table>
  <input type="hidden" name="day_num" value="{{$day}}" />
  <input type="hidden" name="package_num" value="{{$package}}" />
  <input type="hidden" name="user_num" value="{{$data->user_num}}" />
  <input type="hidden" name="programme_type" value="excercises" />
  <input type="hidden" name="transaction" value="{{$transaction_num}}"/>
  <input type="hidden" name="week" value="{{$week}}"/>


</div>
<div class="card-footer d-flex align-items-center">
  {{ $programme_data->links('dashboard.vendor.pagination.default')}}
</div>
