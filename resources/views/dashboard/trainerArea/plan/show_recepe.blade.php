<div class="page-header">
  <div class="row align-items-center">
    <div class="col-auto">
      <h2 class="page-title">
         Diet details
      </h2>
    </div>
  </div>
</div>
<div class="row row-deck">
  <div class="col-sm-12">
              <div class="card d-flex flex-column">
                <div class="row row-0 flex-fill">
                  <div class="col-md-3">
                    <a href="#">
                      <img src="{{url('/')}}{{$recepe->image}}" class="w-100 h-100 object-cover" alt="Card side image">
                    </a>
                  </div>
                  <div class="col">
                    <div class="card-body">
                      <h3 class="card-title">{{$recepe->name}}</h3>
                      <div class="text-muted">{{$recepe->desciption}}</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Diet Integrates</h3>
                </div>
                <div class="list list-row list-hoverable">
                  @foreach($recepe_integrate as $k=>$sp)
                    <div class="list-item">
                      <a href="#">
                        <span class="avatar">
                          @php   $words = explode(" ", $sp->programme->title);
                                $output= "";
                                foreach ($words as $w) {
                                   $output .= $w[0];
                                 }
                                 echo $output;
                           @endphp
                        </span>
                      </a>
                      <div class="text-truncate">
                        <a href="#" class="text-body d-block">{{$sp->programme->title}}</a>
                        <small class="d-block text-muted text-truncate mt-n1">{{$sp->programme->desc}}</small>
                        <div><span>Serving : </span> <span> <span class="badge bg-blue">{{$sp->serving}}</span></span></div>
                        <div><span>Serving Size : </span> <span> <span class="badge bg-blue">{{$sp->integrate->serving_size}}</span></span></div>
                        <div><span class="badge bg-azure">Calories	 : {{ $sp->serving * $sp->integrate->calories	}}</span>   <span class="badge bg-purple">Carbs	 : {{ $sp->serving * $sp->integrate->carbs	}}</span>  <span class="badge bg-green">Protein	 : {{ $sp->serving * $sp->integrate->protein	}}</span>  <span class="badge bg-orange">Fat	 : {{$sp->serving * $sp->integrate->fat	}}</span></div>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
  </div>
</div>
