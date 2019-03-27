<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>

<head>
    <?php $this->load->view("umum/_partials/head.php") ?>

</head>

<body>
    <!-- header -->
    <?php $this->load->view("umum/_partials/header.php") ?>

    <!-- //header -->

    <!-- breadcrumb -->
    <?php $this->load->view("umum/_partials/breadcrumb.php") ?>

    <!-- //breadcrumb -->

	<!-- field -->
	<section class="services">
        <div class="container">
            <div class="inner-sec-wthree">
                <div class="error-404" data-aos="fade-down">
                    <h4>404</h4>
                    <p>Ups! Tidak ada yang bisa dilihat di sini.</p>
                    <form action="#" method="post" data-aos="fade-up">
                        <input class="serch" type="search" name="cari" placeholder="Cari di sini..." required="">
                        <button class="btn1">
							<i class="fa fa-search" aria-hidden="true"></i>
						</button>
                        <div class="clearfix"> </div>
                    </form>
                    <div class="error">
                        <ul>
                            <li>
                                <a class="facebook" href="//www.facebook.com/">
									<i class="fab fa-facebook-f"></i>
								</a>
                            </li>
                            <li>
                                <a class="facebook" href="//www.instagram.com/">
									<i class="fab fa-instagram"></i>
								</a>
                            </li>
                            <li>
                                <a class="facebook" href="//www.youtube.com">
									<i class="fab fa-youtube"></i>
								</a>
                            </li>
                        </ul>

                    </div>

                    <a class="b-home" href="<?= base_url() ?>">Kembali ke Beranda</a>
                </div>

            </div>
        </div>
	</section>

    <div class="flexslider">
       	<ul class="slides">
        	<li>
                <div class="testimonials_grid">
                    <p><br><br><br><br><br></p>
                </div>
            </li>
        </ul>
    </div>
    <!-- //field -->

    <!-- footer -->
    <?php $this->load->view("umum/_partials/footer.php") ?>

    <!-- //footer -->

    <!-- copyright -->
    <?php $this->load->view("umum/_partials/copyright.php") ?>

    <!-- //copyright -->

    <!-- javascript -->
    <?php $this->load->view("umum/_partials/javascript.php") ?>

    <!-- //javascript -->
</body>

</html>