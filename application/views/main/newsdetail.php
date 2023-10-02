<style>.new-title{height:66px;overflow-y:hidden}.new-detail{height:100px;overflow-y:hidden}.news-contant h4{font-size:18px;font-weight:600;line-height:22px}#news-page-news-feed .news-slice{display:none}#news-page-news-feed .single-news-content{margin-bottom:30px}.single-news-content{border-radius:5px;-webkit-transition:all .3s ease 0s;transition:all .3s ease 0s}.news-thum{background-color:#ddd;background-position:center center;background-repeat:no-repeat;background-size:cover;border-radius:5px 5px 0 0;display:block;height:265px;opacity:.8;-webkit-transition:.3s;transition:.3s}.news-contant{background-color:#f8f8f8;border-radius:0 0 5px 5px;font-size:13px;line-height:1.9em;padding:25px 20px 35px;-webkit-transition:all .3s ease 0s;transition:all .3s ease 0s}.news-contant,.news-contant a,.news-contant h4{text-decoration: none;color:#616161;letter-spacing:.6px;-webkit-transition:.3s;transition:.3s}.new-title{height:66px;overflow-y:hidden}.news-meta{margin:10px 0 8px}.news-meta a{font-size:15px;font-weight:400}.alignright{float:right}</style>
<div class="container">
	<div class="row">
		<div class="col-12">
			<h4 class="text-center" id="news_pagename"><?=$rs[0]->content_title?></h4>
			<div class="content_detail">
				<p><?=$rs[0]->content_full_description?></p>
				<p>เผยแพร่เมื่อ : <?=ConvertToThaiDate($rs[0]->content_public,0)?></p>
			</div>
		</div>
	</div>

</div>
	



