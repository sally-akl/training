@foreach ($plan_data as $key => $programme)
  <div class="exer-block d-flex">
    @if(count($programme->programme->images)>0 && $programme->programme->media_type == "image")
      <img src="{{url('/')}}{{$programme->programme->images[0]->image}}" alt="">
    @endif

    @if($programme->programme->media_type != "image")
      <iframe width="170" height="200" src="{{$programme->programme->vedio}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="" {{(session()->has('locale') && session()->get('locale') =='ar')?'style=margin-left:23px;margin-right:19px;':'style=margin-right:20px'}}></iframe>
    @endif

      <div class="exer-desc"  data-toggle="modal" data-target="#exerModal_{{$programme->programme->id}}">
          <span>{{(session()->has('locale') && session()->get('locale') =='ar')?$programme->programme->title_ar:$programme->programme->title}}
            <span style="float: right;"><a href="#" class="btn btn-danger btn-xs delete_btn" bt-type="excer"  bt-data="{{$programme->plan_id}}">
             <i class="far fa-trash-alt"></i>
           </a></span>

          </span>
          @php  $complete_ex = \App\CompleteExcercies::where("programme_id",$programme->programme->id)->where("user_id",Auth::user()->id)->where("day_num",$programme->day_num)->first();  @endphp
          @if(isset($complete_ex->programme_id))
           <small class="set_num_{{$programme->programme->id}}" style="color:green">{{$programme->set_num}}</small>
          @else
           <small class="set_num_{{$programme->programme->id}}" >{{$programme->set_num}}</small>
          @endif
          <p>{{(session()->has('locale') && session()->get('locale') =='ar')?$programme->programme->desc_ar:$programme->programme->desc}}</p>
      </div>
  </div>

  <!-- Exersice Modal -->
  <div class="modal fade exer-modal" id="exerModal_{{$programme->programme->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
              <div class="modal-body">
                  <div class="modal-slider">
                      <div class="owl-carousel owl-theme">
                          @if(count($programme->programme->images)>0)
                           @foreach($programme->programme->images as $img)
                            <div class="item">
                                <a href="#">
                                    <img src="{{url('/')}}/{{$img->image}}" alt="">
                                </a>
                                <div class="slider-overlay"></div>
                            </div>
                           @endforeach
                           @endif
                           @if($programme->programme->media_type !='image')
                            <div><iframe width="800" height="310"  src="{{$programme->programme->vedio}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe></div>
                          @endif
                      </div>
                  </div>
                  <div class="modal-exer-info">
                      <div class="d-flex justify-content-between">
                          <h4>{{(session()->has('locale') && session()->get('locale') =='ar')?$programme->programme->title_ar:$programme->programme->title}}</h4>
                          @if(isset($complete_ex->programme_id))
                          <span style="color:green">{{$programme->set_num}}</span>
                          @else
                           <span>{{$programme->set_num}}</span>
                          @endif
                      </div>
                      <p>{{(session()->has('locale') && session()->get('locale') =='ar')?$programme->programme->desc_ar:$programme->programme->desc}}</p>
                      <div class="text-center mt-4">
                        <form action="{{url('/')}}/add/excercise/complete" method="post" class="complete_ex_form">
                          <input type="hidden" name="pr_id" value="{{$programme->programme->id}}"/>
                          <button type="submit" class="main-btn py-2 excercise_complete">Complete</button>
                        </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
@endforeach
