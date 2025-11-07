<header class="new-header desk">
	<nav class="navbar navbar-dark" aria-label="Dark offcanvas navbar">
		<div class="container-fluid">
			<div class="row">
			<div class="col-2">
					<a href="{{ url('/') }}" class="logo"><img src="{{ asset($setting_data['header_logo'] ?? 'front/images/lg_white.webp') }}" alt="Logo" class="img-fluid"></a>
				</div>
				<div class="col-10">
					<ul class="menu-bar">
						<li class="nav-item"><a class="nav-link active" href="{{ url('/') }}">Home </a> </li>
						<li class="nav-item"><a class="nav-link " href="{{ url('about-us') }}">About Us </a></li>
						<li class="nav-item"><a class="nav-link " href="{{ url('properties') }}">Our Listings </a></li>
						<li class="nav-item"><a class="nav-link " href="{{ url('property-management') }}">Co Hosting</a></li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Attractions</a>
							@php
							$location = App\Models\Location::whereNull("is_parent")->orderby('id', 'desc')->get();
							@endphp
							@if(count($location))
							<ul class="dropdown-menu">
								@foreach($location as $c)
								<li class="dropdown-item"><a class="nav-link" href="{{url('attractions/location',$c->seo_url)}}">{{$c->name}}</a></li>
								@endforeach
							</ul>
							@endif
						</li>
						<li class="nav-item"><a class="nav-link " href="{{ url('contact-us') }}"> Contact Us </a></li>
					</ul>
				</div>
			
				<!-- <div class="col-5">
					<ul class="menu-bar">
					</ul>
				</div> -->
			</div>
		</div>
	</nav>
</header>
<header class="page-header mob">
	<div class="container">
		<div class="row">
			<div class="mobl-logo">
				<a href="{{ url('/') }}" class="logo"><img src="{{ asset($setting_data['header_logo'] ?? 'front/images/logo.png') }}" alt="Logo" class="img-fluid"></a>
				<p>Call/Text:- <a href="tel:{!! $setting_data['email'] ?? '#' !!}">{!! $setting_data['email'] ?? '#' !!}</a></p>
			</div>
			<div class="menu-toggle1" id="menu-toggle1"><i class="fa fa-bars"></i></div>
			<div class="menu-bar-in" id="tag1">
				<div class="mobile-nav">
					<div class="mobile-menu-logo">
						<a href="{{ url('/') }}" class="logo"><img src="{{ asset($setting_data['header_logo'] ?? 'front/images/logo.png') }}" alt="Logo" class="img-fluid"></a>
						<span id="close-menu"><i class="fa fa-times" id="close-menu1"></i></span>
					</div>
					<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
						<div class="navbar-collapse" id="main_nav">
							<ul class="navbar-nav">
								<li class="nav-item"><a class="nav-link active" href="{{ url('/') }}">Home </a> </li>
								<ul class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
									<li class="dropdown-item"><a class="nav-link " href="{{ url('about-us') }}">About Us</a></li>
									<li class="dropdown-item"><a class="nav-link " href="{{ url('about-owner') }}">About Owner</a></li>
								</ul>

								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Attractions</a>
									@php
									$location = App\Models\Location::whereNull("is_parent")->orderby('id', 'desc')->get();
									@endphp
									@if(count($location))
									<ul class="dropdown-menu">
										@foreach($location as $c)
										<li><a class="dropdown-item" href="{{url('attractions/location',$c->seo_url)}}">{{$c->name}}</a></li>
										@endforeach
									</ul>
									@endif
								</li>
								<li class="nav-item"><a class="nav-link " href="{{ url('properties') }}">Our Listings </a></li>
								<li class="nav-item"><a class="nav-link " href="{{ url('properties') }}"> Property Management </a></li>
								<li class="nav-item"><a class="nav-link " href="{{ url('contact-us') }}"> Contact Us </a></li>
							</ul>
						</div>
					</nav>
				</div>
			</div>
		</div>
	</div>
</header>
{{-- 
footer --}}

<!--<section class="newsletter-section d-none">-->
<!--  <div class="newsletter-wrapper">-->
<!--    <div class="news-letter lazyloaded">-->
<!--      <div class="container">-->
<!--        <div class="row">-->
<!--          <div class="col">-->
<!--            <div class="newsletter">-->
<!--              <div class="news-title">-->
<!--                <div class="news-con">-->
<!--                  <p class="newstext">Join us to make the most of our resources today</p>-->
<!--                </div>-->
<!--              </div>-->
<!--              <div class="subscribe-content">-->
<!--                <div class="news-content">-->
<!--                  <div class="news-button-sec">-->
<!--                    <a href="{{ url('contact-us') }}">Contact Now</a>-->
<!--                  </div>-->
<!--                </div>-->
<!--              </div>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->
<!--  </div>-->
<!--</section>-->


<!--<footer>-->
<!--  <div class="container">-->
<!--    <div class="footer-logo text-center">-->
<!--      <a href="{{ url('/') }}" class="logo">-->
<!--        <img src="{{ asset($setting_data['footer_logo'] ?? 'front/images/logo.png') }}" alt="Logo" class="img-fluid">-->
<!--      </a>-->
<!--    </div>-->
<!--    <div class="row">-->
<!--      <div class="col-4 first">-->
<!--        <h4>CONTACT INFO</h4>-->
<!--        <div class="footer-contact-info">-->
<!--          <p class="footer-contact-phone"><i class="fa-solid fa-mobile-button"></i><a href="tel:{!! $setting_data['mobile'] ?? '#' !!}">{!! $setting_data['mobile'] ?? '#' !!}</a></p>-->
<!--          <p class="footer-contact-mail"><i class="fa-solid fa-envelope-open"></i><a href="mailto:{!! $setting_data['email'] ?? '#' !!}">{!! $setting_data['email'] ?? '#' !!}</a></p>-->
<!--        </div>-->
<!--      </div>-->
<!--      <div class="col-4 quick">-->
<!--        <ul class="quick-links">-->
<!--          <li><a href="{{ url('/') }}">Home</a></li>-->
<!--          <li class="nav-item dropdown">-->
<!--            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">About</a>-->
<!--            <ul class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">-->
<!--              <li class="dropdown-item"><a class="nav-link " href="{{ url('about-us') }}">About Us</a></li>-->
<!--              <li class="dropdown-item"><a class="nav-link " href="{{ url('about-owner') }}">About Owner</a></li>-->
<!--            </ul>-->
<!--          </li>-->
<!--          <li class="nav-item dropdown">-->
<!--            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Attractions</a>-->
<!--            @php-->
<!--            $location = App\Models\Location::whereNull("is_parent")->orderby('id', 'desc')->get();-->
<!--            @endphp-->
<!--            @if(count($location))-->
<!--            <ul class="dropdown-menu">-->
<!--              @foreach($location as $c)-->
<!--              <li class="dropdown-item"><a class="nav-link" href="{{url('attractions/location',$c->seo_url)}}">{{$c->name}}</a></li>-->
<!--              @endforeach-->
<!--            </ul>-->
<!--            @endif-->
<!--          </li>-->
         
<!--        </ul>-->
<!--        <ul class="quick-links">-->
<!--          <li><a href="{{ url('property-management') }}">Co-Hosting</a></li>-->
<!--          <li><a href="{{ url('properties') }}"> Our Listings</a></li>-->
          <!-- <li><a href="{{ url('attraction') }}">Attraction</a></li> -->
<!--          <li><a href="{{ url('contact-us') }}">Contact Us</a></li>-->
<!--        </ul>-->
<!--      </div>-->
<!--      <div class="col-4 get">-->
<!--        <h4>Stay in Touch</h4>-->
<!--        <p>Stay up-to-date for discounted rates!</p>-->
<!--        <form action="">-->
<!--          <input type="email" placeholder="Email Address">-->
<!--          <button type="submit" class="main-btn">Subscribe</button>-->
<!--        </form>-->
<!--      </div>-->
<!--    </div>-->
<!--  </div>-->
<!--  <div class="copyright">-->
<!--    <div class="container">-->
<!--      <div class="row">-->
<!--        <div class="col-4 left">-->
<!--          <p>{!! $setting_data['copyright'] ?? '#' !!}</p>-->
<!--        </div>-->
<!--        <div class="col-4 right">-->
<!--          <div class="footer-about-social-list">-->
<!--            <a href="{!! $setting_data['instagram'] ?? '#' !!}" target="_blank" rel="noopener"><i class="fa-brands fa-instagram"></i></a>-->
<!--            <a href="{!! $setting_data['facebook'] ?? '#' !!}" target="_blank" rel="noopener"><i class="fa-brands fa-facebook-f"></i></a>-->
            <!-- <a href="{!! $setting_data['tiktok'] ?? '#' !!}" target="_blank" rel="noopener"><i class="fa-brands fa-tiktok"></i></a>
<!--            <a href="{!! $setting_data['youtube'] ?? '#' !!}" target="_blank" rel="noopener"><i class="fa-brands fa-youtube"></i></a> -->-->
<!--          </div>-->
<!--        </div>-->
<!--        <div class="col-4 center">-->
<!--         <div class="right_copyright">-->
<!--                        <p>Designed &amp; Developed by <a href="https://www.webdesignvr.com/" target="_blank"><img src="{{ asset('front')}}/images/footer_1.webp"></a></p>-->
<!--                    </div>-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->

<!--  </div>-->
<!--</footer>-->
<!--@include("front.layouts.js")-->
<!--@yield("js")-->
<!--<script>-->
<!--  $(document).on("submit", ".newsletter-data", function(e) {-->
<!--    e.preventDefault();-->
<!--    data = $(this).serialize();-->
<!--    url = $(this).attr("action");-->
<!--    $.post(url, data, function(data) {-->
<!--      if (data.status == 200) {-->
<!--        $(".newsletter-data")[0].reset();-->
<!--        toastr.success(data.message);-->
<!--      } else {-->
<!--        toastr.error(data.message);-->
<!--      }-->
<!--    });-->
<!--  });-->
<!--</script>-->