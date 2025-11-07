// Initialize Swiper for Testimonials
document.addEventListener('DOMContentLoaded', function() {
  // Initialize Swiper
  const testimonialSwiper = new Swiper('.testimonial-swiper', {
    // Optional parameters
    slidesPerView: 1,
    spaceBetween: 20,
    loop: true,
    grabCursor: true,
    autoplay: {
      delay: 5000,
      disableOnInteraction: false,
    },
    
    // Responsive breakpoints
    breakpoints: {
      // Mobile
      320: {
        slidesPerView: 1,
        spaceBetween: 20
      },
      // Mobile landscape
      576: {
        slidesPerView: 1,
        spaceBetween: 20
      },
      // Tablet
      768: {
        slidesPerView: 2,
        spaceBetween: 30
      },
      // Desktop
      1024: {
        slidesPerView: 3,
        spaceBetween: 30
      }
    },
    
    // Navigation arrows
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    
    // Pagination
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    
    // Accessibility
    a11y: {
      prevSlideMessage: 'Previous testimonial',
      nextSlideMessage: 'Next testimonial',
      paginationBulletMessage: 'Go to testimonial {{index}}',
    }
  });
  
  // Add active class to visible slides
  testimonialSwiper.on('slideChange', function() {
    const slides = document.querySelectorAll('.testimonial-swiper .swiper-slide');
    slides.forEach(slide => {
      slide.classList.remove('active-slide');
    });
    
    // Find visible slides and add active class
    setTimeout(() => {
      const activeSlides = document.querySelectorAll('.testimonial-swiper .swiper-slide-visible');
      activeSlides.forEach(slide => {
        slide.classList.add('active-slide');
      });
    }, 100);
  });
  
  // Trigger initial slide change to set active slides
  setTimeout(() => {
    testimonialSwiper.slideNext(0);
    testimonialSwiper.slidePrev(0);
  }, 200);
});