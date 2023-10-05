<style>.new-title{height:66px;overflow-y:hidden}.new-detail{height:100px;overflow-y:hidden}.news-contant h4{font-size:18px;font-weight:600;line-height:22px}#news-page-news-feed .news-slice{display:none}#news-page-news-feed .single-news-content{margin-bottom:30px}.single-news-content{border-radius:5px;-webkit-transition:all .3s ease 0s;transition:all .3s ease 0s}.news-thum{background-color:#ddd;background-position:center center;background-repeat:no-repeat;background-size:cover;border-radius:5px 5px 0 0;display:block;height:265px;opacity:.8;-webkit-transition:.3s;transition:.3s}.news-contant{background-color:#f8f8f8;border-radius:0 0 5px 5px;font-size:13px;line-height:1.9em;padding:25px 20px 35px;-webkit-transition:all .3s ease 0s;transition:all .3s ease 0s}.news-contant,.news-contant a,.news-contant h4{text-decoration: none;color:#616161;letter-spacing:.6px;-webkit-transition:.3s;transition:.3s}.new-title{height:66px;overflow-y:hidden}.news-meta{margin:10px 0 8px}.news-meta a{font-size:15px;font-weight:400}.alignright{float:right}</style>
<div class="container">
	<div class="row">
		<div class="col-12">
			<h4 class="text-left" id="news_pagename">รายงานค่าฝุ่นประจำวัน</h4>
			<div class="dropdown mb-3">
                <a class="btn btn-info btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-clock"></i> เลือกเวลา
                </a>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <?php for($i = 0;$i <= date('H');$i++){ if(date('i')>=1)?>
                        <a class="dropdown-item" style="font-size: 14px" href="<?=base_url('dailyreport/'.$i)?>" target='_blank'><i class="fas fa-download"></i> เวลา <?=$i?>:00 น.</a>
                    <?php }?>
                </div>
            </div>
			<h4 class="text-left" id="news_pagename">ข่าวสารประชาสัมพันธ์</h4>
			<div class="row" id="news-page-news-feed"> 
			<?php foreach($rsList as $item){?>
				<div class="col-lg-4 col-md-6 news-slice">
                    <div class="single-news-content">
                        <a href="<?=base_url('newsdetail/'.$item->idcontent)?>" class="news-thum news-thumbg-1" style="background-image: url(<?=base_url()?>uploads/timthumb.php?src=<?=base_url()?>uploads/images/<?=$item->content_thumbnail?>&w=740&h=530);"></a>
                        <div class="news-contant">
							<div class="new-title">
								<h4><a href="<?=base_url('newsdetail/'.$item->idcontent)?>"><?=$item->content_title?></a></h4>
							</div>
                            <p class="news-meta">
                                <a href="<?=base_url('newsdetail/'.$item->idcontent)?>"><i class="fa fa-calendar"></i> <?=ConvertToThaiDate($item->content_public,1)?></a>
                                <a href="<?=base_url('newsdetail/'.$item->idcontent)?>" style="float: right;" class="alignright rd-btn">อ่านเพิ่ม <i class="fas fa-arrow-right"></i></a>
                            </p>
                        </div>
                    </div>
                </div>
			<?php }?>
			</div>
		</div>
	</div>
	<div class="row mb-5">
		<div class="col-md-12 text-center">
			<a href="#" class="news-see-more-btn btn btn-info"><i class="fas fa-sync"></i> ดูเพิ่มเติม</a>
		</div>
	</div>
</div>
	



