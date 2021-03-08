@foreach ($plan_data as $key => $programme)
  <div class="supp-block d-flex">
    @if(count($programme->programme->images)>0)
      <img src="{{url('/')}}{{$programme->programme->images[0]->image}}" alt="">
    @endif
      <div class="exer-desc"  data-toggle="modal" data-target="#supplimentexerModal_{{$programme->programme->id}}">
          <span>{{$programme->programme->title}}<span style="float: right;">  <a href="#" class="btn btn-danger btn-xs delete_btn"   bt-type="supliment" bt-data="{{$programme->plan_id}}">
             <i class="far fa-trash-alt"></i>
           </a>
           </span></span>
          <small>{{$programme->suplement_serving_size}}</small>
          <p>{{$programme->programme->desc}}</p>
      </div>
  </div>

  <!-- Exersice Modal -->
  <div class="modal fade exer-modal" id="supplimentexerModal_{{$programme->programme->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                      </div>
                  </div>
                  <div class="modal-exer-info">
                      <div class="d-flex justify-content-between">
                          <h4>{{$programme->programme->title}}</h4>
                          <span>{{$programme->suplement_serving_size}}</span>
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
