<!-- PHP INCLUDES -->
<?php
session_start();

// include model & template (Menggunakan __DIR__ agar jalur file PHP aman dan presisi)
include __DIR__ . '/../models/connect.php';
include __DIR__ . '/../../config/Includes/templates/header.php';
include __DIR__ . '/../../config/Includes/templates/navbar.php';

// Menggunakan BASE_URL untuk variabel path aset publik
$public_assets = BASE_URL . 'public/assets/images/';
$public_js     = BASE_URL . 'public/js/';
$public_css    = BASE_URL . 'public/css/';
?>

<!-- HOME SECTION -->
<section class="home-section" id="home-section">
    <div class="home-section-content">
        <div id="home-section-carousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#home-section-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#home-section-carousel" data-slide-to="1"></li>
                <li data-target="#home-section-carousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <!-- FIRST SLIDE -->
                <div class="carousel-item active">
                    <img class="d-block w-100" src="<?php echo $public_assets; ?>depan.jpg" alt="First slide">
                    <div class="carousel-caption d-md-block">
                        <h3>Barbersix Kesambi-Tuparev Cirebon.</h3>
                        <p>
                            Bukan Hanya Sekedar Potong Rambut, Tapi Pengalaman
                            <br>
                            Kualitas Premium Datang Dan Rasakan
                        </p>
                    </div>
                </div>
                <!-- SECOND SLIDE -->
                <div class="carousel-item">
                    <img class="d-block w-100" src="<?php echo $public_assets; ?>depan1.jpeg" alt="Second slide">
                    <div class="carousel-caption d-md-block">
                        <h3>Tersedia Sistem Booking Antrean Online</h3>
                        <p>
                            Mudah Dan Praktis
                            <br>
                            Pesan Sekarang Dan Datang Sesuai Jadwal
                        </p>
                    </div>
                </div>
                <!-- THIRD SLIDE -->
                <div class="carousel-item">
                    <img class="d-block w-100" src="<?php echo $public_assets; ?>depan2.jpeg" alt="Third slide">
                    <div class="carousel-caption d-md-block">
                        <h3>Terletak Di Pusat Kota.</h3>
                        <p>
                            Tempat Strategis Dan Nyaman
                            <br>
                            Datang Dan Rasakan Pengalaman Potong Rambut Yang Berbeda
                        </p>
                    </div>
                </div>
            </div>
            <!-- PREVIOUS & NEXT -->
            <a class="carousel-control-prev" href="#home-section-carousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#home-section-carousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</section>

<!-- ABOUT SECTION -->
<section id="about" class="about_section">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="about_content" style="text-align: center;">
                    <h3>Introducing</h3>
                    <h2>BarberSix <br>Sejak 2020</h2>
                    <img src="<?php echo $public_assets; ?>about-logo.png" alt="logo">
                    <p style="color: #777">
                        Barbersix adalah barbershop populer di Cirebon yang didirikan oleh Danu Devano, salah satu finalis ajang pencarian bakat The Cuts Indonesia. Barbershop ini bertransformasi dari sekadar tempat pangkas rambut biasa menjadi pusat gaya hidup pria yang juga melayani berbagai gaya rambut modern dan dikelola oleh para barber profesional..
                    </p>
                    <a href="#" class="default_btn" style="opacity: 1;">More about us</a>
                </div>
            </div>
            <div class="col-md-6 d-none d-md-block">
                <div class="about_img" style="overflow:hidden">
                    <img class="about_img_1" src="<?php echo $public_assets; ?>about-1.jpg" alt="about-1">
                    <img class="about_img_2" src="<?php echo $public_assets; ?>about-2.jpg" alt="about-2">
                    <img class="about_img_3" src="<?php echo $public_assets; ?>about-3.jpg" alt="about-3">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SERVICES SECTION -->
<section class="services_section" id="services">
    <div class="container">
        <div class="section_heading">
            <h3>Trendy Salon & Spa</h3>
            <h2>Layanan Kami</h2>
            <div class="heading-line"></div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 padd_col_res">
                <div class="service_box">
                    <i class="bs bs-scissors-1"></i>
                    <h3>Style Terbaru</h3>
                    <p>Potongan modern yang rapi dan mengikuti tren..</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 padd_col_res">
                <div class="service_box">
                    <i class="bs bs-razor-2"></i>
                    <h3>Cukur Janggut</h3>
                    <p>Janggut rapi, bersih, dan lebih berkarakter..</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 padd_col_res">
                <div class="service_box">
                    <i class="bs bs-brush"></i>
                    <h3>Cukur Halus</h3>
                    <p>Hasil cukur bersih, nyaman, dan presisi..</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 padd_col_res">
                <div class="service_box">
                    <i class="bs bs-hairbrush-1"></i>
                    <h3>Masker Wajah</h3>
                    <p>Perawatan wajah agar segar dan lebih bersih..</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- BOOKING SECTION -->
<section class="book_section" id="booking">
    <div class="book_bg"></div>
    <div class="map_pattern"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-6">
                <form action="appointment.php" method="post" id="appointment_form" class="form-horizontal appointment_form">
                    <div class="book_content">
                        <h2 style="color: white;">Booking Kursi & Capster</h2>
                        <p style="color: #999;">
                            Barber is a person whose occupation is mainly to cut dress groom <br>style and shave men's and boys hair.
                        </p>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 padding-10">  
                            <input type="date" class="form-control">
                        </div>
                        <div class="col-md-6 padding-10">
                            <input type="time" class="form-control">
                        </div>
                    </div>

                    <!-- SUBMIT BUTTON -->
                    <button id="app_submit" class="default_btn" type="submit">
                        Make Appointment
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- GALLERY SECTION -->
<section class="gallery-section" id="gallery">
    <div class="section_heading">
        <h3>Trendy Salon & Spa</h3>
        <h2>Barbers Gallery</h2>
        <div class="heading-line"></div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 gallery-column">
                <div style="height: 230px">
                    <div class="gallery-img" style="background-image: url('<?php echo $public_assets; ?>gallery1.jpg');"></div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 gallery-column">
                <div style="height: 230px">
                    <div class="gallery-img" style="background-image: url('<?php echo $public_assets; ?>gallery2.jpg');"></div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 gallery-column">
                <div style="height: 300px">
                    <div class="gallery-img" style="background-image: url('<?php echo $public_assets; ?>gallery3.jpg');"></div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 gallery-column">
                <div style="height: 300px">
                    <div class="gallery-img" style="background-image: url('<?php echo $public_assets; ?>gallery4.jpg');"></div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 gallery-column">
                <div style="height: 300px">
                    <div class="gallery-img" style="background-image: url('<?php echo $public_assets; ?>gallery5.jpg');"></div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 gallery-column">
                <div style="height: 300px">
                    <div class="gallery-img" style="background-image: url('<?php echo $public_assets; ?>gallery6.jpg');"></div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 gallery-column">
                <div style="height: 300px">
                    <div class="gallery-img" style="background-image: url('<?php echo $public_assets; ?>gallery7.jpg');"></div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 gallery-column">
                <div style="height: 300px">
                    <div class="gallery-img" style="background-image: url('<?php echo $public_assets; ?>portfolio-8.jpg');"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- TEAM SECTION -->
<section id="team" class="team_section">
    <div class="container">
        <div class="section_heading">
            <h3>Barber Team</h3>
            <h2>Kapster Kami</h2>
            <div class="heading-line"></div>
        </div>
        <ul class="team_members row justify-content-center"> 
            <li class="col-lg-3 col-md-2 padd_col_res">
                <div class="team_member">
                    <img src="<?php echo $public_assets; ?>barber1.jpg" alt="Team Member">
                </div>
            </li>
            <li class="col-lg-3 col-md-2 padd_col_res">
                <div class="team_member">
                    <img src="<?php echo $public_assets; ?>barber.jpg" alt="Team Member">
                </div>
            </li>
        </ul>
    </div>
</section>

<!-- REVIEWS SECTION -->
<section id="reviews" class="testimonial_section">
    <div class="container">
        <div id="reviews-carousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#reviews-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#reviews-carousel" data-slide-to="1"></li>
                <li data-target="#reviews-carousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="<?php echo $public_assets; ?>barbershop_image_1.jpg" alt="First slide" style="visibility: hidden;">
                    <div class="carousel-caption d-md-block">
                        <h3>Its Not Just a Haircut, Its an Experience.</h3>
                        <p>Our barbershop is the territory created purely for males who appreciate<br>premium quality, time and flawless look.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- PRICING SECTION -->
<section class="pricing_section" id="pricing">
    <?php
        $stmt = $con->prepare("Select * from service_categories");
        $stmt->execute();
        $categories = $stmt->fetchAll();
    ?>
    <div class="container">
        <div class="section_heading">
            <h3>Daftar Harga & Layanan</h3>
            <h2>Harga Layanan</h2>
            <div class="heading-line"></div>
        </div>
        <div class="row">
            <?php
                foreach($categories as $category)
                {
                    $stmt = $con->prepare("Select * from services where category_id = ?");
                    $stmt->execute(array($category['category_id']));
                    $totalServices = $stmt->rowCount();
                    $services = $stmt->fetchAll();

                    if($totalServices > 0)
                    {
                    ?>
                        <div class="col-lg-4 col-md-6 sm-padding">
                            <div class="price_wrap">
                                <h3><?php echo $category['category_name'] ?></h3>
                                <ul class="price_list">
                                    <?php
                                        foreach($services as $service)
                                        {
                                            ?>
                                            <li>
                                                <h4><?php echo $service['service_name'] ?></h4>
                                                <p><?php echo $service['service_description'] ?></p>
                                                <span class="price">
                                                    Rp <?php echo number_format($service['service_price'], 0, ',', '.'); ?>
                                                </span>
                                            </li>
                                            <?php
                                        }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    <?php
                    }
                }
            ?>
        </div>
    </div>
</section>

<!-- CONTACT SECTION -->
<section class="contact-section" id="contact-us">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 sm-padding">
                <div class="contact-info">
                    <h2>Terhubung Bersama Kami<br>Kirim Kami Pesan Sekarang!</h2>
                    <p>Saasbiz is a different kind of architecture practice...</p>
                    <h3>Jln.Kesambi No 71<br>Kota Cirebon</h3>
                    <h4>
                        <span style="font-weight: bold">Email:</span> barbersix71@gmail.com<br> 
                        <span style="font-weight: bold">Phone:</span> +62 812 3456 7890
                    </h4>
                </div>
            </div>
            <div class="col-lg-6 sm-padding">
                <div class="contact-form">
                    <div id="contact_ajax_form" class="contactForm">
                        <div class="form-group colum-row row">
                            <div class="col-sm-6"><input type="text" id="contact_name" name="name" class="form-control" placeholder="Name"></div>
                            <div class="col-sm-6"><input type="email" id="contact_email" name="email" class="form-control" placeholder="Email"></div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12"><input type="text" id="contact_subject" name="subject" class="form-control" placeholder="Subject"></div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12"><textarea id="contact_message" name="message" cols="30" rows="5" class="form-control message" placeholder="Message"></textarea></div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12"><button id="contact_send" class="default_btn">Send Message</button></div>
                        </div>
                        <img src="<?php echo $public_assets; ?>ajax_loader_gif.gif" id="contact_ajax_loader" style="display: none">
                        <div id="contact_status_message"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- WIDGET SECTION / FOOTER -->
<section class="widget_section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="footer_widget">
                    <img src="<?php echo $public_assets; ?>logo.png" alt="Brand" class="footer-logo">
                    <ul class="widget_social">
                        <li><a href="#"><i class="fab fa-facebook-f fa-2x"></i></a></li>
                        <li><a href="#"><i class="fab fa-instagram fa-2x"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                 <div class="footer_widget">
                    <h3>Alamat</h3>
                    <p>Jl. Kesambi No.71, Kesambi, Kec. Kesambi, Kota Cirebon, Jawa Barat</p>
                    <p>barbersix71@gmail.com<br>+62 812 3456 7890</p>
                 </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer_widget">
                    <h3>Jam Buka</h3>
                    <ul class="opening_time">
                        <li>Senin - Minggu 11:00 - 21:00</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../../config/Includes/templates/footer.php'; ?>