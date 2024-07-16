<div class="gotox-testimonial-four-wrapper">

	<div class="testimonial-four-top-wrapper">


	<div <?php $this->print_render_attribute_string('wrapper'); ?>>
		<div class="swiper-wrapper">
			<?php if (is_array($testimonials)) :
				foreach ($testimonials as $testimonial) : ?>

					<div class="swiper-slide">
						<div <?php $this->print_render_attribute_string('testimonial'); ?>>

							<?php
							$rating = $testimonial['rating'];
							$this->add_render_attribute('star-rating', 'class', 'dmt-stars');
							if($rating == '10'){
								$this->add_render_attribute('star-rating', 'class', 'dmt-stars--1 dmt-stars--1' );
							} elseif($rating == '15'){
								$this->add_render_attribute('star-rating', 'class', 'dmt-stars--1 dmt-stars--1--half' );
							} elseif($rating == '20'){
								$this->add_render_attribute('star-rating', 'class', 'dmt-stars--2 dmt-stars--2' );
							} elseif ($rating == '25') {
								$this->add_render_attribute('star-rating', 'class', 'dmt-stars--2 dmt-stars--2--half' );
							} elseif ($rating == '30') {
								$this->add_render_attribute('star-rating', 'class', 'dmt-stars--3 dmt-stars--3' );
							} elseif ($rating == '35') {
								$this->add_render_attribute('star-rating', 'class', 'dmt-stars--3 dmt-stars--3--half' );
							} elseif ($rating == '40') {
								$this->add_render_attribute('star-rating', 'class', 'dmt-stars--4 dmt-stars--4' );
							} elseif ($rating == '45') {
								$this->add_render_attribute('star-rating', 'class', 'dmt-stars--4 dmt-stars--4--half' );
							} elseif ($rating == '50') {
								$this->add_render_attribute('star-rating', 'class', 'dmt-stars--5 dmt-stars--5' );
							}

							?>

							<div class="dmt-widget-stars">
								<div <?php echo $this->get_render_attribute_string('star-rating'); ?> >
									<svg role="img" viewBox="0 0 251 46" xmlns="http://www.w3.org/2000/svg">
										<title lang="en">
											4.5 out of five star rating on
											Trustpilot
										</title>
										<g class="dmt-star">
											<path class="dmt-star__canvas" fill="#dcdce6" d="M0 46.330002h46.375586V0H0z"></path>
											<path class="dmt-star__shape" d="M39.533936 19.711433L13.230239 38.80065l3.838216-11.797827L7.02115 19.711433h12.418975l3.837417-11.798624 3.837418 11.798624h12.418975zM23.2785 31.510075l7.183595-1.509576 2.862114 8.800152L23.2785 31.510075z" fill="#FFF"></path>
										</g>
										<g class="dmt-star">
											<path class="dmt-star__canvas" fill="#dcdce6" d="M51.24816 46.330002h46.375587V0H51.248161z"></path>
											<path class="dmt-star__canvas--half" fill="#dcdce6" d="M51.24816 46.330002h23.187793V0H51.248161z"></path>
											<path class="dmt-star__shape" d="M74.990978 31.32991L81.150908 30 84 39l-9.660206-7.202786L64.30279 39l3.895636-11.840666L58 19.841466h12.605577L74.499595 8l3.895637 11.841466H91L74.990978 31.329909z" fill="#FFF"></path>
										</g>
										<g class="dmt-star">
											<path class="dmt-star__canvas" fill="#dcdce6" d="M102.532209 46.330002h46.375586V0h-46.375586z"></path>
											<path class="dmt-star__canvas--half" fill="#dcdce6" d="M102.532209 46.330002h23.187793V0h-23.187793z"></path>
											<path class="dmt-star__shape" d="M142.066994 19.711433L115.763298 38.80065l3.838215-11.797827-10.047304-7.291391h12.418975l3.837418-11.798624 3.837417 11.798624h12.418975zM125.81156 31.510075l7.183595-1.509576 2.862113 8.800152-10.045708-7.290576z"  fill="#FFF"></path>
										</g>
										<g class="dmt-star">
											<path class="dmt-star__canvas" fill="#dcdce6" d="M153.815458 46.330002h46.375586V0h-46.375586z"></path>
											<path class="dmt-star__canvas--half" fill="#dcdce6" d="M153.815458 46.330002h23.187793V0h-23.187793z"></path>
											<path class="dmt-star__shape" d="M193.348355 19.711433L167.045457 38.80065l3.837417-11.797827-10.047303-7.291391h12.418974l3.837418-11.798624 3.837418 11.798624h12.418974zM177.09292 31.510075l7.183595-1.509576 2.862114 8.800152-10.045709-7.290576z" fill="#FFF"></path>
										</g>
										<g class="dmt-star">
											<path class="dmt-star__canvas" fill="#dcdce6" d="M205.064416 46.330002h46.375587V0h-46.375587z"></path>
											<path class="dmt-star__canvas--half" fill="#dcdce6" d="M205.064416 46.330002h23.187793V0h-23.187793z"></path>
											<path class="dmt-star__shape" d="M244.597022 19.711433l-26.3029 19.089218 3.837419-11.797827-10.047304-7.291391h12.418974l3.837418-11.798624 3.837418 11.798624h12.418975zm-16.255436 11.798642l7.183595-1.509576 2.862114 8.800152-10.045709-7.290576z" fill="#FFF"></path>
										</g>
									</svg>
								</div>
							</div>

							<?php if (!empty($testimonial['review_content'])) : ?>
								<p class="dmt-testimonial__review">
									<?php echo $testimonial['review_content']; ?>
								</p>
							<?php endif; ?>
						</div>
					</div>
					<!-- /.swiper-slide -->
				<?php
				endforeach;
			endif;
			?>
		</div>
	</div>
	<!-- /.dmt-creative-testimonial -->
	</div>
	<!-- /.testimonial-four-top-wrapper -->

	<div class="testimoinal-slider-nav-wrapper">
		<div class="testimoinal-slider-nav">
			<div <?php $this->print_render_attribute_string('wrapper-nav'); ?>>
				<div class="swiper-wrapper">
					<?php if (is_array($testimonials)) :
						foreach ($testimonials as $testimonial) : ?>
							<?php
							if ($testimonial['image'] != '') {
								$avatar = $testimonial['image']['url'];
							}
							?>
							<div class="swiper-slide">
								<div <?php $this->print_render_attribute_string('testimonial'); ?>>
									<?php if (!empty($avatar)): ?>
										<div class="dmt-testimonial__avatar">
											<img class="author-image" src="<?php echo esc_url($avatar) ?>" alt="<?php echo esc_attr($testimonial['name']) ?>">
										</div>
									<?php endif; ?>

									<div class="dmt-testimonial__bio">
										<?php if (!empty($testimonial['name'])) : ?>
											<h4 class="dmt-testimonial__name"><?php echo $testimonial['name']; ?></h4>
										<?php endif; ?>

										<?php if (!empty($testimonial['designation'])) : ?>
											<span class="dmt-testimonial__designation"><?php echo $testimonial['designation']; ?></span>
										<?php endif; ?>
									</div>
								</div>
							</div>
							<!-- /.swiper-slide -->
						<?php
						endforeach;
					endif;
					?>
				</div>
			</div>
			<!-- /.swiper-container testimonial-thumb -->
		</div>
	</div>
	<!-- /.testimoinal-slider-nav-wrapper -->

</div>
<!-- /.gotox-testimonial-wrapper -->
