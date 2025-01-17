  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/frontend/vendors/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/frontend/vendors/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/frontend/vendors/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/frontend/vendors/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/frontend/vendors/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('assets/frontend/vendors/waypoints/noframework.waypoints.js') }}"></script>
  <script src="{{ asset('assets/frontend/vendors/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('assets/frontend/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('assets/frontend/js/main.js') }}"></script>

  @yield('scripts')
  @stack('scripts')
