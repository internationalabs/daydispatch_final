<!-- page title area  -->
<section class="page-title-area breadcrumb-spacing" data-background="{{ asset('frontend/img/breadcrumb-bg.webp') }}">
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-xxl-9">
            <div class="page-title-wrapper text-center">
               <h3 class="page-title mb-25">Contact Us</h3>
               <div class="breadcrumb-menu">
                  <nav aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
                     <ul class="trail-items">
                        <li class="trail-item trail-begin"><a href="{{ route('Frontend.index') }}"><span>Home</span></a></li>
                        <li class="trail-item trail-end"><span>Contact Us</span></li>
                     </ul>
                  </nav>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- page title area end -->
<!-- contact area  -->
<section class="contact-area contact--area pt-120 pb-110 wow fadeInUp" data-wow-duration="1.5s"
   data-wow-delay=".3s">
   <div class="container">
      <div class="row">
         <div class="col-xxl-5 col-xl-6 col-lg-5">
            <div class="contact--wrapper mb-60">
               <div class="section__title mb-45">
                  <span class="sub-title">contact with us</span>
                  <h2 class="title">Speak with our consultant</h2>
               </div>
               <div class="contact-info mr-20">
                  <div class="single-contact-info d-flex align-items-center">
                     <div class="contact-info-icon">
                        <a href="#"><i class="flaticon-telephone-call"></i></a>
                     </div>
                     <div class="contact-info-text">
                        <span>Call us now</span>
                        <h5><a href="tel:+14107184031">1(410) 718-4031</a></h5>
                     </div>
                  </div>
                  <div class="single-contact-info d-flex align-items-center">
                     <div class="contact-info-icon">
                        <a href="#"><i class="flaticon-envelope"></i></a>
                     </div>
                     <div class="contact-info-text">
                        <span>send email</span>
                        <h5><a href="mailto:support@daydispatch.com">
                            <!--<span class="__cf_email__" data-cfemail="d7beb9b1b897a0b2b5b3b8a0f9b4b8ba">-->
                                support@daydispatch.com
                                <!--</span>-->
                            </a> </h5>
                     </div>
                  </div>
                  <div class="single-contact-info d-flex align-items-center">
                     <div class="contact-info-icon">
                        <a href="#"><i class="flaticon-pin"></i></a>
                     </div>
                     <div class="contact-info-text">
                        <span>    Address</span>
                        <h5><a href="https://maps.google.com/maps?q=1007+FREDERICK+ROAD+CATONSVILLE+MD+21228+UNITED+STATES">
                            <span style="font-weight: 800;">1007 Frederick Road</span> 
                            <br />
                              CATONSVILLE, MD, 21228 UNITED STATES</a></h5>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-xxl-7 col-xl-6 col-lg-7">
            <div class="contact-form mb-60">
               <form action="{{ route('Post.Contact.Lead') }}" id="contact-form" method="POST">
                   @csrf
                  <div class="row">
                     <div class="col-xxl-6 col-xl-6 col-lg-6">
                        <div class="single-input-field">
                           <input name="Lead_Name" type="text" placeholder="Your Name">
                           <i class="fas fa-user"></i>
                        </div>
                     </div>
                     <div class="col-xxl-6 col-xl-6 col-lg-6">
                        <div class="single-input-field">
                           <input name="Lead_Email" type="email" placeholder="Email Adress">
                           <i class="fas fa-envelope"></i>
                        </div>
                     </div>
                     <div class="col-xxl-6 col-xl-6 col-lg-6">
                        <div class="single-input-field">
                           <input name="Lead_Phone" type="text" class="phone-number" placeholder="Phone">
                           <i class="fas fa-phone-alt"></i>
                        </div>
                     </div>
                     <div class="col-xxl-6 col-xl-6 col-lg-6">
                         <div class="single-input-field">
                             <input name="Lead_Subject" type="text" placeholder="Enter Purpose">
                             <i class="fas fa-user-md-chat"></i>
                         </div>
                     </div>
                     <div class="col-xxl-12 col-xl-12 col-lg-12">
                        <div class="single-input-field textarea">
                           <textarea rows="10" cols="10" placeholder="Write Massage" name="Lead_Message"></textarea>
                           <i class="fas fa-edit"></i>
                        </div>
                     </div>
                     <div class="col-xxl-12 col-xl-12">
                        <button type="submit" class="fill-btn clip-btn">Send a message</button>
                     </div>
                  </div>
               </form>
               <p class="ajax-response"></p>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- contact area end -->
