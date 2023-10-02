<div id="ccdc-app-navbar">
                <nav class="navbar navbar-expand-lg bg-white">
                    <div class="container-fluid">
                        <button class="btn btn-link btn-menu d-lg-none"> <!-- d-lg-none -->
                            <img alt="image" src="<?=base_url()?>template/image/icon-menu.svg" width="23" height="15">
                        </button>
                        <a class="navbar-brand d-flex  flex-fill justify-content-center mr-0  router-link-exact-active router-link-active"
                            href="">
                            <img alt="image" src="<?=base_url()?>template/image/logo-nrct.svg" width="88" height="78">
                        </a>
                        <button class="btn btn-link btn-menu">
                            <img alt="image" src="<?=base_url()?>template/image/icon-search.svg" width="23" height="23"
                                style="display: none;">
                        </button>
                    </div>
                </nav>
                <nav class="navbar navbar-expand-lg bg-white">
                    <div class="collapse navbar-collapse justify-content-center" id="menu-main">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <div class="sidebar-lang">
                                    <div class="sidebar-lang-item">
                                        <img alt="image" src="<?=base_url()?>template/image/icon-translate.svg" width="20" height="20">
                                        <span>
                                    </div>
                                    <div class="sidebar-lang-item">
                                        <div class="choose-lang choose-lang-active" data-lang="th"> ไทย </div>
                                    </div>
                                    <div class="sidebar-lang-item">
                                        <div class="choose-lang choose-lang-inactive" data-lang="en"> ENG </div>
                                    </div>
                                </div>
                            </li>
							
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="menu_1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img alt="menu-icon" src="<?=base_url()?>template/image/icon-index.svg" width="16" height="16">
                                    <span class="menu-title" menu-th='หน้าหลัก' menu-en='Home'>หน้าหลัก</span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="menu_1">
									<a class="dropdown-item <?=$this->input->get('source')=="All"?'active':''?>" href="<?=base_url()?>">
                                        <span class="menu-title" menu-th='All' menu-en='All'>All</span>
                                    </a>
                                   
                                    
                                    <a class="dropdown-item <?=$this->input->get('source')=="AeroSURE"?'active':''?>" href="<?=base_url('?source=AeroSURE')?>">
                                        <span class="menu-title" menu-th='AeroSURE' menu-en='AeroSURE'>AeroSURE</span>
                                    </a>
									<a class="dropdown-item <?=$this->input->get('source')=="Air4Thai"?'active':''?>" href="<?=base_url('?source=Air4Thai')?>">
                                        <span class="menu-title" menu-th='Air4Thai' menu-en='Air4Thai'>Air4Thai</span>
                                    </a>
                                    <a class="dropdown-item <?=$this->input->get('source')=="AirEnvir"?'active':''?>" href="<?=base_url('?source=AirEnvir')?>">
                                        <span class="menu-title" menu-th='AirEnvir' menu-en='AirEnvir'>AirEnvir</span>
                                    </a>
									<a class="dropdown-item <?=$this->input->get('CUSense')=="CUSense"?'active':''?>" href="<?=base_url('?source=CUSense')?>">
                                        <span class="menu-title" menu-th='CUSense' menu-en='CUSense'>CUSense</span>
                                    </a>
									<a class="dropdown-item <?=$this->input->get('source')=="DustBoy"?'active':''?>" href="<?=base_url('?source=DustBoy')?>">
                                        <span class="menu-title" menu-th='DustBoy' menu-en='DustBoy'>DustBoy</span>
                                    </a>
									<a class="dropdown-item <?=$this->input->get('source')=="NT"?'active':''?>" href="<?=base_url('?source=NT')?>">
                                        <span class="menu-title" menu-th='NT' menu-en='NT'>NT</span>
                                    </a>
									<a class="dropdown-item <?=$this->input->get('source')=="NTAQHI"?'active':''?>" href="<?=base_url('?source=NTAQHI')?>">
                                        <span class="menu-title" menu-th='NTAQHI' menu-en='NTAQHI'>NTAQHI</span>
                                    </a>
									
									<a class="dropdown-item <?=$this->input->get('Sensor4All')=="Sensor4All"?'active':''?>" href="<?=base_url('?source=Sensor4All')?>">
                                        <span class="menu-title" menu-th='Sensor4All' menu-en='Sensor4All'>Sensor4All</span>
                                    </a>
									<a class="dropdown-item <?=$this->input->get('source')=="Yakkaw"?'active':''?>" href="<?=base_url('?source=Yakkaw')?>">
                                        <span class="menu-title" menu-th='Yakkaw' menu-en='Yakkaw'>Yakkaw</span>
                                    </a>
									
                                   
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?=base_url('pmhours')?>">
                                    <img alt="menu-icon" src="<?=base_url()?>template/image/icon-pin-green.svg" width="16" height="16">
                                    <span class="menu-title" menu-th='PM<sub>2.5</sub> ตามพิกัด' menu-en='PM<sub>2.5</sub> Nearby'>PM<sub>2.5</sub> ตามพิกัด</span>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="menu_2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img alt="menu-icon" src="<?=base_url()?>template/image/icon_weather.svg" width="16" height="16">
                                    <span class="menu-title" menu-th='ค่าพยากรณ์ PM<sub>2.5</sub>' menu-en='Forecast PM<sub>2.5</sub>'>ค่าพยากรณ์ PM<sub>2.5</sub></span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="menu_2">
                                    <a class="dropdown-item <?=$this->input->get('region')==null?'active':''?>" href="<?=base_url('prophecy')?>">
                                        <span class="menu-title" menu-th='ทั้งหมด' menu-en='All'>ทั้งหมด</span>
                                    </a>
                                    <a class="dropdown-item <?=$this->input->get('region')=="central"?'active':''?>" href="<?=base_url('prophecy?region=central')?>">
                                        <span class="menu-title" menu-th='ภาคกลาง' menu-en='Central'>ภาคกลาง</span>
                                    </a>
                                    <a class="dropdown-item <?=$this->input->get('region')=="north"?'active':''?>" href="<?=base_url('prophecy?region=north')?>">
                                        <span class="menu-title" menu-th='ภาคเหนือ' menu-en='North'>ภาคเหนือ</span>
                                    </a>
                                    <a class="dropdown-item <?=$this->input->get('region')=="northeast"?'active':''?>" href="<?=base_url('prophecy?region=northeast')?>">
                                        <span class="menu-title" menu-th='ภาคตะวันออกเฉียงเหนือ' menu-en='NorthEast'>ภาคตะวันออกเฉียงเหนือ</span>
                                    </a>
                                    <a class="dropdown-item <?=$this->input->get('region')=="eastern"?'active':''?>" href="<?=base_url('prophecy?region=eastern')?>">
                                        <span class="menu-title" menu-th='ภาคตะวันออก' menu-en='Eastern'>ภาคตะวันออก</span>
                                    </a>
                                    <a class="dropdown-item <?=$this->input->get('region')=="western"?'active':''?>" href="<?=base_url('prophecy?region=western')?>">
                                        <span class="menu-title" menu-th='ภาคตะวันตก' menu-en='Western'>ภาคตะวันตก</span>
                                    </a>
                                    <a class="dropdown-item <?=$this->input->get('region')=="south"?'active':''?>" href="<?=base_url('prophecy?region=south')?>">
                                        <span class="menu-title" menu-th='ภาคใต้' menu-en='South'>ภาคใต้</span>
                                    </a>
									<a class="dropdown-item <?=$this->input->get('region')=="other"?'active':''?>" href="<?=base_url('prophecy?region=other')?>">
                                        <span class="menu-title" menu-th='ภาคใต้' menu-en='other'>อื่นๆ</span>
                                    </a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="menu_3" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img alt="menu-icon" src="<?=base_url()?>template/image/icon-time.svg" width="16" height="16">
                                    <span class="menu-title" menu-th='ค่าฝุ่นรายชั่วโมง' menu-en='Hourly'>ค่าฝุ่นรายชั่วโมง</span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="menu_2">
                                    <a class="dropdown-item <?=$this->input->get('region')==null?'active':''?>" href="<?=base_url('rank-hours')?>">
                                        <span class="menu-title" menu-th='ทั้งหมด' menu-en='All'>ทั้งหมด</span>
                                    </a>
                                    <a class="dropdown-item <?=$this->input->get('region')=="central"?'active':''?>" href="<?=base_url('rank-hours?region=central')?>">
                                        <span class="menu-title" menu-th='ภาคกลาง' menu-en='Central'>ภาคกลาง</span>
                                    </a>
                                    <a class="dropdown-item <?=$this->input->get('region')=="north"?'active':''?>" href="<?=base_url('rank-hours?region=north')?>">
                                        <span class="menu-title" menu-th='ภาคเหนือ' menu-en='North'>ภาคเหนือ</span>
                                    </a>
                                    <a class="dropdown-item <?=$this->input->get('region')=="northeast"?'active':''?>" href="<?=base_url('rank-hours?region=northeast')?>">
                                        <span class="menu-title" menu-th='ภาคตะวันออกเฉียงเหนือ' menu-en='NorthEast'>ภาคตะวันออกเฉียงเหนือ</span>
                                    </a>
                                    <a class="dropdown-item <?=$this->input->get('region')=="eastern"?'active':''?>" href="<?=base_url('rank-hours?region=eastern')?>">
                                        <span class="menu-title" menu-th='ภาคตะวันออก' menu-en='Eastern'>ภาคตะวันออก</span>
                                    </a>
                                    <a class="dropdown-item <?=$this->input->get('region')=="western"?'active':''?>" href="<?=base_url('rank-hours?region=western')?>">
                                        <span class="menu-title" menu-th='ภาคตะวันตก' menu-en='Western'>ภาคตะวันตก</span>
                                    </a>
                                    <a class="dropdown-item <?=$this->input->get('region')=="south"?'active':''?>" href="<?=base_url('rank-hours?region=south')?>">
                                        <span class="menu-title" menu-th='ภาคใต้' menu-en='South'>ภาคใต้</span>
                                    </a>
									
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="menu_4" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img alt="menu-icon" src="<?=base_url()?>template/image/icon-calendar.svg" width="16" height="16">
                                    <span class="menu-title" menu-th='ค่าฝุ่นรายวัน' menu-en='Daily'>ค่าฝุ่นรายวัน</span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="menu_2">
                                    <a class="dropdown-item <?=$this->input->get('region')==null?'active':''?>" href="<?=base_url('rank-dailys')?>">
                                        <span class="menu-title" menu-th='ทั้งหมด' menu-en='All'>ทั้งหมด</span>
                                    </a>
                                    <a class="dropdown-item <?=$this->input->get('region')=="central"?'active':''?>" href="<?=base_url('rank-dailys?region=central')?>">
                                        <span class="menu-title" menu-th='ภาคกลาง' menu-en='Central'>ภาคกลาง</span>
                                    </a>
                                    <a class="dropdown-item <?=$this->input->get('region')=="north"?'active':''?>" href="<?=base_url('rank-dailys?region=north')?>">
                                        <span class="menu-title" menu-th='ภาคเหนือ' menu-en='North'>ภาคเหนือ</span>
                                    </a>
                                    <a class="dropdown-item <?=$this->input->get('region')=="northeast"?'active':''?>" href="<?=base_url('rank-dailys?region=northeast')?>">
                                        <span class="menu-title" menu-th='ภาคตะวันออกเฉียงเหนือ' menu-en='NorthEast'>ภาคตะวันออกเฉียงเหนือ</span>
                                    </a>
                                    <a class="dropdown-item <?=$this->input->get('region')=="eastern"?'active':''?>" href="<?=base_url('rank-dailys?region=eastern')?>">
                                        <span class="menu-title" menu-th='ภาคตะวันออก' menu-en='Eastern'>ภาคตะวันออก</span>
                                    </a>
                                    <a class="dropdown-item <?=$this->input->get('region')=="western"?'active':''?>" href="<?=base_url('rank-dailys?region=western')?>">
                                        <span class="menu-title" menu-th='ภาคตะวันตก' menu-en='Western'>ภาคตะวันตก</span>
                                    </a>
                                    <a class="dropdown-item <?=$this->input->get('region')=="south"?'active':''?>" href="<?=base_url('rank-dailys?region=south')?>">
                                        <span class="menu-title" menu-th='ภาคใต้' menu-en='South'>ภาคใต้</span>
                                    </a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?=base_url('snapshot')?>">
                                    <img alt="menu-icon" src="<?=base_url()?>template/image/icon-camera-green.svg" width="16" height="16">
                                    <span class="menu-title" menu-th='ภาพถ่าย' menu-en='Snapshot'>Snapshot</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?=base_url('hotspot')?>">
                                    <img alt="menu-icon" src="<?=base_url()?>template/image/icon-pin.svg" width="16" height="16">
                                    <span class="menu-title" menu-th='จุดความร้อน' menu-en='HotSpot'>จุดความร้อน</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?=base_url('news')?>">
                                    <img alt="menu-icon" src="<?=base_url()?>template/image/icon_announcement.svg" width="16" height="16">
                                    <span class="menu-title" menu-th='ข่าวสาร' menu-en='News'>ข่าวสาร</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?=base_url('contactus')?>">
                                    <img alt="menu-icon" src="<?=base_url()?>template/image/icon-contact-green.svg" width="16" height="16">
                                    <span class="menu-title" menu-th='ติดต่อเรา' menu-en='Contact Us'>ติดต่อเรา</span>
                                </a>
                            </li>
							<li class="nav-item">
                                <a class="nav-link" href="<?=base_url('definition')?>">
                                    <div><img alt="menu-icon" src="<?=base_url()?>template/image/info.svg" width="16" height="16"></div>
                                </a>
                            </li>
							
                        </ul>
                    </div>
                </nav>
                <ul id="pills-tab" role="tablist" class="nav nav-pills">
                    <li class="nav-item">
                        <div role="tab" class="nav-link active" dformat="th"> TH </div>
                    </li>
                    <li class="nav-item">
                        <div role="tab" class="nav-link" dformat="us"> US </div>
                    </li>
                </ul>
				<ul id="pills-tab2" role="tablist" class="nav nav-pills">
                    <li class="nav-item">
                        <div role="tab" class="nav-link active" dformat="MODIS"> MODIS </div>
                    </li>
                    <li class="nav-item">
                        <div role="tab" class="nav-link" dformat="VIIRS"> VIIRS </div>
                    </li>
                </ul>
            </div>