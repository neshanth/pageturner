
    <script src="{{ asset('js/app.js') }}"></script>
    {{-- Owl Carousel   --}}
    <script src="{{ asset("js/jquery.min.js") }}"></script>
    <script src="{{ asset("js/owl.carousel.min.js") }}"></script>
    <script>
        $('.owl-carousel').owlCarousel({
            loop:true,
            center:true,
            nav:true,
            navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'> </i>"],
            responsive:{
                0:{
                    items:1
                },
                300:{
                    items:3
                },
                1000:{
                    items:4
                }
            }
        })
    </script>
    {{-- Owl Carousel   --}}
</body>
</html>
