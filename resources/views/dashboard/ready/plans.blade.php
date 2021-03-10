<div class="table-responsive">
  <table class="table card-table table-vcenter text-nowrap datatable" style="color: #fff;">
    <thead>
      <tr>

        <th>
          Image
        </th>
        <th>
           Details
        </th>

      </tr>
    </thead>
    <tbody>


        @foreach ($plans as $key => $plan)
        <tr>
          @if($plan->programme != null)
          <td>
              @if($plan->programme->media_type == "image")
                @if(count($plan->programme->images)>0)
                  <img src="{{url('/')}}{{$plan->programme->images[0]->image}}" width="100" height="100" />
                @endif
              @else
              <iframe width="150" height="150" src="{{$plan->programme->vedio}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>

              @endif

         </td>
          <td>{{$plan->programme->title}}
            <div><span>Description :- </span><span>{{ substr($plan->programme->desc,0,100)}}</span></div>
              <div><span>@lang('site.upload_programme') :- </span><span  class="badge bg-blue">{{$plan->programme->media_type}}</span></div>
              <div><span>Number of sets :- </span><span  class="badge bg-azure">{{$plan->set_num}}</span></div>
              <div><span>Serving size :- </span><span  class="badge bg-azure">{{$plan->suplement_serving_size}}</span></div>
          </td>
          @endif

          @if($plan->recepe != null)

          <td><img src="{{url('/')}}{{$plan->recepe->image}}" width="100" height="100" /></td>
          <td>{{$plan->recepe->name}}
              <div><span>Description :- </span><span>{{$plan->recepe->desciption}}</span></div>
              @php

                $Calories = 0;
                $Carbs = 0;
                $Protein = 0;
                $Fat = 0;
                foreach($plan->recepe->integrate as $k=>$sp)
                {
                  $Calories += $sp->serving * $sp->integrate->calories ;
                  $Carbs += $sp->serving * $sp->integrate->carbs;
                  $Protein += $sp->serving * $sp->integrate->protein;
                  $Fat += $sp->serving * $sp->integrate->fat;

                }

              @endphp
              <div><span class="badge bg-azure">Calories	 : {{$Calories	}}</span>   <span class="badge bg-purple">Carbs	 : {{$Carbs	}}</span>  <span class="badge bg-green">Protein	 : {{$Protein	}}</span>  <span class="badge bg-orange">Fat	 : {{$Fat}}</span></div>

          </td>
            @endif

        </tr>
        @endforeach
    </tbody>
  </table>
  <button type="submit" class="btn btn-primary" style="background-color: #ea380f;border: 1px solid #ea380f;">Copy programme</button>
</div>
