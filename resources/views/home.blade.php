<!DOCTYPE html>
<html>
  <head>
	<title>COVR</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

	<!-- Included Google Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,900,700,500,300,100' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
	<!-- CSS Files comes here -->
	<link href="css/home.css" rel="stylesheet" media="screen">                              	 <!-- Grid System -->

	<!-- Modernizer and IE specyfic files -->
	<script src="js/modernizr.custom.js"></script>

  </head>
  <body>
    <div id="preloader_container">
      <!-- Preloader Screen -->
		  <header class="preloader_header">
        <div class="preloader_loader">
          <svg class="preloader_inner" width="60px" height="60px" viewBox="0 0 80 80">
            <path class="preloader_loader_circlebg" d="M40,10C57.351,10,71,23.649,71,40.5S57.351,71,40.5,71 S10,57.351,10,40.5S23.649,10,40.5,10z"/>
            <path id="preloader_loader_circle" class="preloader_loader_circle" d="M40,10C57.351,10,71,23.649,71,40.5S57.351,71,40.5,71 S10,57.351,10,40.5S23.649,10,40.5,10z"/>
          </svg>
        </div>
	    </header>
	    <!-- //Preloader Screen -->
      <!-- Fullscreen homepage -->
		<section class="hero_fullscreen background_single">
		<!-- This section class is where you can edit background choice (background_single, background_slider, background_video) you can also enable gradient overlay (gradient_overlay)-->


			<!-- Logo -->
	  	<div class="container align-center">
	  		<div class="row">
	  			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
	  			<h1 class="logo home_anim1">COVR</h1>
          <!-- <img src="images/logo.png" alt="logo" class="logo home_anim1" /> -->
	  			</div>
	  		</div>
			</div>
			<!-- //Logo -->


			<!-- Main content -->
		  <div class="container" id="main_content">
				<div class="row" >
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 home_content align-center">
						<h1 class="home_anim2">A sua viagem começa aqui!</h1>
						<h6 class="home_anim3">O que acha de economizar mais no câmbio da sua próxima viagem?<br class="visible-lg visible-md">Calma, vamos explicar tudo direitinho para você.</h6>
					</div>
				</div>

				<div class="row" >
				 	<div class="col-xs-8 col-sm-6 col-md-4 col-lg-4 col-xs-offset-2 col-sm-offset-3 col-md-offset-4 col-lg-offset-4 align-center">
						<!-- Form Area -->
						<div class="form_area home_anim5 ">
							<h4>Cadastre-se agora!</h4>

							<!-- Contact Form -->
							<div action="php/contactform.php" id="contact-form" method="post">
								<div class="contact_form">
									<div class="input-field">
					  				<input v-model='nome' type="text" name="contact-name" class="validate">
					  				<label for="first_name">Seu nome</label>
					  			</div>

					  			<div class="input-field">
					  				<input v-model='sobrenome' type="text" name="contact-phone" class="validate">
					  				<label for="contact_phone">Sobrenome</label>
					  			</div>

					  			<div class="input-field">
					  				<input v-model='email' type="email" name="contact-email" class="validate">
					  				<label for="contact_email">Email</label>
					  			</div>

					  			<div class="input-field">
					  				<input v-model='password' type="password" name="contact-password" class="validate">
					  				<label for="contact_password">Senha</label>
					  			</div>

				  			</div>
				  			<button class="btn waves-effect waves-light" v-on="click: registerSubmit" name="action">CADASTRE-SE</button>
						  </div>
						<!-- //Contact Form -->
					  </div>

						<!-- //Form Area -->

						<!-- CTA Buttons-->
						<div class="cta_button_area home_anim6 align-center">
							<a href="" class="go_to_more_info"><small>Não tem certeza? Descubra mais.</small></a>
						</div>
						<!-- //CTA Buttons-->

					</div>
				</div>

				<div v-transition="slide-transition" id="message" v-class="warning" v-if="displayErrors">
          <div id="alert">
            <div class="alert alert-block alert-danger">
              <div class="fa fa-exclamation-triangle" style="font-size:2em;"></div>
              <div class="alert_title">
                <h4>O cadastro não pode ser efetuado pelos seguintes motivos:</h4>
              </div>
              <br>
              <ul class="unordered">
                <li><h6>Email já existe</h6></li>
              </ul>
            </div>
          </div>
        </div><!-- Message container -->




			</div>
			<!-- //Main content -->

			<!-- Single Image Background -->
      <!-- Video Background -->
			<div id="maximage_video">
				<video autoplay="autoplay" loop="loop" muted="muted" width="896" height="504">
				    <source src="video/video.mp4" type="video/mp4" />
				    <source src="video/video.webm" type="video/webm" />
				    <source src="video/video.ogv" type="video/ogg" />
				</video>
			</div>
			<!-- //Video Background -->


			<!-- Slider Background -->
			<div id="maximage_slider">
				<img src="images/background_slider_01.jpg" alt=""/>
				<img src="images/background_slider_02.jpg" alt=""/>
				<img src="images/background_slider_03.jpg" alt=""/>
				<img src="images/background_slider_04.jpg" alt=""/>
			</div>
			<!-- //Slider Background -->


			<!-- Single Image Background -->
			<div id="maximage_single">
				<img src="images/carro-classico-estrada.jpg" alt=""/>
			</div>
			<!-- //Single Image Background -->
			<!-- //Single Image Background -->


		</section><!-- //Homepage -->



		<!-- More Info #################### -->
		<section id="more_info" class="subsection background_color1">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 align-left more_info_intro more_info_anim1">
						<h3 style="margin-top:0; ">O COVR veio te ajudar a trocar moeda de maneira nova!</h3>
						<p>Apenas lhe ajudamos a encontrar algum amigo que tenha a moeda que você deseja.</p>
						<p>Assim, os dois podem economizar em taxas que pagariam em casas de câmbio. O processo não poderia ser mais simples.</p>
					</div>

					<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 align-left image_box more_info_anim2">
						<img src="images/more_info_img1.jpg" alt="" class="img_responsive">
						<h5>Oferta</h5>
						<p>Você posta a sua oferta, escolhendo a moeda, quantidade e local.</p>
					</div>

					<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 align-left image_box more_info_anim3">
						<img src="images/more_info_img2.jpg" alt="" class="img_responsive">
						<h5>Escolha</h5>
						<p>E nós lhe mostramos quais são as ofertas que que fazem mais sentido para você.</p>
					</div>
				</div>
			</div>
		</section><!-- //More info -->



		<!-- Features #################### -->
		<section id="features" class="subsection background_color2 ">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 align-center intro features_anim1">
						<h3>Vantagens</h3>
						<p>Nós iremos ajudar você a encontrar as melhores ofertas baseada na sua preferência, seja ela distância, valor, preço.</p>
					</div>


					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 align-center features_image features_anim2">
						<img src="images/features_img.jpg" alt="" class="img_responsive">
					</div>


					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

						<div class="iconbox features_anim3">
							<div class="iconbox_icon fa fa-exchange"></div>
							<div class="iconbox_content">
								<h5>Eficiência</h5>
								<p>Procuramos em nosso banco de dados as ofertas que fazem mais sentido para você.</p>
							</div>
						</div>

						<div class="iconbox features_anim4">
							<div class="fa fa-star-half-o iconbox_icon"></div>
							<div class="iconbox_content">
								<h5>Reputação</h5>
								<p>Cada transação bem sucedida qualifica mais o usuário, assim, suas trocas ficam mais seguras.</p>
							</div>
						</div>

						<div class="iconbox features_anim5">
							<div class="fa fa-money iconbox_icon"></div>
							<div class="iconbox_content">
								<h5>Economia</h5>
								<p>Trocando a moeda com outras pessoas, você não precisa pagar taxas de câmbio caríssimas.</p>
							</div>
						</div>

					</div>
				</div>
			</div>
		</section><!-- //Features -->



		<!-- Screenshots #################### -->
		<section id="screenshots">
			<div class="container-fluid background_color2">
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 image_container screenshots_anim1">
					<a href="images/screenshots_image1.jpg" data-lightbox-gallery="gallery1">
					<img src="images/screenshots_image1.jpg" alt="" class="img_responsive"></a>
					</div>

					<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 image_container screenshots_anim2">
					<a href="images/screenshots_image2.jpg" data-lightbox-gallery="gallery1">
					<img src="images/screenshots_image2.jpg" alt="" class="img_responsive"></a>
					</div>

					<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 image_container screenshots_anim3">
					<a href="images/screenshots_image3.jpg" data-lightbox-gallery="gallery1">
					<img src="images/screenshots_image3.jpg" alt="" class="img_responsive"></a>
					</div>

					<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 image_container screenshots_anim4">
					<a href="images/screenshots_image4.jpg" data-lightbox-gallery="gallery1">
					<img src="images/screenshots_image4.jpg" alt="" class="img_responsive"></a>
					</div>
				</div>
			</div>
		</section><!-- //Screenshots -->



		<!-- FAQ #################### -->
		<section id="faq" class="subsection background_color2">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 align-center faq_anim1">
						<div class="intro">
							<h3>Perguntas frequentes</h3>
							<p>Ainda tem dúvidas? Nós temos as respostas.</p>
						</div>
					</div>
				</div>

				<div class="row align-left faq_anim2">

					<!-- Q1 -->
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<div class="iconbox">
							<h5>How can I submit a design?</h5>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris</p>
						</div>
					</div>
					<!-- //Q1 -->

					<!-- Q2 -->
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<div class="iconbox">
							<h5>How long does it take for a design to be showcased?</h5>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do.</p>
						</div>
					</div>
					<!-- //Q2 -->

				</div>

				<div class="row align-left faq_anim3">

					<!-- Q3 -->
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<div class="iconbox">
							<h5>Why was my design rejected?</h5>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
						</div>
					</div>
					<!-- //Q3 -->

					<!-- Q4 -->
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<div class="iconbox">
							<h5>How do I become a verified member?</h5>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
						</div>
					</div>
					<!-- //Q4 -->

				</div>
			</div>
		</section><!-- //FAQ -->



		<!-- Reviews #################### -->
		<section id="reviews" class="subsection background_color1">
			<div class="container">
				<div class="row">

					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 reviews_anim1 reviews_intro">
					<h3>Social proof section to empower user decision!</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
						<p>Lessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae.</p>
						<p>Et harum quidem rerum facilis est et expedita distinctiod quod maxime placeat facere possimus.</p>
					</div>

				    <!-- Review Carousel -->
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 reviews_anim2">
						<div class="owl-carousel align-center">

							<!-- Review 1 -->
							<div class="single_review">
								<img src="images/review_01.jpg" alt="" class="img-circle">
								<div class="review_content">
									<h6>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium.</h6>
									<p>- Jenny McLane, Microsoft</p>
								</div>
							</div>
							<!-- //Review 1 -->


							<!-- Review 2 -->
							<div class="single_review">
								<img src="images/review_02.jpg" alt="" class="img-circle">
								<div class="review_content">
									<h6>Inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo!</h6>
									<p>- Jahn Kovalsky, Apple</p>
								</div>
							</div>
							<!-- //Review 2 -->


							<!-- Review 3 -->
							<div class="single_review">
								<img src="images/review_03.jpg" alt="" class="img-circle">
								<div class="review_content">
									<h6>At vero eos et accusamus et iusto odio dignissimos ducimus.</h6>
									<p>- Meggie Patterson, Google</p>
								</div>
							</div>
							<!-- //Review 3 -->


							<!-- Review 4 -->
							<div class="single_review">
								<img src="images/review_04.jpg" alt="" class="img-circle">
								<div class="review_content">
									<h6>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo.</h6>
									<p>- Billy McDillon </p>
								</div>
							</div>
							<!-- //Review 4 -->

						</div>
					</div>
				</div><!-- //Review Carousel -->


				<!-- Clients logos -->
				<div class="row align-center">
					<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3 reviews_logo reviews_anim3"><img src="images/reviews_logos/logo1.png" alt=""></div>
					<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3 reviews_logo reviews_anim4"><img src="images/reviews_logos/logo2.png" alt=""></div>
					<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3 reviews_logo reviews_anim5"><img src="images/reviews_logos/logo3.png" alt=""></div>
					<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3 reviews_logo reviews_anim6"><img src="images/reviews_logos/logo4.png" alt=""></div>
				</div><!-- //Clients logos -->

			</div>
		</section>
		<!-- //Reviews -->



		<!-- CTA #################### -->
		<section class="subsection background_color2">
			<div class="container">
				<div class="row align-center">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<h3>Venha testar o COVR,<br class="visible-lg visible-md">é totalmente gratuito.</h3>
						<div><button class="btn waves-effect waves-light subscribe-submit go_to_home">CADASTRE-SE</button></div>
					</div>
				</div>
			</div>
		</section>
		<!-- //CTA -->



		<!-- Footer #################### -->
		<section id="footer" class="subsection background_color1">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 align-center">
					<p><small>Copyright © 2015 Convert CCD, Made with ❤ by Mat Przegietka</small></p>
					</div>
				</div>
			</div>
		</section><!-- //Footer -->


	</div><!-- //preloader -->

    <!-- JavaScript plugins comes here -->
    <script src="js/home.js"></script>                    <!-- Main Js file -->
    <script src="js/site.js"></script>
  </body>
</html>
