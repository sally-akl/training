@foreach ($plan_data as $key => $programme)
  <div class="exer-block d-flex">
    @if(count($programme->programme->images)>0 && $programme->programme->media_type == "image")
      <img src="{{url('/')}}{{$programme->programme->images[0]->image}}" alt="">
    @endif

    @if($programme->programme->media_type != "image")
      <img src="{{url('/')}}/img/download.png" alt="">
    @endif

      <div class="exer-desc"  data-toggle="modal" data-target="#exerModal_{{$programme->programme->id}}">
          <span>{{$programme->programme->title}}</span>
          <small>{{$programme->set_num}}</small>
          <p>{{$programme->programme->desc}}</p>
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
                            <div>{!! $programme->programme->vedio !!}</div>
                          @endif
                      </div>
                  </div>
                  <div class="modal-exer-info">
                      <div class="d-flex justify-content-between">
                          <h4>{{$programme->programme->title}}</h4>
                          <span>{{$programme->set_num}}</span>
                      </div>
                      <p>{{$programme->programme->desc}}</p>
                      <div class="text-center mt-4">
                          <button type="button" class="main-btn py-2">Complete</button>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
@endforeach
