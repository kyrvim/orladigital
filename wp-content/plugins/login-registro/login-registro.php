<?php
/*
Plugin Name: Jf Login/Registro
Version: 1.0
Author: Junniior Ferreira
*/


function cliente_reg_form( $user_pass, $user_mail, $repeat_user_mail, $first_name, $user_last_name ) {

    echo '
	<section class="box-free">
		<div class="row">
			<section class="col-lg-7 col-md-12 col-sm-12 col-xs-12">
				<div class="box-welcome-free">
					<div class="box-welcome-description">
						<h3>Aproveite a praia sem estress...</h3>
						<p>Com o SUA ORLA você acessa e efetua pedidos em Bares, Quiosques,Restaurantes,Lanchonetes,Farmácias,Conveniências e outros estabelecimentos próximos a você. Através de nossa
		plataforma exclusiva, também é possível visualizar cardápios, efetuar reservas, acompanhar filas de espera e antecipar a forma de pagamento.</p>
						<p>
							Chega de surpresas e aborrecimentos. Evite filas e mal atendimento. Experimente
							O Sua Orla.
						</p>							
					</div>
				</div>	
			</section>

			<section class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
				<div class="box-cadastro-free">
					<section class="cadastro-free">
						<div class="vb-registration-form">

						    <form class="form-horizontal registraion-form free-register-form" action="' . $_SERVER['REQUEST_URI'] . '" method="post">

							 	<div class="row">
								 	<section class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
									    <div class="form-group">
										    <input type="text" name="user_first_name" id="user_first_name" placeholder="Nome" class="form-control cad-free-dual-cols free-reg-name" value="' . ( isset( $_POST['user_first_name'] ) ? $user_first_name : null ) . '" />
																			    	
									    </div>
							 		</section>

								 	<section class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
									    <div class="form-group">
										    <input type="text" name="user_last_name" id="user_last_name" placeholder="Sobrenome" class="form-control cad-free-dual-cols ree-reg-sname" value="' . ( isset( $_POST['user_last_name']) ? $user_last_name : null ) . '" />
																			    	
									    </div>									    
							 		</section>		 		
								</div>    	

								<div class="form-group">
									<input type="email" name="user_mail" id="user_mail" placeholder="Insira seu E-Mail" class="form-control cad-free-dual-cols free-reg-email" value="' . ( isset( $_POST['user_mail']) ? $user_mail : null ) . '" />						    	
								</div>

								<div class="form-group">
									<input type="email" name="repeat_user_mail" id="repeat_user_mail" placeholder="Insira novamente seu E-Mail" class="form-control cad-free-dual-cols free-reg-remail" value="' . ( isset( $_POST['repeat_user_mail']) ? $user_mail : null ) . '"  />						    	
								</div>			    
								 	 
							    <div class="form-group">
							      <input type="password" name="user_pass" id="user_pass" placeholder="Digite sua senha." class="form-control cad-free-dual-cols free-reg-pass" value="' . ( isset( $_POST['user_pass'] ) ? $user_pass : null ) . '" />
							      <span class="help-block">Mínimo de 8 caracteres</span>
							    </div>

							   	<div class="form-group">
									<input type="submit" name="submit" id="free-reg-submit" placeholder="Registrar." class="btn btn-primary btn-register-free" value="Registrar" />
								</div>
							</form>
						</div>
					</section>
				</div>
			</section>	
		</div>
	</section>	

    ';
}

function free_reg_validation( $user_pass, $user_mail, $repeat_user_mail, $user_first_name){

	global $reg_errors;
	$reg_errors = new WP_Error;

	if ( empty( $user_pass ) || empty( $user_mail ) || empty($repeat_user_mail) ) {
    	$reg_errors->add('field', 'Required form field is missing');
	}

	if ( 8 > strlen( $user_pass ) ) {
	    $reg_errors->add( 'password', 'Password length must be greater than 8' );
	}

	if ( !is_email( $user_mail ) ) {
    	$reg_errors->add( 'email_invalid', 'Email is not valid' );
	}

	if ( email_exists( $user_mail ) ) {
    	$reg_errors->add( 'email', 'Email Already in use' );
	}

	if (!$repeat_user_mail==$user_mail) {
		$reg_errors->add( 'email_invalid', 'Os emails precisam ser iguais.' );
	}


	if ( is_wp_error( $reg_errors ) ) {
	 
	    foreach ( $reg_errors->get_error_messages() as $error ) {
	     
	        echo '<div>';
	        echo '<strong>ERROR</strong>:';
	        echo $error . '<br/>';
	        echo '</div>';
	         
	    }
	 
	}

}

function free_reg_registration() {
    global $reg_errors, $user_pass, $user_mail, $user_first_name, $user_last_name;

    if ( 1 > count( $reg_errors->get_error_messages() ) ) {
        $userdata = array(
        'user_login'    =>   $user_mail,
        'user_email'    =>   $user_mail,
        'user_pass'     =>   $user_pass,
        'first_name'    =>   $user_first_name,
        'last_name'     =>   $user_last_name,
        'role'			=>	 'cliente'
        );
        $user = wp_insert_user( $userdata );  
    }

}

function free_registration_function() {
    if ( isset($_POST['submit'] ) ) {
        free_reg_validation(
	        $_POST['user_pass'],
	        $_POST['user_mail'],
	        $_POST['user_first_name'],
	        $_POST['user_last_name']
        );
         
        // sanitize user form input
        global $user_pass, $user_mail, $user_first_name, $user_last_name;
        
        $user_pass   =   esc_attr( $_POST['user_pass'] );
        $user_mail      =   sanitize_email( $_POST['user_mail'] );
        $user_first_name =   sanitize_text_field( $_POST['user_first_name'] );
        $user_last_name  =   sanitize_text_field( $_POST['user_last_name'] );
 
        // call @function free_reg_registration to create the user
        // only when no WP_error is found
        free_reg_registration(
	        $user_pass,
	        $user_mail,
	        $user_first_name,
	        $user_last_name
        );
    }
 
    cliente_reg_form(
        $user_pass,
        $user_mail,
        $repeat_user_mail,
        $user_first_name,
        $user_last_name
    );
}

// Register a new shortcode: [sc_free_register]
add_shortcode( 'sc_free_register', 'free_register' );
 
// The callback function that will replace [book]
function free_register() {
    ob_start();
    free_registration_function();
    return ob_get_clean();
}


function premium_reg_form( $user_pass, $user_mail, $repeat_user_mail, $first_name, $user_last_name ) {

    echo '
    <section class="box-premium">
		<div class="row">
			<section class="col-lg-7 col-md-12 col-sm-12 col-xs-12">
				<div class="box-welcome-premium">
					<div class="box-welcome-description">
						<h3>Aproveite a praia sem estress...</h3>
						<p>Com o SUA ORLA você acessa e efetua pedidos em Bares, Quiosques,Restaurantes,Lanchonetes,Farmácias,Conveniências e outros estabelecimentos próximos a você. Através de nossa
		plataforma exclusiva, também é possível visualizar cardápios, efetuar reservas, acompanhar filas de espera e antecipar a forma de pagamento.</p>
						<p>
							Chega de surpresas e aborrecimentos. Evite filas e mal atendimento. Experimente
							O Sua Orla.
						</p>							
					</div>
				</div>	
			</section>

			<section class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
				<div class="box-cadastro-premium">
					<section class="cadastro-premium">
						<div class="vb-registration-form">

						    <form class="form-horizontal registraion-form premium-register-form" action="' . $_SERVER['REQUEST_URI'] . '" method="post">

							 	<div class="row">
								 	<section class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
									    <div class="form-group">
										    <input type="text" name="user_first_name" id="user_first_name" placeholder="Nome" class="form-control cad-premium-dual-cols premium-reg-name" value="' . ( isset( $_POST['user_first_name'] ) ? $user_first_name : null ) . '" />
																			    	
									    </div>
							 		</section>

								 	<section class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
									    <div class="form-group">
										    <input type="text" name="user_last_name" id="user_last_name" placeholder="Sobrenome" class="form-control cad-premium-dual-cols ree-reg-sname" value="' . ( isset( $_POST['user_last_name']) ? $user_last_name : null ) . '" />
																			    	
									    </div>									    
							 		</section>		 		
								</div>    	

								<div class="form-group">
									<input type="email" name="user_mail" id="user_mail" placeholder="Insira seu E-Mail" class="form-control cad-premium-dual-cols premium-reg-email" value="' . ( isset( $_POST['user_mail']) ? $user_mail : null ) . '" />						    	
								</div>

								<div class="form-group">
									<input type="email" name="repeat_user_mail" id="repeat_user_mail" placeholder="Insira novamente seu E-Mail" class="form-control cad-premium-dual-cols premium-reg-remail" value="' . ( isset( $_POST['repeat_user_mail']) ? $user_mail : null ) . '"  />						    	
								</div>			    
								 	 
							    <div class="form-group">
							      <input type="password" name="user_pass" id="user_pass" placeholder="Digite sua senha." class="form-control cad-premium-dual-cols premium-reg-pass" value="' . ( isset( $_POST['user_pass'] ) ? $user_pass : null ) . '" />
							      <span class="help-block">Mínimo de 8 caracteres</span>
							    </div>

							   	<div class="form-group">
									<input type="submit" name="submit" id="premium-reg-submit" placeholder="Registrar." class="btn btn-primary btn-register-premium" value="Registrar" />
								</div>
							</form>
						</div>
					</section>
				</div>
			</section>	
		</div>
	</section>

    ';
}

function premium_reg_validation( $user_pass, $user_mail, $repeat_user_mail, $user_first_name){

	global $reg_errors;
	$reg_errors = new WP_Error;

	if ( empty( $user_pass ) || empty( $user_mail ) || empty($repeat_user_mail) ) {
    	$reg_errors->add('field', 'Required form field is missing');
	}

	if ( 8 > strlen( $user_pass ) ) {
	    $reg_errors->add( 'password', 'Password length must be greater than 8' );
	}

	if ( !is_email( $user_mail ) ) {
    	$reg_errors->add( 'email_invalid', 'Email is not valid' );
	}

	if ( email_exists( $user_mail ) ) {
    	$reg_errors->add( 'email', 'Email Already in use' );
	}

	if (!$repeat_user_mail==$user_mail) {
		$reg_errors->add( 'email_invalid', 'Os emails precisam ser iguais.' );
	}


	if ( is_wp_error( $reg_errors ) ) {
	 
	    foreach ( $reg_errors->get_error_messages() as $error ) {
	     
	        echo '<div>';
	        echo '<strong>ERROR</strong>:';
	        echo $error . '<br/>';
	        echo '</div>';
	         
	    }
	 
	}

}

function premium_reg_registration() {
    global $reg_errors, $user_pass, $user_mail, $user_first_name, $user_last_name;

    if ( 1 > count( $reg_errors->get_error_messages() ) ) {
        $userdata = array(
        'user_login'    =>   $user_mail,
        'user_email'    =>   $user_mail,
        'user_pass'     =>   $user_pass,
        'first_name'    =>   $user_first_name,
        'last_name'     =>   $user_last_name,
        'role'			=>	 'premium'
        );
        $user = wp_insert_user( $userdata );  
    }

}

function premium_registration_function() {
    if ( isset($_POST['submit'] ) ) {
        premium_reg_validation(
	        $_POST['user_pass'],
	        $_POST['user_mail'],
	        $_POST['user_first_name'],
	        $_POST['user_last_name']
        );
         
        // sanitize user form input
        global $user_pass, $user_mail, $user_first_name, $user_last_name;
        
        $user_pass   =   esc_attr( $_POST['user_pass'] );
        $user_mail      =   sanitize_email( $_POST['user_mail'] );
        $user_first_name =   sanitize_text_field( $_POST['user_first_name'] );
        $user_last_name  =   sanitize_text_field( $_POST['user_last_name'] );
 
        // call @function premium_reg_registration to create the user
        // only when no WP_error is found
        premium_reg_registration(
	        $user_pass,
	        $user_mail,
	        $user_first_name,
	        $user_last_name
        );
    }
 
    premium_reg_form(
        $user_pass,
        $user_mail,
        $repeat_user_mail,
        $user_first_name,
        $user_last_name
    );
}

// Register a new shortcode: [sc_free_register]
add_shortcode( 'sc_premium_register', 'premium_register' );

// The callback function that will replace [book]
function premium_register() {
    ob_start();
    premium_registration_function();
    return ob_get_clean();
}