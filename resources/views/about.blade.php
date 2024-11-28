@extends('layouts.app')
@section('content')  
  <main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="contact-us container">
      <div class="mw-930">
        <h2 class="page-title">About US</h2>
      </div>

      <div class="about-us__content pb-5 mb-5">
        <p class="mb-5">
          <img loading="lazy" class="w-100 h-auto d-block" src="assets/images/about/bg-1.png" width="1410"
            height="550" alt="" />
        </p>
        <div class="mw-930">
          <h3 class="mb-4">OUR STORY</h3>
          <p class="fs-6 fw-medium mb-4">Building Supply Bridge was a journey of growth and learning. We began with 
            little experience in web development, choosing Laravel as our framework of choice.</p>
          <p class="mb-4">The learning curve was steep—setting up migrations, routes, and understanding controllers 
            felt overwhelming at times. Each error message became a lesson, and with every success, we grew more 
            confident. But our biggest challenge came when we struggled to find the right inspiration for our website. 
            After much brainstorming, we realized the purpose was simple: to bridge the gap between suppliers and 
            customers. With that vision, Supply Bridge was born, a platform focused on trust and convenience. Through
             persistence, we turned a dream into a reality, learning and evolving every step of the way.</p>
          <div class="row mb-3">
            <div class="col-md-6">
              <h5 class="mb-3">Our Mission</h5>
              <p class="mb-3">To provide a reliable and user-friendly platform that empowers local businesses and individuals by offering a diverse range of quality products, secure transactions, and exceptional customer service.</p>
            </div>
            <div class="col-md-6">
              <h5 class="mb-3">Our Vision</h5>
              <p class="mb-3">To become the leading e-commerce platform in our local community, seamlessly connecting us and customers to create a bridge of trust, convenience, and sustainable growth.</p>
            </div>
          </div>
        </div>
        <div class="mw-930 d-lg-flex align-items-lg-center">
          <div class="image-wrapper col-lg-6">
            <img class="h-auto" loading="lazy" src="assets/images/about/bg-2.png" width="450" height="500" alt="">
          </div>
          <div class="content-wrapper col-lg-6 px-lg-4">
            <h5 class="mb-3">The Company</h5>
            <p>Supply Bridge is your trusted local e-commerce platform, designed to seamlessly connect suppliers 
            and customers in our community. We aim to make shopping and sourcing effortless by offering a wide 
            range of quality products, secure transactions, and exceptional service. Whether you're a business 
            or an individual, Supply Bridge is here to bridge the gap and bring convenience to your doorstep.</p>
          </div>
        </div>
      </div>
    </section>

  </main>


  <div id="scrollTop" class="visually-hidden end-0"></div>
  <div class="page-overlay"></div>

  <script src="assets/js/plugins/jquery.min.js"></script>
  <script src="assets/js/plugins/bootstrap.bundle.min.js"></script>
  <script src="assets/js/plugins/bootstrap-slider.min.js"></script>
  <script src="assets/js/plugins/swiper.min.js"></script>
  <script src="assets/js/plugins/countdown.js"></script>
  <script src="assets/js/theme.js"></script>
</body>

@endsection