<!DOCTYPE html>
<html>

<head>
	<title>Social Fire</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="Avishek Bhatia">
	
	<!-- Style -->
	<style type="text/css">
      /* Sticky footer styles
      -------------------------------------------------- */

      html,
      body {
        height: 100%;
        /* The html and body elements cannot have any padding or margin. */
      }

      /* Wrapper for page content to push down footer */
      #wrap {
        min-height: 100%;
        height: auto !important;
        height: 100%;
        /* Negative indent footer by it's height */
        margin: 0 auto -60px;
      }

      /* Set the fixed height of the footer here */
      #push,
      #footer {
        height: 60px;
      }
      #footer {
        background-color: #f5f5f5;
      }

      /* Lastly, apply responsive CSS fixes as necessary */
      @media (max-width: 767px) {
        #footer {
          margin-left: -20px;
          margin-right: -20px;
          padding-left: 20px;
          padding-right: 20px;
        }
      }



      /* Custom page CSS
      -------------------------------------------------- */
      /* Not required for template or sticky footer method. */

      #wrap > .container {
        padding-top: 60px;
      }

      #wrap > .container-fluid {
        padding-top: 60px;
      }

      .container .credit {
        margin: 20px 0;
      }

      code {
        font-size: 80%;
      }
    </style>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" media="screen">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap-responsive.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/custom.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/datepicker.css'); ?>">
	<script src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
</head>
<body>

	<!-- Wrap Begin -->
	<div id="wrap">

	<!-- Navigation Bar -->
	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="brand" href="<?php echo site_url("home"); ?>">Social Fire</a>
				
				<div class="btn-group pull-right">
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="icon-user"></i>
						<?php echo $name; ?>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo site_url("profile"); ?>">Profile</a></li>
						<li class="divider"></li>
						<li><a href="<?php echo site_url("home/logout"); ?>">Logout</a></li>
					</ul>
				</div>

				<ul class="nav">
					<li>
						<a href="<?php echo site_url('home'); ?>">
							<i class="icon-globe icon-white"></i>
							Home
						</a>
					</li>
					<li>
						<a href="<?php echo site_url('message'); ?>">
							<i class="icon-envelope icon-white"></i>
							Messages
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- End Navigation Bar -->

	<!-- Main Body -->
	<div class="container-fluid">
		<div class="row-fluid">
		
		<!-- Sidebar Content -->
		<div class="span2">
			<div class="well sidebar-nav sidebar-nav-fixed">
				<ul class="nav nav-list">
					<li class="nav-header">Favorites</li>
					<li>
						<a href="<?php echo site_url('home'); ?>">
							<i class="icon-globe"></i>
							Home
						</a>
					</li>
					<li>
						<a href="<?php echo site_url('project'); ?>">
							<i class="icon-th"></i>
							Projects
						</a>
					</li>
					<li>
						<a href="<?php echo site_url("friend"); ?>">
							<i class="icon-heart"></i>
							Friends
						</a>
					</li>

					<li class="divider"></li>
					<li class="nav-header">Personal</li>
					<li>
						<a href="<?php echo site_url("profile"); ?>">
							<i class="icon-user"></i>
							Profile
						</a>
					</li>
					<li>
						<a href="<?php echo site_url('message'); ?>">
							<i class="icon-envelope"></i>
							Messages
						</a>
					</li>

					<li class="divider"></li>
					<li>
						<a href="<?php echo site_url("home/logout"); ?>">
							<i class="icon-off"></i>
							Logout
						</a>
					</li>
				</ul>
			</div>
		</div>
		<!-- End Sidebar Content -->

		<!-- Main Detailed -->
		<div class="span10">