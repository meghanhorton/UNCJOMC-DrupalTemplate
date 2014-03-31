<?php
/**
 * @file
 * Default theme implementation to display a single Drupal page.
 */

        // GET VARIABLES
        $user         = user_load(arg(1));
        $uid          = $user->uid;
        $profile      = profile2_load_by_user($uid);
        $profile      = $profile['main'];

        drupal_set_title($user->field_full_name['und']['0']['value']);

        $p['field_cover_position']  = $profile->field_cover_position['und'][0]['value'];

        if(!empty($profile->field_cover_background_color)){     
          $bgcolor    = $profile->field_cover_background_color['und'][0]['value']; }
        else{                           
          $bgcolor = '#87afcc';}
        ?>

<!-- INCLUDE MENU HEADER -->
<?php include_once drupal_get_path('theme','uncjomc'). '/templates/includes/menu.inc';?>
<?php drupal_add_css(drupal_get_path('theme','uncjomc').'/css/people.css');?>

<!-- REQUIRED EXTRA STUFF FOR WHEN LOGGED IN -->
  <?php print $messages; ?>
  <?php if (!empty($tabs)): ?>
    <?php print render($tabs); ?>
  <?php endif; ?>
  <?php if (!empty($action_links)): ?>
    <ul class="action-links"><?php print render($action_links); ?></ul>
  <?php endif; ?>
<!-- END REQUIRED STUFF -->
      
<!-- USER TOP PROFILE -->
<div class="profile"<?php print $attributes; ?>>
  <div class="profile" style="background-color: <?php echo $bgcolor;?>;">
    <div class="container name profile-<?php echo $profile->field_cover_position['und'][0]['value'];?>" style="background-image: url('<?php echo file_create_url($profile->field_featured_image['und'][0]['uri']); ?>')">
    <?php echo views_embed_view('user_profile_name_bar','block',$user->uid);?>
    </div>
  </div>
</div>

<!-- MAIN CONTENT -->
<div class="main-container container" id="main_content">
  <div class="col-md-3 col-sm-3 col-xs-5">
    <ul class="nav" id="sidenav">
	<?php if($profile->field_biography){ echo '<li><a href="#biography">Biography</a></li>';}?>
        <?php if($profile->field_degrees){ echo '<li><a href="#education">Education</a></li>';}?>
        <?php if($profile->field_citations){ echo '<li><a href="#citations">Citations</a></li>';}?>
        <?php if(!empty($result[0])){ echo '<li><a href="#courses">Courses</a></li>';}?>
        
        <?php if(!empty($profile->field_curriculum_vitae) || !empty($profile->field_headshot)):?>
        <li class="title">Download</li>
        <?php endif;?>
        <?php if(!empty($profile->field_curriculum_vitae)): foreach($profile->field_curriculum_vitae['und'] as $o):?>
        <li><a target="_blank" href="<?php echo file_create_url($o['uri']);?>">
            <i class="glyphicon glyphicon-th-list"></i>
            Curriculum Vitae
            </a>
          </li>   
          <?php endforeach; endif;?>

          <?php if($profile->field_link):?>
          <li class="title">Resources</li>
         <!-- TWITTER--> 
    	 <?php if($profile->field_twitter){ 
		foreach($profile->field_twitter['und'] as $tweet):
		echo '<li><a target="_blank" href="http://twitter.com/'.$tweet['value'].'"><i class="fa fa-twitter"></i> '.$tweet['value'].'</a></li>';
		endforeach;
	 }?>
	 <?php 
          if(!empty($profile->field_link)): foreach($profile->field_link['und'] as $o):?>
          <li><a target="_blank" href="<?php echo $o['url'];?>">
          <i class="glyphicon glyphicon-link"></i>
            <?php echo $o['title'];?>
          </a>
          </li>   
          <?php endforeach; endif; endif;?>
      </ul>
  </div>
  <div class="col-md-9 col-sm-9 col-xs-7">
    <div class="row">
      <!-- USE VIEW  -->
      <?php echo views_embed_view('Profile2_Display','block',$user->uid);?>
    </div>
  </div>
</div>

<!-- INCLUDE MENU HEADER -->
<?php include_once drupal_get_path('theme','uncjomc'). '/templates/includes/footer.inc';?>

