<div class="table-responsive"  style="width: 98%;overflow-x: hidden;">
  <table class="table card-table table-vcenter text-nowrap datatable" style="font-size: 13px;color: #fff;margin-left: 16px;">
    <tbody>
        @php
         $day = $data->day_num;
         $package = $data->package_num;
         $transaction_num = $data->transaction;
         $programme_search = $data->programme_search;
         $week = $data->week;
        @endphp
        @php
        $query = \App\Receips::selectraw("receips.id , receips.name , receips.desciption , receips.image , sum(receips_integration.serving * programe_design_integrent.calories) as sumcalories , sum(receips_integration.serving * programe_design_integrent.carbs) as sumcarbs, sum(receips_integration.serving * programe_design_integrent.protein) as sumprotein , sum(receips_integration.serving * programe_design_integrent.fat) as sumfat ")->join("receips_integration","receips.id","receips_integration.recep_id")->join("programe_design_integrent","receips_integration.integrate_programme_id","programe_design_integrent.id")->whereraw("receips.id  not IN(select recepe_id from package_user_plan where day_num='".$day."' and package_id='".$package."' and transaction_id='".$transaction_num."'  and  programme_design_id  IS NULL)")->where("receips.user_id",Auth::id());
        if(isset($programme_search) && !empty($programme_search))
        {
          $query = $query->where('name', 'LIKE', '%'.$programme_search.'%');
        }
        $query = $query->groupby("receips.id","receips.name","receips.desciption","receips.image");
        if(isset($data->programme_filter))
        {
          $filt = json_decode($data->programme_filter);

          foreach($filt as $f)
          {
            $exp = explode("_",$f);
            if($exp[0] == "calor")
            {
              $query = $query->orderby("sumcalories",$exp[1]);
            }
            if($exp[0] == "port")
            {
              $query = $query->orderby("sumprotein",$exp[1]);
            }
            if($exp[0] == "carb")
            {
              $query = $query->orderby("sumcarbs",$exp[1]);
            }
            if($exp[0] == "fats")
            {
              $query = $query->orderby("sumfat",$exp[1]);
            }
          }
        }
        $receps_data = $query->paginate(10);
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
            <a href="#" class="btn  btn-xs show_recep"  bt-data="{{$receps->id}}" style="background-color: #ea380f;border: 1px solid #ea380f;color: #fff;">
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
  <input type="hidden" name="programme_type" value="recepies" />
  <input type="hidden" name="transaction" value="{{$transaction_num}}"/>
  <input type="hidden" name="week" value="{{$week}}"/>

</div>
<div class="card-footer d-flex align-items-center">
  {{ $receps_data->links('dashboard.vendor.pagination.default')}}
</div>
