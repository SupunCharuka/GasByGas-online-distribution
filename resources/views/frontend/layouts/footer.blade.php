
<footer id="footer" class="footer dark-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="{{route('/')}}" class="logo d-flex align-items-center">
            <span class="sitename">GasByGas</span>
          </a>
          <div class="footer-contact pt-3">
            <p>123 Galle Road, </p>
            <p>Colombo 03, Sri Lanka</p>
            <p class="mt-3"><strong>Phone:</strong> <span>+94 11 234 5678</span></p>
            <p><strong>Email:</strong> <span><a href="mailto:info@example.lk">info@example.lk</a></span></p>
          </div>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About us</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Terms of service</a></li>
            <li><a href="#">Privacy policy</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><a href="#">Home Gas Delivery</a></li>
            <li><a href="#">Industrial & Commercial Supply</a></li>
            <li><a href="#">Flexible Payment Options</a></li>
            <li><a href="#">Real-time Tracking</a></li>
            <li><a href="#">24/7 Customer Support</a></li>
          </ul>
        </div>

        <div class="col-lg-4 col-md-12 footer-newsletter">
          <h4>Our Newsletter</h4>
          <p>Subscribe to receive updates on new services, exclusive offers, and safety tips.</p>
          <form action="forms/newsletter.php" method="post" class="php-email-form">
            <div class="newsletter-form"><input type="email" name="email"><input type="submit" value="Subscribe"></div>
            <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">Your subscription request has been sent. Thank you!</div>
          </form>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">GasByGas</strong> <span>All Rights Reserved</span></p>
     
    </div>

  </footer>
