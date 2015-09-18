<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till #main div
 *
 * @package Odin
 * @since 2.2.0
 */

global $current_user;


?><!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.ico" rel="shortcut icon" />
	<script>  var ajaxurl = '<?php echo admin_url("admin-ajax.php"); ?>';</script>
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/assets/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

	<body 
		<?php 
			$page = get_the_title();

			if ( is_page(array(''.$page.''))) {
				echo ' class="'.$page.'" '; 
			}
		?>
	>

<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
      	
	        <div class="navbar-header">
	        <div class="navbar-brand">
				<?php
					if ( !is_user_logged_in()) : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/dashboard' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php endif;
				?>        	
	        </div>
	        </div>
		        <div id="navbar" class="navbar-collapse collapse">
			        	<?php if (!is_user_logged_in()): ?>
								<ul class="nav navbar-nav navbar-right">
									<!--Login Wordpress-->
									<?php 
										$args = array(
										'echo' => true,
										'redirect' => get_permalink( get_page_by_title( 'dashboard' ) ), 
										'form_id' => 'login-topo',
										'label_username' => NULL,
										'label_password' => NULL,
										'label_log_in' => __( 'Entrar' ),
										'label_remember' => __( 'Mantenha-me Conectado.' ),
										'id_username' => 'usuario-id',
										'id_password' => 'usuario-senha',
										'id_remember' => 'auto-login',
										'id_submit' => 'login-submit',
										'remember' => true,
										'value_username' => NULL,
										'value_remember' => true );

										wp_login_form( $args );
									?>
								</ul>

							<?php else: ?>
								<ul class="nav navbar-nav navbar-right">
									<div class="meu-perfil">
										<span><?php echo $current_user->display_name ?></span>					
									</div>
									<div class="box-settings">
										<span>
											<a href="<?php echo wp_logout_url( home_url() ); ?>">Logout</a>
										</span>
										<span>
											<i class="fa fa-cog"></i>
										</span>
									</div>						
								</ul>
			        	<?php endif ?>
		        </div><!--/.nav-collapse -->


      </div>
    </nav>

	<div id="wrapper" class="container">
		<div class="row">
