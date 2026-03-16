<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S&M | Home</title>
    <link rel="stylesheet" href="style/style.css" />
    <script src="script.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<!-- Load Navbar-->

<body onload="loadNavbar()">
    <div class="container">
        <div id="navbar-container"></div>

        <!-- HOME / HERO SECTION -->
        <section id="home" class="hero">
            <div class="section-inner">
                <h1>Welcome to <span class="highlight">S&M Hotel</span></h1>
                <p>
                    Discover comfort, style, and warm hospitality at <strong>S&M Hotel</strong>.
                    Whether you're traveling for business or leisure, we make every stay memorable.
                </p>
            </div>
        </section>

        <!-- HOTEL SECTION -->
        <section id="hotel" class="section">
            <div class="section-inner">
                <h2>Our Hotels Across the UK</h2>
                <p>
                    S&M Hotel is a modern, stylish brand with multiple branches across the UK,
                    offering warm hospitality, elegant design, and premium comfort in every city.
                </p>

                <div class="hotel-grid">
                    <!-- London -->
                    <div class="hotel-card">
                        <div class="hotel-image hotel-london"></div>
                        <div class="hotel-info">
                            <h3>S&M London</h3>
                            <p>Located in the heart of the capital, ideal for business trips and city breaks.</p>
                        </div>
                    </div>

                    <!-- Sheffield -->
                    <div class="hotel-card">
                        <div class="hotel-image hotel-sheffield"></div>
                        <div class="hotel-info">
                            <h3>S&M Sheffield</h3>
                            <p>A welcoming stay in South Yorkshire, close to key attractions and transport links.</p>
                        </div>
                    </div>

                    <!-- Manchester -->
                    <div class="hotel-card">
                        <div class="hotel-image hotel-manchester"></div>
                        <div class="hotel-info">
                            <h3>S&M Manchester</h3>
                            <p>Perfect for shopping, nightlife, and football fans visiting the city.</p>
                        </div>
                    </div>

                    <!-- Birmingham -->
                    <div class="hotel-card">
                        <div class="hotel-image hotel-birmingham"></div>
                        <div class="hotel-info">
                            <h3>S&M Birmingham</h3>
                            <p>Convenient for conferences, events, and exploring the vibrant city centre.</p>
                        </div>
                    </div>

                    <!-- Liverpool -->
                    <div class="hotel-card">
                        <div class="hotel-image hotel-liverpool"></div>
                        <div class="hotel-info">
                            <h3>S&M Liverpool</h3>
                            <p>Enjoy culture, music, and waterfront views in this iconic port city.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ROOM SECTION -->
        <section id="rooms" class="rooms-section">
            <div class="section-inner">
                <h2>Our Rooms</h2>
                <p>Explore our premium rooms designed for comfort and luxury.</p>

                <div class="rooms">
                    <div class="room-item">
                        <div class="room-image" style="background-image:url('https://victoriahotel.co.uk/sites/default/files/2022-09/bc-victoria-accom_standard-single-room-301-at-victoria-hotel.jpg');"></div>
                        <h3>Single Room</h3>
                        <p>Cozy and stylish, perfect for solo travelers.</p>
                    </div>

                    <div class="room-item">
                        <div class="room-image" style="background-image:url('https://djmzubtjl6upi.cloudfront.net/wp-content/uploads/sites/3/2017/12/Deluxe-Double-Guestroom2.jpg');"></div>
                        <h3>Double Room</h3>
                        <p>Ideal for couples or friends. Modern design and premium amenities.</p>
                    </div>

                    <div class="room-item">
                        <div class="room-image" style="background-image:url('https://www.royalgardenhotel.co.uk/_img/videos/deluxe-twin.png');"></div>
                        <h3>Twin Room</h3>
                        <p>Two single beds, perfect for companions.</p>
                    </div>

                    <div class="room-item">
                        <div class="room-image" style="background-image:url('https://www.peninsula.com/en/-/media/12---london-property/rooms/20230918-new-images/london_deluxe-room-king_resized.jpg?mw=905&hash=5EBA7EAB9A5C9EC1B43B72F28067F469');"></div>
                        <h3>Deluxe Room</h3>
                        <p>Spacious and luxurious with premium bedding and décor.</p>
                    </div>

                    <div class="room-item">
                        <div class="room-image" style="background-image:url('https://www.telegraph.co.uk/content/dam/luxury/2018/02/14/Shangri-La-Shard.jpg');"></div>
                        <h3>Suite</h3>
                        <p>Ultimate luxury with large living area, top amenities, and stunning views.</p>
                    </div>
                </div>

                <div class="room-view-btn">
                    <a href="viewRoom.html" class="hero-btn">View Room Details</a>
                </div>
            </div>
        </section>


    </div>
    </div>
    </section>

    <!-- AMENITIES SECTION -->
    <section id="amenities" class="amenities-section">
        <div class="section-inner">
            <h2>Our Amenities</h2>
            <p>Experience the luxury and comfort of our exclusive amenities.</p>

            <div class="amenities-grid">
                <div class="amenity-card">
                    <div class="amenity-icon"><i class="fas fa-swimming-pool"></i></div>
                    <h3>Swimming Pool</h3>
                    <p>Relax in our heated indoor and outdoor pools.</p>
                </div>
                <div class="amenity-card">
                    <div class="amenity-icon"><i class="fas fa-spa"></i></div>
                    <h3>Spa & Wellness</h3>
                    <p>Rejuvenate with full-service spa treatments.</p>
                </div>
                <div class="amenity-card">
                    <div class="amenity-icon"><i class="fas fa-utensils"></i></div>
                    <h3>Fine Dining</h3>
                    <p>Indulge in gourmet meals from our world-class chefs.</p>
                </div>
                <div class="amenity-card">
                    <div class="amenity-icon"><i class="fas fa-dumbbell"></i></div>
                    <h3>Fitness Center</h3>
                    <p>State-of-the-art equipment for all your fitness needs.</p>
                </div>
                <div class="amenity-card">
                    <div class="amenity-icon"><i class="fas fa-concierge-bell"></i></div>
                    <h3>24/7 Room Service</h3>
                    <p>Enjoy personalized service anytime, anywhere.</p>
                </div>
                <div class="amenity-card">
                    <div class="amenity-icon"><i class="fas fa-car"></i></div>
                    <h3>Parking & Concierge</h3>
                    <p>Convenient valet parking and concierge services available.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER SECTION -->
    <footer id="contact" class="footer-section">
        <div class="section-inner">
            <h2>Contact Us</h2>
            <p>Have questions? Reach out to us!</p>

            <div class="footer-content">
                <!-- Contact Info -->
                <div class="contact-info">
                    <p><i class="fas fa-map-marker-alt"></i> 32 Luxury St, Sheffield, United Kingdom</p>
                    <p><i class="fas fa-phone-alt"></i> +44 123 456 7890</p>
                    <p><i class="fas fa-envelope"></i> info@smhotel.com</p>
                </div>

                <!-- Contact Form -->
                <form class="contact-form" action="#" method="post">
                    <div class="form-row">
                        <input type="text" name="name" placeholder="Your Name" required>
                    </div>
                    <div class="form-row">
                        <input type="email" name="email" placeholder="Your Email" required>
                    </div>
                    <div class="form-row">
                        <textarea name="message" rows="4" placeholder="Your Message" required></textarea>
                    </div>
                    <button type="submit" class="footer-btn">Send Message</button>
                </form>
            </div>

            <p class="footer-note">&copy; 2025 S&M Hotel</p>
        </div>
    </footer>
    </div>
</body>

</html>