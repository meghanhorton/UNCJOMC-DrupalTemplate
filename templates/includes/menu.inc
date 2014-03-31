<!-- TOP NAVIGATION -->
<nav class="navbar navbar-default navbar-static-top" id="topbar">
  <div class="container">
      <!-- LOGO -->
      <?php if ($logo):?>
      <a class="logo navbar-btn" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>">
      <img src="<?php print $logo; ?>" alt="<?php print $site_name; ?>" />
      </a>
      <?php endif; ?>
      <!-- END LOGO -->
      <!-- TOGGLE WHEN COLLAPSED -->
	<!--
	<button class="navbar-toggle" data-toggle="collapse" data-target="#topnav"><span class="sr-only">Toggle navigation</span><i class="glyphicon glyphicon-chevron-down"></i></button>
	-->
      <!-- TOP NAVIGATION -->
      <div class="collapse navbar-collapse" id="topnav">
        <?php if (!empty($secondary_nav)): ?>
        <?php print render($secondary_nav); ?>
        <?php endif; ?>
      </div>
      <!-- END TOP NAVIGATION -->
  </div>
</nav>

<!-- SECOND NAVIGATION BAR -->
<nav class="navbar navbar-default" id="lowernav">
  <div class="container">
    <button class="navbar-toggle" data-toggle="collapse" data-target="#mainnav"><span class="sr-only">Toggle navigation</span><i class="glyphicon glyphicon-chevron-down"></i></button>

    <div class="collapse navbar-collapse" id="mainnav">
      <div id="searchbar">
        <?php if (!empty($page['search'])): ?>
          <?php print render($page['search']); ?>
        <?php endif; ?>
      </div>

      <?php if (!empty($primary_nav)): ?>
      <?php print render($primary_nav); ?>
      <?php endif; ?>


    </div>
  </div>
</nav>
