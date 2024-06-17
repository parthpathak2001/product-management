<footer class="footer-wrapper common-bg">

    <div class="footer-widget-area">
        <div class="container">
            <div class="footer-widget-inner section-space">
                <div class="row mbn-30">
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="footer-widget-item mb-30">
                            <div class="footer-widget-logo">
                                <a href="{{ route('login') }}">
                                    <img src="{{ asset('assets/img/favicon.jpg') }}" alt="" height="50px">
                                </a>
                            </div>
                            <ul class="footer-widget-body">
                                <li class="widget-text">{{ env('APP_NAME') }}, Established in 2009 at Rajkot in
                                    Gujarat, is leading Manufacturer of Flour Kneading Machines, Flour Mill Machinery &
                                    Accessories in India.</li>
                                <li class="address">
                                    <em>address:</em>
                                    Bhavanagar Highway, Gadhka Road, R.k.university, Tramba
                                    Rajkot, India, 360020
                                </li>
                                <li class="phone">
                                    <em>phones:</em>
                                    <a href="tel:+91-8048054309">+91-8048054309</a>
                                </li>
                                <li class="email">
                                    <em>e-mail:</em>
                                    <a href="mailto:megakitchensystem@gmail.com">megakitchensystem@gmail.com</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="footer-widget-item mb-30">
                            <div class="footer-widget-title">
                                <h5>Product Categories</h5>
                            </div>

                            <ul class="footer-widget-body">
                                @php
                                    $foo_categories = \App\Models\Category::select('slug', 'name')->orderBy('id', 'DESC')->limit(6)->get();
                                @endphp

                                @foreach ($foo_categories as $category)
                                    <li><a href="{{ route('product.index', $category->slug) }}">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="footer-widget-item mb-30">
                            <div class="footer-widget-title">
                                <h5>Quick Links</h5>
                            </div>
                            <ul class="footer-widget-body">
                                <li><a href="{{ route('index') }}">Home</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="footer-widget-item mb-30">
                            <div class="footer-widget-title">
                                <h5>newsletter and social</h5>
                            </div>
                            <div class="footer-widget-body">
                                <div class="newsletter-inner">
                                    <p>Get E-mail updates about our latest shop and special offers.</p>
                                    <form method="post" action="#" id="frm_newsletter">
                                        @csrf

                                        <input type="email" class="news-field" name="email" id="email" autocomplete="off" placeholder="Enter your email address">
                                        <button class="news-btn" id="nl_submit">Subscribe</button>
                                    </form>
                                </div>

                                <div class="footer-social-link">
                                    <a href="#" class="facebook" data-bs-toggle="tooltip" title="Facebook" target="_blank">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                    <a href="#" class="twitter" data-bs-toggle="tooltip" title="Twitter" target="_blank">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                    <a href="#" class="google" data-bs-toggle="tooltip" title="Google plus" target="_blank">
                                        <i class="fa fa-google-plus"></i>
                                    </a>
                                    <a href="#" class="instagram" data-bs-toggle="tooltip" title="Instagram" target="_blank">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                    <a href="#" class="youtube" data-bs-toggle="tooltip" title="Youtube" target="_blank">
                                        <i class="fa fa-youtube"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 order-2 order-md-1">
                    <div class="copyright-text">
                        <p>&copy; <script>document.write(new Date().getFullYear())</script> <b>{{ config('app.name') }}</b> Made with <i class="fa fa-heart text-danger"></i> by <a href="{{ env('DEVELOPER_INSTAGRAM') }}" target="_blank"><b>{{ env('DEVELOPER_NAME') }}</b></a></p>
                    </div>
                </div>
                {{-- <div class="col-md-6 order-1 order-md-2">
                    <div class="payment-method">
                        <img src="{{ asset('assets/img/payment.png') }}" alt="">
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</footer>
