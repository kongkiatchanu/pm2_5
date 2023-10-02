<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$version = md5('signoutz_final_bugfix_140720211');
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta http-equiv='content-language' content='th' />
    <meta http-equiv='content-type' content='text/html; charset=UTF-8' />
	
    <title><?=$siteInfo['site_title']?></title>
    <meta name='description' content='<?=$siteInfo['site_des']?>' />
    <meta name='keywords' content='<?=$siteInfo['site_keyword']?>' />

    <meta property="og:url" content="https://pm2_5.nrct.go.th/">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?=$siteInfo['site_title']?>">
    <meta property="og:description" content="<?=$siteInfo['site_des']?>">
    <meta property="og:image" content="<?=base_url()?>template/image/logo-nrct.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?=base_url()?>template/image/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url()?>template/image/favicon-16x16.png">
    <link rel="stylesheet" href="<?=base_url()?>template/css/bootstrap-4.3.1/bootstrap.min.css">
	<link rel="stylesheet" href="<?=base_url()?>template//fontawesome/css/all.min.css?v=<?=$version?>">
    <link rel="stylesheet" href="<?=base_url()?>template/css/style_nrct.min.css?v=<?=$version?>">
    <link rel="stylesheet" href="<?=base_url()?>template/css/custom.css?v=<?=$version?>">
	<script src="<?=base_url()?>template/js/all/compress.min.js"></script>
	<?php $this->load->view('main/analytics');?>
</head>

<body>
    <script>window.oncontextmenu=function(){return!1},document.onkeydown=function(e){return 123!=e.keyCode&&((!e.ctrlKey||!e.shiftKey||e.keyCode!="I".charCodeAt(0))&&((!e.ctrlKey||!e.shiftKey||e.keyCode!="J".charCodeAt(0))&&((!e.ctrlKey||e.keyCode!="U".charCodeAt(0))&&((!e.ctrlKey||!e.shiftKey||e.keyCode!="C".charCodeAt(0))&&void 0))))};</script>
    <div class="warpper">
        <!-- menu (mobile) -->
        <?php $this->load->view('main/template_nav_sidebar');?>
        <div id="content">
            <!-- menu (com) -->
			<?php $this->load->view('main/template_nav_main');?>
            
            <div class="tab-content">
               <?php $this->load->view($view);?>
            </div>
        </div>
    </div>
    <div class="overlay"></div>

    
	<script src="<?=base_url()?>template/plugins/leaflet/leaflet.js?v=<?=$version?>" ></script>
	<script src="<?=base_url()?>template/plugins/esri-leaflet/esri-leaflet.js?v=<?=$version?>"></script>
    <script src="<?=base_url()?>template/js/minify/all.js?v=<?=$version?>"></script>
</body>

</html>