<!-- page title area  -->
      <section class="page-title-area breadcrumb-spacing" data-background="{{ asset('frontend/img/Daydispatch-get-quote-banner.webp') }}">
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-xxl-9">
                  <div class="page-title-wrapper text-center">
                     <h3 class="page-title mb-25">Get Quote</h3>
                     <div class="breadcrumb-menu">
                        <nav aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
                           <ul class="trail-items">
                              <li class="trail-item trail-begin"><a href="{{ route('Frontend.index') }}"><span>Home</span></a></li>
                              <li class="trail-item trail-end"><span>Get Quote</span></li>
                           </ul>
                        </nav>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- page title area end -->

      <!-- quote area start -->
      <div class="order__form-details pt-120 pb-90">
         <div class="container">
            <div class="row">
               <div class="col-xxl-3 col-xl-3 col-lg-12">
                  <div class="quote-tab mb-30">
                     <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                           <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
                              <span class="order__form-button">
                              <i class="fas fa-box"></i>
                              <span>Request A Quote</span>
                              </span>
                           </button>
                        </li>
                        <!--<li class="nav-item" role="presentation">-->
                        <!--   <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">-->
                        <!--      <span class="order__form-button">-->
                        <!--         <i class="fas fa-map-marker-alt"></i>-->
                        <!--         <span>Track and Trace</span>-->
                        <!--      </span>-->
                        <!--   </button>-->
                        <!--</li>-->
{{--                        <li class="nav-item" role="presentation">--}}
{{--                           <button class="nav-link" id="messages-tab" data-bs-toggle="tab" data-bs-target="#messages" type="button" role="tab" aria-controls="messages" aria-selected="false">--}}
{{--                              <span class="order__form-button">--}}
{{--                                 <i class="fas fa-truck"></i>--}}
{{--                                 <span>Custom Order</span>--}}
{{--                              </span>--}}
{{--                           </button>--}}
{{--                        </li>--}}
                     </ul>
                  </div>
               </div>
               <div class="col-xxl-9 col-xl-8 col-lg-12">
                  <div class="quote-features mb-30">
                     <div class="tab-content">
                     <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="product-action">
                           @include('partials.instant-quote-form')
                        </div>
                     </div>
                     <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <form action="{{ route('Post.Custom.Track.Order') }}" id="Order-Track" method="POST">
                            @csrf
                           <!--<div class="product__data">-->
                           <!--   <label for="id">Your Order ID</label>-->
                           <!--   <input type="text" id="id" placeholder="Your ID" name="Order_ID" required>-->
                           <!--   <label>Your Message</label>-->
                           <!--   <textarea name="Order_Desc" id="message" cols="30" rows="10" placeholder="Write Message..." spellcheck="false"></textarea>-->
                           <!--   <button type="submit" class="fill-btn justify-content-center w-100">Send-->
                           <!--   Query</button>-->
                           <!--</div>-->
                        </form>
                         <p class="order-id-form-messages"></p>
                     </div>
{{--                     <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">--}}
{{--                        <div class="product-action">--}}
{{--                            @include('partials.instant-quote-form')--}}
{{--                        </div>--}}
{{--                     </div>--}}
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- quote area end -->
