<?php get_header(); ?>

<?php if (!is_user_logged_in()) { ?>

<div class="container">
	<section class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<section class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="box-cadastro-content">
				<section class="col-lg-6 col-md-12 col-sm-12 col-xs-12"> 
					<div class="box-cadastro-hl"></div>
				</section>
				<section class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
					<div class="box-cadastro-menu">
						<div class="box-cadastro-menu-premium">
							<span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span>
							<span class="">Novo Quiosque</span>
						</div>							
						<div class="box-cadastro-menu-free">
							<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
							<span class="">Novo Usuário</span>
						</div>												
					</div>
				</section>					
			</div>
		</section>
		<?php free_registration_function(); ?>	
	</section>
</div>

<?php } else { wp_redirect( home_url( '/dashboard' ) ); } ?>

<?php get_footer(); ?>

