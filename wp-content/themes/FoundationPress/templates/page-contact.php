<?php

/*
Template Name: Contact

*/
//response generation function
$response = "";

//function to generate response
function my_contact_form_generate_response($type, $message){

  global $response;

  if($type == "success") $response = "<div class='success'>{$message}</div>";
  else $response = "<div class='error'>{$message}</div>";

}

//response messages
$not_human       = "Human verification incorrect.";
$missing_content = "Please supply all information.";
$email_invalid   = "Email Address Invalid.";
$message_unsent  = "Message was not sent. Try Again.";
$message_sent    = "Thanks! Your message has been sent.";

//user posted variables
$name = $_POST['message_name'];
$email = $_POST['message_email'];
$message = $_POST['message_text'];
$human = $_POST['message_human'];

//php mailer variables
$to = $_POST['message_select'];
$subject = "Someone sent a message from ".get_bloginfo('name');
$headers = 'From: '. $email . "\r\n" .
  'Reply-To: ' . $email . "\r\n";

if(!$human == 0){

	if($human != 2) my_contact_form_generate_response("error", $not_human); //not human!
	else {
		//validate email
		if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		  my_contact_form_generate_response("error", $email_invalid);
		else //email is valid
		{
		  //validate presence of name and message
		  if(empty($name) || empty($message)){
			my_contact_form_generate_response("error", $missing_content);
		  }
		  else //ready to go!
		  {
			$sent = wp_mail($to, $subject, strip_tags($message), $headers);
			if($sent) my_contact_form_generate_response("success", $message_sent); //message sent!
			else my_contact_form_generate_response("error", $message_unsent); //message wasn't sent
		  }
		}
	}
}

else if ($_POST['submitted']) my_contact_form_generate_response("error", $missing_content);


get_header(); ?>

<?php get_template_part( 'parts/featured-image' ); ?>

<div id="page" role="main">
	<?php do_action( 'foundationpress_before_content' ); ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<div class="small-12 medium-6 medium-push-6 large-8 large-push-4 columns no-padding ">
				<article <?php post_class('main-content') ?> id="post-<?php the_ID(); ?>">
					<h1><?php the_title(); ?></h1>
					<?php

						do_action( 'foundationpress_page_before_entry_content' );
						$pagename = $post->post_name;
					?>

					<div class="entry-content">
						<?php the_content(); ?>

						<div id="respond">

						  <?php echo $response; ?>

							<div class="row">

							  	<!-- small-12 columns -->
							  	<form id="contact-form" class="contact-form js-contact-form" <?php the_permalink(); ?>" method="post">

							  		<!-- small-12 columns -->
							  		<div>
						  				<div class="input-container js-input-container">
								  			<label for="message_select" class="message_select-label js-message_select-label">
									  			<select name="message_select" class="message_select-select js-message_select-select">
									  				<?php get_template_part('parts/options'); ?>
									  			</select>
									  		</label>
									  		<span class="message_select_email js-message_select_emal">
									  			@ChattanoogaRollerGirls.com
									  		</span>
								  		</div>
							  		</div>

									<div class="form-hide js-form-hide">
								  		<!-- small-12 columns -->
								  		<div>
							  				<div class="input-container js-input-container">
									  			<label for="name" class="name js-name">
										  				<input id="name" type="text" name="message_name" placeholder="Name" value="<?php echo esc_attr($_POST['message_name']); ?>">
									  			</label>
									  			<div class="warning warning-success js-warning-success"><i class="fa fa-check" aria-hidden="true"></i></div>
									  			<div class="warning warning-error js-warning-error"><i class="fa fa-times" aria-hidden="true"></i></div>
							  				</div>
								  		</div>

								  		<!-- small-12 columns -->
								  		<div>
							  				<div class="input-container js-input-container">
												<label for="message_email" class="message_email js-message_email">
													<input id="message_email" type="text" name="message_email" placeholder="Email" value="<?php echo esc_attr($_POST['message_email']); ?>">
												</label>
								  				<div class="warning warning-success js-warning-success"><i class="fa fa-check" aria-hidden="true"></i></div>
								  				<div class="warning warning-error js-warning-error"><i class="fa fa-times" aria-hidden="true"></i></div>
											</div>
										</div>

										<!-- small-12 columns -->
								  		<div>
							  				<div class="textarea input-container js-input-container">
												<label for="message_text" class="message_text js-message-text">
													<textarea id="message_text" type="text" name="message_text" placeholder="Please type a message"><?php echo esc_textarea($_POST['message_text']); ?></textarea>
												</label>
												<div class="warning warning-success js-warning-success"><i class="fa fa-check" aria-hidden="true"></i></div>
												<div class="warning warning-error js-warning-error"><i class="fa fa-times" aria-hidden="true"></i></div>
							  				</div>
										</div>

										<!-- small-8 columns -->
								  		<div class="human js-human">
								  			<p class="human-text">
								  				Are you a Human? Oh yeah? Then solve this:
								  				<button class="button" style="pointer-events:none;">3+5=X</button>
								  			</p>

											<label for="message_human" class="message_human js-message_human">
												<input id="message_human" type="text" placeholder="X" name="message_human">
											</label>
										</div>

										<!-- small-4 columns -->
								  		<div class="submit-container">
											<input type="hidden" name="submitted" value="1" class="hidden js-hidden">
											<button class="button submit js-submit" type="submit">Submit</button>
										</div>

									</div><!-- form-hide -->

								</form>
							</div> <!-- row -->
						</div><!-- respond -->
					</div> <!-- entry content -->

					<footer>
						<?php wp_link_pages( array('before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'foundationpress' ), 'after' => '</p></nav>' ) ); ?>
						<p><?php the_tags(); ?></p>
					</footer>

					<?php do_action( 'foundationpress_page_before_comments' ); ?>
					<?php comments_template(); ?>
					<?php do_action( 'foundationpress_page_after_comments' ); ?>

				</article>
			</div>
			<div class="small-12 medium-6 medium-pull-6 large-4 large-pull-8 columns no-padding js-sidebar">
				<?php get_sidebar(); ?>
			</div>
		<?php endwhile;?>
	<?php do_action( 'foundationpress_after_content' ); ?>
</div>

<?php get_footer(); ?>