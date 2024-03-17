@include('dashboards/users/layouts/script')

<body class="iq-bg-primary">
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">
        <div class="container p-0">
            <div class="row no-gutters">
                <div class="col-sm-12 text-center">
                    <div class="iq-error position-relative mt-5">
                        <img src="images/error/500.png" class="img-fluid iq-error-img" alt="">
                        <h1 class="text-in-box">500</h1>
                        <h2 class="mb-0">Oops! This Page is Not Working.</h2>
                        <p>The requested is Internal Server Error.</p>
                        <a class="btn btn-primary mt-3" href="{{ url('/') }}"><i class="ri-home-4-line"></i>Back
                            to
                            Home</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Wrapper END -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('findash/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('findash/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('findash/assets/js/bootstrap.min.js') }}"></script>
    <!-- Appear JavaScript -->
    <script src="{{ asset('findash/assets/js/jquery.appear.js') }}"></script>
    <!-- Countdown JavaScript -->
    <script src="{{ asset('findash/assets/js/countdown.min.js') }}"></script>
    <!-- Counterup JavaScript -->
    <script src="{{ asset('findash/assets/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('findash/assets/js/jquery.counterup.min.js') }}"></script>
    <!-- Wow JavaScript -->
    <script src="{{ asset('findash/assets/js/wow.min.js') }}"></script>
    <!-- Apexcharts JavaScript -->
    <script src="{{ asset('findash/assets/js/apexcharts.js') }}"></script>
    <!-- Slick JavaScript -->
    <script src="{{ asset('findash/assets/js/slick.min.js') }}"></script>
    <!-- Select2 JavaScript -->
    <script src="{{ asset('findash/assets/js/select2.min.js') }}"></script>
    <!-- Owl Carousel JavaScript -->
    <script src="{{ asset('findash/assets/js/owl.carousel.min.js') }}"></script>
    <!-- Magnific Popup JavaScript -->
    <script src="{{ asset('findash/assets/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- Smooth Scrollbar JavaScript -->
    <script src="{{ asset('findash/assets/js/smooth-scrollbar.js') }}"></script>
    <!-- lottie JavaScript -->
    <script src="{{ asset('findash/assets/js/lottie.js') }}"></script>
    <!-- am core JavaScript -->
    <script src="{{ asset('findash/assets/js/core.js') }}"></script>
    <!-- am charts JavaScript -->
    <script src="{{ asset('findash/assets/js/charts.js') }}"></script>
    <!-- am animated JavaScript -->
    <script src="{{ asset('findash/assets/js/animated.js') }}"></script>
    <!-- am kelly JavaScript -->
    <script src="{{ asset('findash/assets/js/kelly.js') }}"></script>
    <!-- am maps JavaScript -->
    <script src="{{ asset('findash/assets/js/maps.js') }}"></script>
    <!-- am worldLow JavaScript -->
    <script src="{{ asset('findash/assets/js/worldLow.js') }}"></script>
    <!-- Style Customizer -->
    <script src="{{ asset('findash/assets/js/style-customizer.js') }}"></script>
    <!-- Chart Custom JavaScript -->
    <script src="{{ asset('findash/assets/js/chart-custom.js') }}"></script>
    <!-- Custom JavaScript -->
    <script src="{{ asset('findash/assets/js/custom.js') }}"></script>
</body>

</html>
