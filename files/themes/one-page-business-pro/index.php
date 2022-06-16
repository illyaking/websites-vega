<!-- Header Section -->
<?php get_header(); ?>


<?php
if( !get_option('cyberchimps_options') )
{
	$enable_service_section = 1;
	$enable_portfolio_section = 1; 
	$enable_about_section = 1;
	$enable_team_section=1;
	$enable_testimonial_section=1;
	$enable_contact_section=1;
	$contact_address = "Your default address";
	$contact_email = "contact@yourdomain.com";
	$contact_phone = "123-456-789";	
}
else
{
	$res = get_option('cyberchimps_options');
	if (isset($res['services_option'])) 
	{ 
		$enable_service_section = cyberchimps_get_option('services_option');
	}
	else 
	{
		$enable_service_section = 1;
	}
	if (isset($res['portfolio_option'])) 
	{ 
		$enable_portfolio_section = cyberchimps_get_option('portfolio_option');
	}
	else 
	{
		$enable_portfolio_section = 1;
	}
	if (isset($res['about_option'])) 
	{ 
		$enable_about_section=cyberchimps_get_option('about_option');
	}
	else 
	{
		$enable_about_section = 1;
	}
	if (isset($res['team_option'])) 
	{ 
		$enable_team_section=cyberchimps_get_option('team_option');
	}
	else 
	{
		$enable_team_section = 1;
	}
	if (isset($res['testimonial_option'])) 
	{ 
		$enable_testimonial_section=cyberchimps_get_option('testimonial_option');
	}
	else 
	{
		$enable_testimonial_section = 1;
	}
	if (isset($res['contact_option'])) 
	{ 
		$enable_contact_section=cyberchimps_get_option('contact_option');
	}
	else 
	{
		$enable_contact_section = 1;
	}
	$contact_address = (isset($res['contact_address'])) ? cyberchimps_get_option('contact_address') : 'Your default address' ;
	$contact_email = (isset($res['contact_email'])) ? cyberchimps_get_option('contact_email') : 'contact@yourdomain.com' ;
	$contact_phone = (isset($res['contact_phone'])) ? cyberchimps_get_option('contact_phone') : '123-456-789' ;
}





if($enable_about_section)
{

if( !get_option('cyberchimps_options') )
        {
		$about_desc = "Description of your about section";
		$about_side_desc = "Description of your about side section";
	}
	else
	{
		$res = get_option('cyberchimps_options');
		$about_desc = (isset($res['about_desc'])) ? cyberchimps_get_option('about_desc') : "This is about description. This is sample paragraph." ;
		$about_side_desc = (isset($res['about_side_desc'])) ? cyberchimps_get_option('about_side_desc') : "This is about side description. This is a sample paragraph." ;
	}


?>

<!-- About Section -->
<div id="about-section">
  <div class="container">
    <div class="section-title text-center wow fadeInDown">
      <h2><?php 
      if(cyberchimps_get_option('about_title'))
      {
        echo _e(cyberchimps_get_option('about_title'));
      }
      else
        echo _e("About");
      ?></h2>
      <hr>
      <div class="clearfix"></div>
      <p><?php 
      
        echo _e($about_desc);
     
        ?></p>

    </div>
    <div class="row">
      <div class="col-md-6 wow fadeInLeft"> 
      <p><?php 
      
        echo _e($about_side_desc);
      
      ?></p>

       </div>
      <div class="col-md-6 wow fadeInRight">
      
      <img src="
<?php 
      if(cyberchimps_get_option('about_image'))
        echo(cyberchimps_get_option('about_image'));
      else
        echo get_template_directory_uri().'/img/about.png';
     
?>  " class="img-responsive" alt="about">
      </div>
    </div>
  </div>
</div>

<?php } ?>





<!-- Services Section -->
<?php 
    //Inorder to display service section at fresh installation, condition is not checked here.


if($enable_service_section)
{
 echo  one_page_business_pro_services_boxes_render_display();  
}
 ?>

<!-- Portfolio Section -->
<?php 
      //Inorder to display portfolio section at fresh installation, condition is not checked here.
if($enable_portfolio_section)
{
echo  one_page_business_pro_portfolio_render_display();
}
?>



<!-- Team Section -->

<?php
  if($enable_team_section)
{
 echo  one_page_business_pro_team_boxes_render_display();  
}
//Inorder to display team section at fresh installation, condition is not checked here.
?>


<!-- Testimonials Section -->
 
<?php
 if($enable_testimonial_section)
{
 echo  one_page_business_pro_testimonial_boxes_render_display(); 
}
    //Inorder to display testimonial section at fresh installation, condition is not checked here.
 ?>


<?php
 if($enable_contact_section)
{

if( !get_option('cyberchimps_options') )
        {
		$contact_desc = "Description of your contact section";
	}
	else
	{
		$res = get_option('cyberchimps_options');
		$contact_desc = (isset($res['contact_desc'])) ? cyberchimps_get_option('contact_desc') : "Description of your contact information." ;
	}
	
?>
<!-- Contact Section -->

<div id="contact-section" class="text-center">
  <div class="container">
    <div class="section-title wow fadeInDown">
      <h2><?php 
      if(cyberchimps_get_option('contact_title'))
        echo _e(cyberchimps_get_option('contact_title'));
      else 
        echo _e("Contact");
      ?></h2>
      <hr>
      <p><?php 
      
        echo _e($contact_desc);
      
      ?></p>
    </div>
    <div class="col-md-8 col-md-offset-2 wow fadeInUp" data-wow-delay="200ms">
      <div class="col-md-4"> <i class="fa fa-map-marker fa-2x"></i>
        <p><?php 
       
          echo _e($contact_address);
       
      ?></p>
      </div>

      <div class="col-md-4"> <i class="fa fa-envelope-o fa-2x"></i>
        <p><?php 
       
          echo ($contact_email);
        
        ?></p>
      </div>

      <div class="col-md-4"> <i class="fa fa-phone fa-2x"></i>
        <p><?php 
        
          echo($contact_phone);
        
      ?></p>
      </div>
      
      <div class="clearfix"></div>
    </div>
<br>
    <div class="col-md-8 col-md-offset-2 wow fadeInUp" data-wow-delay="400ms">
  <?php echo _e("<h3>Leave us a message</h3>");?>
      <form name="sentMessage" id="contactForm">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" id="name" class="form-control" placeholder="Name" required>
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="email" id="email" class="form-control" placeholder="Email" required="required">
              <p class="help-block text-danger"></p>
            </div>
          </div>
        </div>
        <div class="form-group">
          <textarea name="message" id="message" class="form-control" rows="4" placeholder="Message" required></textarea>
          <p class="help-block text-danger"></p>
        </div>
        <div id="success"></div>
        <button type="submit" id="cont_sub" class="btn btn-default">Send Message</button> 
      </form>
  
   <div class="social">
        <ul>
          <?php if (cyberchimps_get_option('contact_facebook')) {?><li><a href="<?php echo(cyberchimps_get_option('contact_facebook'));?>" target="_blank" ><i class="fa fa-facebook"></i></a></li><?php }?>
          <?php if (cyberchimps_get_option('contact_twitter')) {?><li><a href="<?php echo(cyberchimps_get_option('contact_twitter'));?>" target="_blank" ><i class="fa fa-twitter"></i></a></li><?php }?>
          <?php if(cyberchimps_get_option('contact_dribbble')) {?><li><a href="<?php echo(cyberchimps_get_option('contact_dribbble'));?>" target="_blank" ><i class="fa fa-dribbble"></i></a></li><?php }?>
          <?php if(cyberchimps_get_option('contact_github')) {?><li><a href="<?php echo(cyberchimps_get_option('contact_github'));?>" target="_blank" ><i class="fa fa-github"></i></a></li><?php }?>
          <?php if(cyberchimps_get_option('contact_instagram')) {?><li><a href="<?php echo(cyberchimps_get_option('contact_instagram'));?>" target="_blank" ><i class="fa fa-instagram"></i></a></li><?php }?>
          <?php if(cyberchimps_get_option('contact_linkedin')) {?><li><a href="<?php echo(cyberchimps_get_option('contact_linkedin'));?>" target="_blank" ><i class="fa fa-linkedin"></i></a></li><?php }?>
        </ul>
      </div>
      
    </div>
  </div>
</div>
<?php } ?>



<?php get_footer(); ?>

</body>
</html>
