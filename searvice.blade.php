@extends("front.layouts.master")
@section("title",$data->meta_title)
@section("keywords",$data->meta_keywords)
@section("description",$data->meta_description)
@section("logo",$data->image)
@section("header-section")
{!! $data->header_section !!}
@stop
@section("footer-section")
{!! $data->footer_section !!}
@stop
@section("container")

    @php
        $name=$data->name;
        $bannerImage=asset('front/images/breadcrumb.webp');
        if($data->bannerImage){
            $bannerImage=asset($data->bannerImage);
        }
    @endphp
    
    <style>
     .attraction-header {
        text-align: center;
        
      }

      .attraction-header h1 {
        color: var(--text-dark);
        font-size: 2.5rem;
        font-weight: 600;
        margin-bottom: 1rem;
      }

      .attraction-header p {
        color: var(--grey-dark);
        font-size: 1.2rem;
        max-width: 800px;
        margin: 0 auto 1.5rem;
      }

      .section-container {
        padding: 2rem 0;
      }

      .content-card {
        border-radius: 15px;
        height: 100%;
        margin-left: 2rem;
      }

      .image-container {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        transition: transform 0.3s ease;
        height: 100%;
      }

      .image-container:hover {
        transform: scale(1.02);
      }

      .main-image {
        width: 100%;
        height: 450px;
        object-fit: cover;
        display: block;
      }

      .section-title {
        color: var(--text-dark);
        font-size: 2rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        line-height: 1.3;
        font-family: "Playfair Display", serif;
      }

      .section-text {
        color: var(--grey-dark);
        font-size: 1.05rem;
        line-height: 1.8;
        margin-bottom: 1.5rem;
      }

      .btn-explore {
        background: var(--primary-accent);
        color: var(--text-light);
        padding: 12px 30px;
        border-radius: 3px;
        font-weight: 500;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.9rem;
      }

      .btn-explore:hover {
        background: var(--highlight-bg);
        transform: translateY(-3px);
        color: var(--text-light);
      }

      .fade-in-element {
        /*opacity: 0;*/
        transform: translateY(20px);
        transition: opacity 0.6s ease, transform 0.6s ease;
      }

      .fade-in-element.visible {
        opacity: 1;
        transform: translateY(0);
      }

    

      .dots-left {
        left: -1rem;
      }

      .dots-right {
        right: -1rem;
      }

      @media (max-width: 991px) {
        .section-container {
          padding: 1rem 0;
        }

        .content-card {
          margin-bottom: 0.5rem;
        }

        .main-image {
          height: 350px;
          margin-bottom: 2rem;
        }

        .attraction-header h1 {
          font-size: 2rem;
        }
        .content-card { 
        
            margin-left: 0;
        }
      }

      @media (max-width: 767px) {
        .section-container {
          padding: 0.5rem 0;
        }

        .main-image {
          height: 250px;
        }

        .section-title {
          font-size: 1.5rem;
        }

        .section-text {
          font-size: 1rem;
        }

        .attraction-header h1 {
          font-size: 1.8rem;
        }

        .attraction-header p {
          font-size: 1rem;
        }
      }
    </style>
    
    <!-- start banner sec -->
  
    <!--<section class="breadcrumb" style="background-image: url({{ $bannerImage }});">-->
    <!--    <div class="auto-container">-->
    <!--        <h2 data-aos="zoom-in" data-aos-duration="1500">{{$name}}</h2>-->
    <!--        <ul class="page-breadcrumb" data-aos="fade-up" data-aos-duration="1500">-->
    <!--            <li><a href="{{ url('/') }}">Home</a></li>-->
    <!--            <li>/ {{$name}}</li>-->
    <!--        </ul>-->
    <!--    </div>-->
    <!--</section>-->


	<!-- start about section -->
     
   <!--<section class="about-sec">-->
   <!--    <div class="container">-->
   <!--        <div class="row">-->
   <!--           {!! $data->longDescription !!}-->
   <!--        </div>-->
   <!--    </div>-->
   <!--</section>-->
   <section>
         <!-- Attractions Header -->
    <div class="container">
      <div class="attraction-header">
        <h1 class="fade-in-element">Discover Bentonville Attractions</h1>
        <img src="{{asset('front/images/8c62c8_cba0f5b4d12543be8704d9437fd40f4f~mv2.avif')}}" />
        <img src="{{asset('front/images/Bentonville%20(2)%20(1).avif')}}" />
        <p class="fade-in-element">
          Explore the natural beauty, cultural experiences, and outdoor
          adventures waiting for you in Bentonville and the surrounding areas.
          Our carefully curated selection of local attractions will enhance your
          stay and create unforgettable memories.
        </p>
      </div>
    </div>
  
    <div class="container">
      <!-- Scenic Views Section -->
      <div class="section-container">
        <div class="row align-items-center position-relative">
          <div class="col-lg-6 col-md-12 mb-4 mb-lg-0">
            <div class="image-container fade-in-element">
              <img
                src="{{asset('front/images/IMG_8339.avif')}}"
                alt="Scenic Views of Bentonville"
                class="main-image"
              />
            </div>
          </div>
          <div class="col-lg-6 col-md-12">
            <div class="content-card fade-in-element">
              <h2 class="section-title">Financial/ Project Modeling</h2>
              <p class="section-text">
                From conducting feasibility, market analysis, cost estimating, and pro-forma development we an assist with conducting the required underwriting needed for a successful development. 
              </p>
              
            </div>
          </div>
        </div>
      </div>

      <!-- Hiking Trails Section -->
      <div class="section-container">
        <div class="row align-items-center position-relative">
          <div class="col-lg-6 col-md-12 mb-4 mb-lg-0 order-2 order-lg-1">
            <div class="content-card fade-in-element">
              <h2 class="section-title">Entitlement Assistance </h2>
              <p class="section-text">
               Land development and land repositioning can be difficult. From public hearings, to engineering coordination, and planning we can assist to ensure you get the right zoning, entitlements, and utilities to support your development. 


              </p>
              
            </div>
          </div>
          <div class="col-lg-6 col-md-12 order-1 order-lg-2">
            <div class="image-container fade-in-element">
              <img
                src="{{asset('front/images/Condo-vs-Townhome-Whats-the-Difference.avif')}}"
                alt="Mountain Biking Trails in Bentonville"
                class="main-image"
              />
            </div>
          </div>
        </div>
      </div>

      <!-- Local Cuisine Section -->
      <div class="section-container">
        <div class="row align-items-center position-relative">
          <div class="col-lg-6 col-md-12 mb-4 mb-lg-0">
            <div class="image-container fade-in-element">
              <img
                src="{{asset('front/images/bourbon.avif')}}"
                alt="Local Cuisine in Bentonville"
                class="main-image"
              />
            </div>
          </div>
          <div class="col-lg-6 col-md-12">
            <div class="content-card fade-in-element">
              <h2 class="section-title">
Development Coordination</h2>
              <p class="section-text">
               Pre-Development can get busy, from coordination with design, contractors, and municipalities there is a lot going on. Let us be your single owner representation to stream line coordination and keep your project on track. We have a great network of designers and engineers that can bring your concept to life. 


              </p>
             
            </div>
          </div>
        </div>
      </div>

      <!-- Crystal Bridges Section -->
      <div class="section-container">
        <div class="row align-items-center position-relative">
          <div class="col-lg-6 col-md-12 mb-4 mb-lg-0 order-2 order-lg-1">
            <div class="content-card fade-in-element">
              <h2 class="section-title">Project Management</h2>
              <p class="section-text">
                Keep your project on track and on budget. From permitting to final occupancy we will be there every step of the way to deliver your product on time and on budget. 
              </p>
             
            </div>
          </div>
          <div class="col-lg-6 col-md-12 order-1 order-lg-2">
            <div class="image-container fade-in-element">
              <img
                src="{{asset('front/images/aframe2.avif')}}"
                alt="Crystal Bridges Museum in Bentonville"
                class="main-image"
              />
            </div>
          </div>
        </div>
      </div>

     
    </div>
       </section>
{!! $data->seo_section !!}
@stop