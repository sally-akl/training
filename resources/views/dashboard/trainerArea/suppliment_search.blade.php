<div class="table-responsive" style="width: 98%;overflow-x: hidden;">
  <table class="table card-table table-vcenter text-nowrap datatable" style="font-size: 13px;color: #fff;margin-left: 16px;">

    <tbody>
        @php

        $day = $data->day_num;
        $package = $data->package_num;
        $transaction_num = $data->transaction;
        $programme_search = $data->programme_search;
        $week = $data->week;


        $query = \App\Programme::where("type","food supplements")->whereraw("id  not IN(select programme_design_id from package_user_plan where day_num='".$day."' and package_id='".$package."' and transaction_id='".$transaction_num."' and recepe_id IS NULL and section_id  IS NULL)");
          if(isset($programme_search) && !empty($programme_search))
          {
             $query = $query->where('title', 'LIKE', '%'.$programme_search.'%');
          }
          $programme_data = $query->paginate(10);

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
            <a href="#" class="btn  btn-xs  show_details"  bt-data="{{$programme->id}}" style="background-color: #ea380f;border: 1px solid #ea380f;color: #fff;">
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
  <input type="hidden" name="programme_type" value="supliment" />
  <input type="hidden" name="transaction" value="{{$transaction_num}}"/>
  <input type="hidden" name="week" value="{{$week}}"/>

</div>
<div class="card-footer d-flex align-items-center">
  {{ $programme_data->links('dashboard.vendor.pagination.default')}}
</div>
