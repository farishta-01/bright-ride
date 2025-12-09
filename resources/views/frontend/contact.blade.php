@extends('frontend.layout.app')
@section('title', 'Contact')
@section('css')
<style>
    .contact-hero {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        padding: 180px 0 100px;
        position: relative;
        overflow: hidden;
    }

    .contact-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }

    .contact-hero .section-header {
        position: relative;
        z-index: 1;
    }

    .contact-hero .section-header p {
        color: #818cf8;
    }

    .contact-hero .section-header h2 {
        color: #fff;
        font-size: 32px;
        margin-bottom: 1rem;
    }

    .contact-hero .section-header h2::after {
        display: none;
    }

    .hero-description {
        color: #94a3b8;
        font-size: 16px;
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.7;
    }

    /* Contact Section */
    .contact-section {
        background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%);
        padding: 80px 0 100px;
    }

    .contact-wrapper {
        display: grid;
        grid-template-columns: 1fr 1.2fr;
        gap: 3rem;
        margin-top: -40px;
        position: relative;
        z-index: 10;
    }

    /* Contact Info */
    .contact-info {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 24px;
        padding: 3rem;
    }

    .contact-info h3 {
        font-family: 'Playfair Display', serif;
        font-size: 24px;
        color: #fff;
        margin-bottom: 1rem;
    }

    .contact-info > p {
        color: #94a3b8;
        font-size: 15px;
        line-height: 1.7;
        margin-bottom: 2rem;
    }

    .info-item {
        display: flex;
        align-items: flex-start;
        gap: 1.25rem;
        margin-bottom: 2rem;
    }

    .info-icon {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.2) 0%, rgba(139, 92, 246, 0.1) 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .info-icon i {
        font-size: 18px;
        color: #818cf8;
    }

    .info-content h4 {
        font-family: 'Inter', sans-serif;
        font-size: 16px;
        font-weight: 600;
        color: #fff;
        margin-bottom: 0.35rem;
    }

    .info-content p {
        color: #94a3b8;
        font-size: 15px;
        line-height: 1.6;
    }

    .info-content a {
        color: #94a3b8;
        transition: color 0.3s ease;
    }

    .info-content a:hover {
        color: #818cf8;
    }

    /* Social Links */
    .social-links {
        margin-top: 2.5rem;
        padding-top: 2rem;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .social-links h4 {
        font-family: 'Inter', sans-serif;
        font-size: 14px;
        font-weight: 600;
        color: #fff;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 1rem;
    }

    .social-icons {
        display: flex;
        gap: 0.5rem;
    }

    .social-icons a {
        width: 38px;
        height: 38px;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .social-icons a i {
        font-size: 16px;
        color: #94a3b8;
        transition: color 0.3s ease;
    }

    .social-icons a:hover {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        border-color: transparent;
        transform: translateY(-3px);
    }

    .social-icons a:hover i {
        color: #fff;
    }

    /* Contact Form */
    .contact-form-wrapper {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 24px;
        padding: 3rem;
    }

    .contact-form-wrapper h3 {
        font-family: 'Playfair Display', serif;
        font-size: 24px;
        color: #fff;
        margin-bottom: 1.5rem;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .form-group.full-width {
        grid-column: 1 / -1;
    }

    .form-group label {
        display: block;
        font-size: 14px;
        font-weight: 500;
        color: #cbd5e1;
        margin-bottom: 0.5rem;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 12px 16px;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        color: #fff;
        font-size: 15px;
        transition: all 0.3s ease;
    }

    .form-group input::placeholder,
    .form-group textarea::placeholder {
        color: #64748b;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #6366f1;
        background: rgba(99, 102, 241, 0.1);
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }

    .form-group select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 1rem;
        padding-right: 3rem;
    }

    .form-group select option {
        background: #1e293b;
        color: #fff;
    }

    .form-group textarea {
        min-height: 120px;
        resize: vertical;
    }

    .submit-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        width: 100%;
        padding: 14px 24px;
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        color: #fff;
        font-size: 16px;
        font-weight: 600;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 20px 40px rgba(99, 102, 241, 0.3);
    }

    .submit-btn i {
        transition: transform 0.3s ease;
    }

    .submit-btn:hover i {
        transform: translateX(5px);
    }

    /* Map Section */
    .map-section {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        padding: 80px 0;
    }

    .map-wrapper {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 24px;
        overflow: hidden;
        height: 400px;
    }

    .map-wrapper iframe {
        width: 100%;
        height: 100%;
        border: none;
        filter: grayscale(100%) invert(92%) contrast(83%);
    }

    /* Footer */
    .footer-section {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        position: relative;
    }

    .footer-section::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.02'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }

    .footer-top {
        padding: 80px 0 60px;
        position: relative;
        z-index: 1;
        margin-top: 0;
    }

    .footer-grid {
        display: grid;
        grid-template-columns: 1.5fr 1fr 1fr 1.2fr;
        gap: 3rem;
    }

    .footer-widget h3 {
        font-family: 'Playfair Display', serif;
        font-size: 24px;
        color: #fff;
        margin-bottom: 1.25rem;
    }

    .footer-widget h3 span {
        color: #6366f1;
    }

    .footer-widget > p {
        color: #94a3b8;
        font-size: 14px;
        line-height: 1.7;
        margin-bottom: 1.25rem;
    }

    .footer-widget h4 {
        font-family: 'Inter', sans-serif;
        font-size: 14px;
        font-weight: 600;
        color: #fff;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 1.25rem;
        position: relative;
        padding-bottom: 0.6rem;
    }

    .footer-widget h4::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 30px;
        height: 2px;
        background: #6366f1;
    }

    .footer-widget ul li {
        display: block;
        margin-bottom: 0.5rem;
    }

    .footer-widget ul li a {
        color: #94a3b8;
        font-size: 14px;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .footer-widget ul li a::before {
        content: '';
        width: 0;
        height: 2px;
        background: #6366f1;
        transition: width 0.3s ease;
    }

    .footer-widget ul li a:hover {
        color: #fff;
        transform: translateX(8px);
    }

    .footer-widget ul li a:hover::before {
        width: 15px;
    }

    .newsletter-form {
        position: relative;
    }

    .newsletter-form input {
        width: 100%;
        padding: 12px 50px 12px 16px;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        color: #fff;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .newsletter-form input::placeholder {
        color: #64748b;
    }

    .newsletter-form input:focus {
        outline: none;
        border-color: #6366f1;
        background: rgba(99, 102, 241, 0.1);
    }

    .newsletter-form button {
        position: absolute;
        top: 50%;
        right: 6px;
        transform: translateY(-50%);
        width: 34px;
        height: 34px;
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        border: none;
        border-radius: 8px;
        color: #fff;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 0.8rem;
    }

    .newsletter-form button:hover {
        transform: translateY(-50%) scale(1.05);
    }

    .footer-copyright {
        padding: 1.5rem 0;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        position: relative;
        z-index: 1;
    }

    .copyright-wrapper {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .footer-copyright p {
        color: #64748b;
        font-size: 14px;
    }

    .footer-copyright a {
        color: #818cf8;
        transition: color 0.3s ease;
    }

    .footer-copyright a:hover {
        color: #fff;
    }

    .footer-social {
        display: flex;
        gap: 0.75rem;
    }

    .footer-social a {
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .footer-social a i {
        color: #94a3b8;
        font-size: 16px;
        transition: color 0.3s ease;
    }

    .footer-social a:hover {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        transform: translateY(-3px);
    }

    .footer-social a:hover i {
        color: #fff;
    }

    /* Scroll Top */
    #scroll-Top .return-to-top {
        position: fixed;
        right: 30px;
        bottom: 30px;
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        color: #fff;
        border-radius: 50%;
        display: none;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        cursor: pointer;
        z-index: 999;
        border: none;
        box-shadow: 0 10px 30px rgba(99, 102, 241, 0.3);
        transition: all 0.3s ease;
    }

    #scroll-Top .return-to-top:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(99, 102, 241, 0.4);
    }

    @media (max-width: 991px) {
        .contact-wrapper {
            grid-template-columns: 1fr;
        }

        .footer-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .contact-hero .section-header h2 {
            font-size: 2.25rem;
        }

        .form-row {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 767px) {
        .footer-grid {
            grid-template-columns: 1fr;
        }

        .copyright-wrapper {
            flex-direction: column;
            text-align: center;
        }
    }
</style>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="contact-hero">
        <div class="container">
            <div class="section-header">
                <p>Get In Touch</p>
                <h2>Contact Us</h2>
                <p class="hero-description">
                    Have questions about our vehicles or services? We're here to help.
                    Reach out to us and our team will get back to you as soon as possible.
                </p>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="container">
            <div class="contact-wrapper">
                <!-- Contact Info -->
                <div class="contact-info">
                    <h3>Let's Talk</h3>
                    <p>We'd love to hear from you. Whether you're looking for your dream car or have questions about our services, our team is ready to assist you.</p>

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fa fa-map-marker"></i>
                        </div>
                        <div class="info-content">
                            <h4>Visit Us</h4>
                            <p>123 Automotive Street<br>London, UK W1A 1AA</p>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="info-content">
                            <h4>Call Us</h4>
                            <p><a href="tel:+441234567890">+44 (0) 123 456 7890</a><br>
                            <a href="tel:+441234567891">+44 (0) 123 456 7891</a></p>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <div class="info-content">
                            <h4>Email Us</h4>
                            <p><a href="mailto:info@brightride.com">info@brightride.com</a><br>
                            <a href="mailto:sales@brightride.com">sales@brightride.com</a></p>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                        <div class="info-content">
                            <h4>Working Hours</h4>
                            <p>Mon - Fri: 9:00 AM - 7:00 PM<br>
                            Sat - Sun: 10:00 AM - 5:00 PM</p>
                        </div>
                    </div>

                    <div class="social-links">
                        <h4>Follow Us</h4>
                        <div class="social-icons">
                            <a href="#" title="Facebook"><i class="fa fa-facebook"></i></a>
                            <a href="#" title="Instagram"><i class="fa fa-instagram"></i></a>
                            <a href="#" title="Twitter"><i class="fa fa-twitter"></i></a>
                            <a href="#" title="LinkedIn"><i class="fa fa-linkedin"></i></a>
                            <a href="#" title="YouTube"><i class="fa fa-youtube-play"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="contact-form-wrapper">
                    <h3>Send Us a Message</h3>
                    <form action="#" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">Full Name *</label>
                                <input type="text" id="name" name="name" placeholder="John Doe" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address *</label>
                                <input type="email" id="email" name="email" placeholder="john@example.com" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="tel" id="phone" name="phone" placeholder="+44 123 456 7890">
                            </div>
                            <div class="form-group">
                                <label for="subject">Subject *</label>
                                <select id="subject" name="subject" required>
                                    <option value="">Select a subject</option>
                                    <option value="general">General Inquiry</option>
                                    <option value="sales">Sales Question</option>
                                    <option value="service">Service & Support</option>
                                    <option value="financing">Financing Options</option>
                                    <option value="test-drive">Book a Test Drive</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group full-width">
                            <label for="message">Your Message *</label>
                            <textarea id="message" name="message" placeholder="Tell us how we can help you..." required></textarea>
                        </div>

                        <button type="submit" class="submit-btn">
                            Send Message
                            <i class="fa fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="map-section">
        <div class="container">
            <div class="map-wrapper">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d158858.47340002653!2d-0.24168120642536509!3d51.52855824164916!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47d8a00baf21de75%3A0x52963a5addd52a99!2sLondon%2C%20UK!5e0!3m2!1sen!2s!4v1699999999999!5m2!1sen!2s" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="footer-section">
        <div class="container">
            <div class="footer-top">
                <div class="footer-grid">
                    <div class="footer-widget">
                        <h3>Bright<span>Ride</span></h3>
                        <p>Your trusted partner in finding the perfect vehicle. We offer premium cars at competitive prices with exceptional service and support.</p>
                        <div class="social-icons">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                        </div>
                    </div>

                    <div class="footer-widget">
                        <h4>Quick Links</h4>
                        <ul>
                            <li><a href="{{ route('frontend.home') }}">Home</a></li>
                            <li><a href="{{ route('frontend.service') }}">Services</a></li>
                            <li><a href="{{ route('frontend.featured_cars') }}">Featured Cars</a></li>
                            <li><a href="{{ route('frontend.brands') }}">Brands</a></li>
                            <li><a href="{{ route('frontend.contact') }}">Contact</a></li>
                        </ul>
                    </div>

                    <div class="footer-widget">
                        <h4>Top Brands</h4>
                        <ul>
                            <li><a href="#">BMW</a></li>
                            <li><a href="#">Mercedes-Benz</a></li>
                            <li><a href="#">Audi</a></li>
                            <li><a href="#">Toyota</a></li>
                            <li><a href="#">Honda</a></li>
                            <li><a href="#">Ford</a></li>
                        </ul>
                    </div>

                    <div class="footer-widget">
                        <h4>Newsletter</h4>
                        <p>Subscribe for the latest deals and new arrivals.</p>
                        <form class="newsletter-form">
                            <input type="email" placeholder="Enter your email">
                            <button type="submit"><i class="fa fa-paper-plane"></i></button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="footer-copyright">
                <div class="copyright-wrapper">
                    <p>&copy; {{ date('Y') }} BrightRide. All rights reserved. Designed by <a href="#">Saadullah</a></p>
                    <div class="footer-social">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div id="scroll-Top">
            <div class="return-to-top">
                <i class="fa fa-angle-up"></i>
            </div>
        </div>
    </footer>
@endsection
