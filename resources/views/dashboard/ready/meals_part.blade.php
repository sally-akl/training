<div class="table-responsive">
  <table class="table card-table table-vcenter text-nowrap datatable">
    <thead>
      <tr>
        <th></th>
        <th>
          Image
        </th>
        <th>
           Details
        </th>

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
           $receps_data = \App\Receips::whereraw("id  not IN(select recepe_id from ready_plan where day_num='".$day."'  and  programme_design_id  IS NULL)")->paginate(10);
         else
          $receps_data = \App\Receips::where('name', 'LIKE', '%'.$recepie_search.'%')->whereraw("id  not IN(select recepe_id from ready_plan where day_num='".$day."' and programme_design_id  IS NULL)")->paginate(10);
        @endphp
        @foreach ($receps_data as $key => $receps)
        <tr>
          <td><input type="checkbox" name="selected_recepies" value="{{$receps->id}}"  /></td>
          <td><img src="{{url('/')}}{{$receps->image}}" width="100" height="100" /></td>
          <td>{{$receps->name}}
              <div><span>Description :- </span><span>{{$receps->desciption}}</span></div>
              @php

                $Calories = 0;
                $Carbs = 0;
                $Protein = 0;
                $Fat = 0;
                foreach($receps->integrate as $k=>$sp)
                {
                  $Calories +=$sp->serving * $sp->integrate->calories ;
                  $Carbs += $sp->serving * $sp->integrate->carbs;
                  $Protein += $sp->serving * $sp->integrate->protein;
                  $Fat += $sp->serving * $sp->integrate->fat;

                }

              @endphp
              <div><span class="badge bg-azure">Calories	 : {{$Calories	}}</span>   <span class="badge bg-purple">Carbs	 : {{$Carbs	}}</span>  <span class="badge bg-green">Protein	 : {{$Protein	}}</span>  <span class="badge bg-orange">Fat	 : {{$Fat}}</span></div>

          </td>

          <td class="text-right">

          </td>

        </tr>
        @endforeach
    </tbody>
  </table>
</div>
<div class="card-footer d-flex align-items-center">
  {{ $receps_data->links('dashboard.vendor.pagination.default')}}
</div>
