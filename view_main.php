<?php $this->load->view('responsive/common/view_header');?>

<!-- Top block -->
<div class="top-block">

	<?php $this->load->view('responsive/common/view_navbar'); ?>

	<div class="container pt-resp-100">
		<h1 class="text-branding">
		<?php 
			$k="";
			if (!empty($seo_data['aparts'])){ 
			$k = $seo_data['aparts'][0];
			$k = $k['city_id'];
			echo $this->lang->line('L_BLOCK_SLIDE_PROVIDE_YOUR_REQUIREMENTS_CITY').$cities[$k]['city_name_in'];
		} else {  
			echo $this->lang->line('L_BLOCK_SLIDE_PROVIDE_YOUR_REQUIREMENTS'); 
		}; ?>
		</h1>
		<p class="sub_title"><?php echo $this->lang->line('L_BLOCK_SLIDE_SUB_TITLE'); ?></p>
	</div>
		<div id="searchbar" class="searchbar <?php if ($this->user->is_logged()) { echo "user-logged"; }?>">
			<div class="searchbar-inner">
				<!-- Searchbar form -->
				<form action="/apartment" method="get" v-on="submit:submit">
				<!--<?php if (!empty($seo_data['aparts'])) { ?>
					<style>
						.dont_show_city{
							position:absolute; 
							z-index:-9999; 
							opacity:0;
						}

					@media (min-width: 768px){
						.col-sb-el, .col-sb-btn{
							width: 20%;
						}
					}	
					</style>
				<?php } ?> -->
					<!-- City -->
					 <div class="col-sb-el col-xs-12 dont_show_city">
					<div class="form-group" id="destination">
						<?php $lang = get_lang(); ?>
						<?php if($lang == 'en'){ ?>
							<span class="form-icon icon-city"></span>
						<?php } else { ?>
							<style>
								.destination-select {
									padding-right: 0 !important;
								}
							</style>
						<?php } ?>
						<select class="form-control destination-select"
										name="city" 
										v-model="form.destination" 
										v-on="focus: fieldFocus">
							<option value="" disabled selected style="display: none;"><?=$this->lang->line('L_GEN_DESTINATION_CITY');?></option>
							<?php foreach ($cities as $v) { ?>
								<option value="<?=$v['city_id']?>" <? if (!empty($seo_data) && $seo_data['city_id'] == $v['city_id']) { ?>selected<? } ?>>
									<?=$v['city_name']?>
								</option>
							<?php } ?>
						</select>
						<div class="popover bottom" style="top: 50px; display: none; opacity: 0;">
							<div class="arrow"></div>
							<div class="popover-content"><?php echo $this->lang->line('L_GEN_PLEASE_SPECIFY_CITY'); ?></div>
						</div>
						<div class="error_value_field" id="search-popover-destination"></div>
					</div>
					</div> 

					<!-- Check-in -->
					<div class="col-sb-el col-sb-date-in col-xs-6">
					<div class="form-group" id="checkIn">
						<span class="form-icon icon-calendar-in"></span>
						<input type="text" class="form-control datepick"
									 name="date-in"
									 placeholder="<?php echo $this->lang->line('L_GEN_CHECK_IN'); ?>"
									 v-model="form.checkIn"
									 v-on="focus: fieldFocus">
						<div class="popover bottom" style="top: 50px; display: none; opacity: 0;">
							<div class="arrow"></div>
							<div class="popover-content">Please specify check-in date</div>
						</div>
						<div class="error_value_field" id="search-popover-checkIn"></div>
					</div>
					</div>

					<!-- Check-out -->
					<div class="col-sb-el col-sb-date-out col-xs-6">
					<div class="form-group" id="checkOut">
						<span class="form-icon icon-calendar-out"></span>
						<input type="text" class="form-control datepick"
									 name="date-out"
									 placeholder="<?php echo $this->lang->line('L_GEN_CHECK_OUT'); ?>"
									 v-model="form.checkOut"
									 v-on="focus: fieldFocus">
						<div class="popover bottom" style="top: 50px; display: none; opacity: 0;">
							<div class="arrow"></div>
							<div class="popover-content">Please specify check-out date</div>
						</div>
						<div class="error_value_field" id="search-popover-checkOut"></div>
					</div>
					</div>

					<!-- Guests -->
					<div class="col-sb-el col-xs-12">
					<div class="form-group" id="guests">
						<span class="form-icon icon-guests"></span>
						<select class="form-control"
										name="guest"
										data-searchbar-select="guests-select"
										v-model="form.guests"
										v-on="focus: fieldFocus">
							<option value="" disabled selected style="display: none"><?php echo $this->lang->line('L_GEN_GUESTS'); ?></option>
							<?php foreach($guests as $guest) { ?>
								<option value="<?php echo $guest['value']; ?>"><?php echo $guest['title']; ?></option>
							<?php } ?>
						</select>
						<div class="popover bottom" style="top: 50px; display: none; opacity: 0;">
							<div class="arrow"></div>
							<div class="popover-content"><?php echo $this->lang->line('L_GEN_PLEASE_SPECIFY_GUESTS'); ?></div>
						</div>
						<div class="error_value_field" id="search-popover-guests"></div>
					</div>
					</div>

					<!-- Email -->
					<div class="col-sb-el col-sb-email col-xs-12">
					<div class="form-group" id="email">
						<span class="form-icon icon-email"></span>
						<input type="text" class="form-control"
									 name="email"
									 <?php if ($this->user->is_logged()) { ?>
									 value="<?php echo $this->user->get_email(); ?>"
									 <?php } ?>
									 placeholder="<?php echo $this->lang->line('L_GEN_YOUR_EMAIL'); ?>"
									 maxlength="50"
									 v-model="form.email"
									 v-on="focus: fieldFocus">
						<div class="popover bottom" style="top: 50px; display: none; opacity: 0;">
							<div class="arrow"></div>
							<div class="popover-content"><?php echo $this->lang->line('L_GEN_PLEASE_SPECIFY_YOUR_EMAIL'); ?></div>
						</div>
						<div class="error_value_field" id="search-popover-email"></div>
					</div>
					</div>

					 <!-- <div class="col-sb-btn col-xs-12">
					<div class="form-group">
						<button type="button" class="btn btn-flat btn-primary call_tel_form">
							<div class="form-icon icon-search"></div>
							<span><?php echo $this->lang->line('L_GEN_BTN_SEARCH'); ?></span>
						</button>
					</div>
					</div> --> 
					
					<!-- Phone -->
					<!-- <div class="popup_tel_bg"></div>
					<div class="popup_tel">
						 <div class="exit">X</div> 
						<p class="head_text"><?php echo $this->lang->line('GET_BEST_PRICE'); ?></p>-->
						
						<!-- <div class="col-sb-el col-sb-phone col-xs-12 phone_wrb">
							<div class="form-group" id="phone">
								<span class="form-icon icon-phone"></span>
								<input type="tel" class="form-control"
											 <?php if ($this->user->is_logged()) { ?>
											 value="+00000000000"
											 <?php } ?>
											 name="phone"
											 placeholder="<?php echo $this->lang->line('L_GEN_YOUR_PHONE'); ?>"
											 maxlength="50"
											 v-model="form.phone"
											 debounce="500" 
											 v-on="focus: fieldFocus">
								<div class="popover bottom" style="top: 50px; display: none; opacity: 0;">
									<div class="arrow"></div>
									<div class="popover-content"><?php echo $this->lang->line('L_GEN_PLEASE_SPECIFY_PHONE'); ?></div>
								</div>
								<div class="error_value_field" id="search-popover-phone"></div>
							</div>
						</div>  -->
						
						<!-- Search btn -->
						<div class="col-sb-btn col-xs-12 btn_wrp">
							<div class="form-group">
								<button type="submit" class="btn btn-flat btn-primary">
									<div class="form-icon icon-search"></div>
									<span><?php echo $this->lang->line('L_GEN_BTN_SEARCH_send'); ?></span>
								</button>
							</div>
						</div> 

						 <!-- <div class="clear"></div>
						 <p class="body_text"><?php echo $this->lang->line('GET_BEST_TEXT'); ?></p>
					</div> -->

				</form>
			</div>
		</div>
	

	<div id="topVideo" class="top-video">
		<div class="video-layer"></div>

        <?php $s = $this->uri->segment(1); ?>
        <?php if($s=='stuttgart' || $s == 'munich' || $s == 'cologne' || $s == 'frankfurt') { ?>
            <video autoplay loop poster="/public/video/video.png">
                <source src="/public/video/video.mp4" type="video/mp4">
                <source src="/public/video/hannover.webm" type="video/webm">
            </video>
        <?php } else if($s) {?>
            <?php $s = ucfirst($s); ?>
            <video autoplay loop poster="/public/video/<?php echo $s; ?>.png">
                <source src="/public/video/<?php echo $s; ?>.mp4" type="video/mp4">
                <source src="/public/video/<?php echo $s; ?>.webm" type="video/webm">
            </video>
        <?php } else { ?>
            <video autoplay loop poster="/public/video/1.jpg">
                <source src="/public/video1.mp4" type="video/mp4">
                <source src="/public/video/1.webm" type="video/webm">
            </video>

        <?php } ?>

	</div>
	<div id="topCarousel" class="top-carousel carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#topCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#topCarousel" data-slide-to="1"></li>
			<li data-target="#topCarousel" data-slide-to="2"></li>
			<li data-target="#topCarousel" data-slide-to="3"></li>
		</ol>
		<div class="carousel-inner" role="listbox">
			<div class="item active">
				<div class="top-carousel-img" style="background-image: url('public/img/slide/1.jpg');"></div>
			</div>
			<div class="item">
				<div class="top-carousel-img" style="background-image: url('public/img/slide/3.jpg');"></div>
			</div>
			<div class="item">
				<div class="top-carousel-img" style="background-image: url('public/img/slide/3.jpg');"></div>
			</div>
			<div class="item">
				<div class="top-carousel-img" style="background-image: url('public/img/slide/4.jpg');"></div>
			</div>
		</div>
	</div>
</div>

<!-- Feachured apartments -->
<?php if (!empty($seo_data['aparts'])) { ?>
	<?php $vip_aparts = array_splice($seo_data['aparts'], 0, 2); ?>
	<div class="featured-apart-block" style="background-color: #ededed;">
		<div class="container">
			
			<div class="row">
				<h2 class="text-center text-uc">
			<?php
			$k = $seo_data['aparts'][0];
			$k = $k['city_id'];
			echo $this->lang->line('WORD_POPULAR')." ".$cities[$k]['city_name']." ".$this->lang->line('WORD_APARTMENTS');
			?></h2>
			</div>
			
			<div class="row">
				<?php foreach ($vip_aparts as $key => $apart) { ?>
					<div class="col-xs-12 col-md-6">
						<div class="apart-block-el test">
							<div class="request-btn">
								<button class="btn btn-primary btn-raised" type="button"
												data-apart-id="<?=esc($apart['apart_id'])?>"
												data-apart-type="<?=esc($apart_types[$apart['type']]['title'])?>"
												data-apart-city="<?=esc($cities[$apart['city_id']]['city_name_in'])?>"
												data-toggle="modal"
												data-target="#request-modal">
									<?php echo $this->lang->line('L_GEN_BTN_REQUEST'); ?>
								</button>
							</div>
							<a href="/apartment/view/<?=esc($apart['apart_id'])?>" class="check_input">
								<span class="price">
									<?php echo $this->lang->line('L_GEN_FROM'); ?>
									<strong><?=esc(format_currency($apart['price']))?></strong>
								</span>
								<div class="description">
									<?=esc($apart_types[$apart['type']]['title']) . " " . esc($cities[$apart['city_id']]['city_name_in'])?>
								</div>
								<img src="/image/get-photo-crop/478/252/<?=!empty($grouped_photos[$apart['apart_id']]) ? esc($grouped_photos[$apart['apart_id']]) : 0?>.jpg"
										 class="img-responsive"
										 alt="<?=esc($apart_types[$apart['type']]['title']) . " " . esc($cities[$apart['city_id']]['city_name_in'])?>">
							</a>
						</div>
					</div>
				<? } ?>
			</div>
		</div>
	</div>
<?php } else { ?>
	<div class="featured-apart-block">
		<div class="container">
			<!-- 
			<div class="row">
				<h2 class="text-center text-uc">Feachured apartments</h2>
			</div>
			 -->
			<div class="row">
				<div class="col-xs-12 col-md-6">
					<div class="apart-block-el">
						<div class="request-btn">
							<button class="btn btn-primary btn-raised" type="button"
											data-apart-id="649"
											data-apart-type="<?php echo $apart_types[2]['title']; ?>"
											data-apart-city="<?php echo $cities[5]['city_name_in']; ?>"
											data-toggle="modal"
											data-target="#request-modal">
								<?php echo $this->lang->line('L_GEN_BTN_REQUEST'); ?>
							</button>
						</div>
						<a href="/apartment/view/649" class="check_input">
							<span class="price">
								<?php echo $this->lang->line('L_GEN_FROM'); ?>
								<strong><?=format_currency(65);?></strong>
							</span>
							<div class="description">
								<?php echo $apart_types[2]['title'] . " " . $cities[5]['city_name_in']; ?>
							</div>
							<img src="/images/home/top-2-1.jpg" class="img-responsive"
									 alt="<?php echo $apart_types[2]['title'] . " " . $cities[5]['city_name_in']; ?>">
						</a>
					</div>
				</div>
				<div class="col-xs-12 col-md-6">
					<div class="apart-block-el">
						<div class="request-btn">
							<button class="btn btn-primary btn-raised" type="button"
											data-apart-id="685"
											data-apart-type="<?php echo $apart_types[6]['title']; ?>"
											data-apart-city="<?php echo $cities[10]['city_name_in']; ?>"
											data-toggle="modal"
											data-target="#request-modal">
								<?php echo $this->lang->line('L_GEN_BTN_REQUEST'); ?>
							</button>
						</div>
						<a href="/apartment/view/685" class="check_input">
							<span class="price">
								<?php echo $this->lang->line('L_GEN_FROM'); ?>
								<strong><?=format_currency(70);?></strong>
							</span>
							<div class="description">
								<?php echo $apart_types[6]['title'] . " " . $cities[10]['city_name_in']; ?>
							</div>
							<img src="/images/home/top-2-2.jpg" class="img-responsive"
									 alt="<?php echo $apart_types[6]['title'] . " " . $cities[10]['city_name_in']; ?>">
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php }; $city=""; ?>



<!-- Aparts block -->
<?php if (!empty($seo_data['aparts'])) { ?>
	<div class="apart-block">
	<div class="container">
	<?php foreach ($seo_data['aparts'] as $key => $apart) { ?>
		<!-- <?=esc($apart['apart_id'])?> -->
		<div class="col-xs-12 col-sm-<?=$key == 0 ? 12 : 6;?> col-md-4">
			<div class="apart-block-el">
				<div class="request-btn">
					<button class="btn btn-primary btn-raised" type="button"
									data-apart-id="<?=esc($apart['apart_id'])?>"
									data-apart-type="<?=esc($apart_types[$apart['type']]['title'])?>"
									data-apart-city="<?=esc($cities[$apart['city_id']]['city_name_in'])?>"
									data-toggle="modal"
									data-target="#request-modal">
						<?php echo $this->lang->line('L_GEN_BTN_REQUEST'); ?>
					</button>
				</div>
				<a href="/apartment/view/<?=esc($apart['apart_id'])?>" class="check_input">
					<span class="price">
						<?php echo $this->lang->line('L_GEN_FROM'); ?>
						<strong><?=esc(format_currency($apart['price']))?></strong>
					</span>
					<div class="description">
						<?=esc($apart_types[$apart['type']]['title'])." ". esc($cities[$apart['city_id']]['city_name_in']); $city =esc($cities[$apart['city_id']]['city_name']); //=esc($title)?> 
						
					</div>
					<img src="/image/get-photo-crop/304/168/<?=!empty($grouped_photos[$apart['apart_id']]) ? esc($grouped_photos[$apart['apart_id']]) : 0?>.jpg"
							 class="img-responsive"
							 alt="<?=esc($title)?>">
				</a>
			</div>
		</div>
	<?php } ?>
	</div>
	</div>
<?php }else{ ?>
	<div class="apart-block">
		<div class="container">
			<div class="row">
				<!-- 662 -->
				<div class="col-xs-12 col-sm-12 col-md-4">
					<div class="apart-block-el">
						<div class="request-btn">
							<button class="btn btn-primary btn-raised" type="button"
											data-apart-id="662"
											data-apart-type="<?php echo $apart_types[3]['title']; ?>"
											data-apart-city="<?php echo $cities[10]['city_name_in']; ?>"
											data-toggle="modal"
											data-target="#request-modal">
								<?php echo $this->lang->line('L_GEN_BTN_REQUEST'); ?>
							</button>
						</div>
						<a href="/apartment/view/662" class="check_input">
							<span class="price">
								<?php echo $this->lang->line('L_GEN_FROM'); ?>
								<strong><?=esc(format_currency(63))?></strong>
							</span>
							<div class="description">
								<?php echo $apart_types[3]['title'] . " " . $cities[10]['city_name_in']; ?>
							</div>
							<img src="/images/home/top-9-1.jpg" class="img-responsive" 
									 alt="<?php echo $apart_types[3]['title'] . " " . $cities[10]['city_name_in']; ?>">
						</a>
					</div>
				</div>

				<!-- 641 -->
				<div class="col-xs-12 col-sm-6 col-md-4">
					<div class="apart-block-el">
						<div class="request-btn">
							<button class="btn btn-primary btn-raised" type="button"
											data-apart-id="641"
											data-apart-type="<?php echo $apart_types[6]['title']; ?>"
											data-apart-city="<?php echo $cities[6]['city_name_in']; ?>"
											data-toggle="modal"
											data-target="#request-modal">
								<?php echo $this->lang->line('L_GEN_BTN_REQUEST'); ?>
							</button>
						</div>
						<a href="/apartment/view/641" class="check_input">
							<span class="price">
								<?php echo $this->lang->line('L_GEN_FROM'); ?>
								<strong><?=esc(format_currency(40))?></strong>
							</span>
							<div class="description">
								<?php echo $apart_types[6]['title'] . " " . $cities[6]['city_name_in']; ?>
							</div>
							<img src="/images/home/top-9-2.jpg" class="img-responsive" 
									 alt="<?php echo $apart_types[6]['title'] . " " . $cities[6]['city_name_in']; ?>">
						</a>
					</div>
				</div>

				<!-- 709 -->
				<div class="col-xs-12 col-sm-6 col-md-4">
					<div class="apart-block-el">
						<div class="request-btn">
							<button class="btn btn-primary btn-raised" type="button"
											data-apart-id="709"
											data-apart-type="<?php echo $apart_types[3]['title']; ?>"
											data-apart-city="<?php echo $cities[5]['city_name_in']; ?>"
											data-toggle="modal"
											data-target="#request-modal">
								<?php echo $this->lang->line('L_GEN_BTN_REQUEST'); ?>
							</button>
						</div>
						<a href="/apartment/view/709" class="check_input">
							<span class="price">
								<?php echo $this->lang->line('L_GEN_FROM'); ?>
								<strong><?=esc(format_currency(100))?></strong>
							</span>
							<div class="description">
								<?php echo $apart_types[3]['title'] . " " . $cities[5]['city_name_in']; ?>
							</div>
							<img src="/images/home/top-9-3.jpg" class="img-responsive" 
									 alt="<?php echo $apart_types[3]['title'] . " " . $cities[5]['city_name_in']; ?>">
						</a>
					</div>
				</div>

				<!-- 639 -->
				<div class="col-xs-12 col-sm-6 col-md-4">
					<div class="apart-block-el">
						<div class="request-btn">
							<button class="btn btn-primary btn-raised" type="button"
											data-apart-id="639"
											data-apart-type="<?php echo $apart_types[6]['title']; ?>"
											data-apart-city="<?php echo $cities[6]['city_name_in']; ?>"
											data-toggle="modal"
											data-target="#request-modal">
								<?php echo $this->lang->line('L_GEN_BTN_REQUEST'); ?>
							</button>
						</div>
						<a href="/apartment/view/639" class="check_input">
							<span class="price">
								<?php echo $this->lang->line('L_GEN_FROM'); ?>
								<strong><?=esc(format_currency(57))?></strong>
							</span>
							<div class="description">
								<?php echo $apart_types[6]['title'] . " " . $cities[6]['city_name_in']; ?>
							</div>
							<img src="/images/home/top-9-4.jpg" class="img-responsive" 
									 alt="<?php echo $apart_types[6]['title'] . " " . $cities[6]['city_name_in']; ?>">
						</a>
					</div>
				</div>

				<!-- 594 -->
				<div class="col-xs-12 col-sm-6 col-md-4">
					<div class="apart-block-el">
						<div class="request-btn">
							<button class="btn btn-primary btn-raised" type="button"
											data-apart-id="594"
											data-apart-type="<?php echo $apart_types[2]['title']; ?>"
											data-apart-city="<?php echo $cities[9]['city_name_in']; ?>"
											data-toggle="modal"
											data-target="#request-modal">
								<?php echo $this->lang->line('L_GEN_BTN_REQUEST'); ?>
							</button>
						</div>
						<a href="/apartment/view/594" class="check_input">
							<span class="price">
								<?php echo $this->lang->line('L_GEN_FROM'); ?>
								<strong><?=esc(format_currency(50))?></strong>
							</span>
							<div class="description">
								<?php echo $apart_types[2]['title'] . " " . $cities[9]['city_name_in']; ?>
							</div>
							<img src="/images/home/top-9-5.jpg" class="img-responsive" 
									 alt="<?php echo $apart_types[2]['title'] . " " . $cities[9]['city_name_in']; ?>">
						</a>
					</div>
				</div>

				<!-- 727 -->
				<div class="col-xs-12 col-sm-6 col-md-4">
					<div class="apart-block-el">
						<div class="request-btn">
							<button class="btn btn-primary btn-raised" type="button"
											data-apart-id="727"
											data-apart-type="<?php echo $apart_types[2]['title']; ?>"
											data-apart-city="<?php echo $cities[5]['city_name_in']; ?>"
											data-toggle="modal"
											data-target="#request-modal">
								<?php echo $this->lang->line('L_GEN_BTN_REQUEST'); ?>
							</button>
						</div>
						<a href="/apartment/view/727" class="check_input">
							<span class="price">
								<?php echo $this->lang->line('L_GEN_FROM'); ?>
								<strong><?=esc(format_currency(50))?></strong>
							</span>
							<div class="description">
								<?php echo $apart_types[2]['title'] . " " . $cities[5]['city_name_in']; ?>
							</div>
							<img src="/images/home/top-9-6.jpg" class="img-responsive" 
									 alt="<?php echo $apart_types[2]['title'] . " " . $cities[5]['city_name_in']; ?>">
						</a>
					</div>
				</div>

				<!-- 143 -->
				<div class="col-xs-12 col-sm-6 col-md-4">
					<div class="apart-block-el">
						<div class="request-btn">
							<button class="btn btn-primary btn-raised" type="button"
											data-apart-id="143"
											data-apart-type="<?php echo $apart_types[3]['title']; ?>"
											data-apart-city="<?php echo $cities[5]['city_name_in']; ?>"
											data-toggle="modal"
											data-target="#request-modal">
								<?php echo $this->lang->line('L_GEN_BTN_REQUEST'); ?>
							</button>
						</div>
						<a href="/apartment/view/143" class="check_input">
							<span class="price">
								<?php echo $this->lang->line('L_GEN_FROM'); ?>
								<strong><?=esc(format_currency(65))?></strong>
							</span>
							<div class="description">
								<?php echo $apart_types[3]['title'] . " " . $cities[5]['city_name_in']; ?>
							</div>
							<img src="/images/home/top-9-7.jpg" class="img-responsive" 
									 alt="<?php echo $apart_types[3]['title'] . " " . $cities[5]['city_name_in']; ?>">
						</a>
					</div>
				</div>

				<!-- 644 -->
				<div class="col-xs-12 col-sm-6 col-md-4">
					<div class="apart-block-el">
						<div class="request-btn">
							<button class="btn btn-primary btn-raised" type="button"
											data-apart-id="644"
											data-apart-type="<?php echo $apart_types[2]['title']; ?>"
											data-apart-city="<?php echo $cities[7]['city_name_in']; ?>"
											data-toggle="modal"
											data-target="#request-modal">
								<?php echo $this->lang->line('L_GEN_BTN_REQUEST'); ?>
							</button>
						</div>
						<a href="/apartment/view/644" class="check_input">
							<span class="price">
								<?php echo $this->lang->line('L_GEN_FROM'); ?>
								<strong><?=esc(format_currency(60))?></strong>
							</span>
							<div class="description">
								<?php echo $apart_types[2]['title'] . " " . $cities[7]['city_name_in']; ?>
							</div>
							<img src="/images/home/top-9-8.jpg" class="img-responsive" 
									 alt="<?php echo $apart_types[2]['title'] . " " . $cities[7]['city_name_in']; ?>">
						</a>
					</div>
				</div>

				<!-- 645 -->
				<div class="col-xs-12 col-sm-6 col-md-4">
					<div class="apart-block-el">
						<div class="request-btn">
							<button class="btn btn-primary btn-raised" type="button"
											data-apart-id="645"
											data-apart-type="<?php echo $apart_types[3]['title']; ?>"
											data-apart-city="<?php echo $cities[7]['city_name_in']; ?>"
											data-toggle="modal"
											data-target="#request-modal">
								<?php echo $this->lang->line('L_GEN_BTN_REQUEST'); ?>
							</button>
						</div>
						<a href="/apartment/view/645" class="check_input">
							<span class="price">
								<?php echo $this->lang->line('L_GEN_FROM'); ?>
								<strong><?=esc(format_currency(68))?></strong>
							</span>
							<div class="description">
								<?php echo $apart_types[3]['title'] . " " . $cities[7]['city_name_in']; ?>
							</div>
							<img src="/images/home/top-9-9.jpg" class="img-responsive" alt="<?php echo $apart_types[3]['title'] . " " . $cities[7]['city_name_in']; ?>">
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } 

if($city!=''):
?>
<div class="container">
<h2 class="text-center text-uc"><?php echo $city." ".$this->lang->line('WORD_APARTMENTS')." ".$this->lang->line('WORD_ON_MAP'); ?></h2>
<div id="map_canvas" style="width:100%; height:400px;"></div>
</div>
<!-- <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	var address='<?php echo $city; ?>';
	geocoder = new google.maps.Geocoder();
    geocoder.geocode( { 'address': address}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) { 
    	$lat=results[0].geometry.location.lat();
    	$lng=results[0].geometry.location.lng();
    	initialize($lat, $lng);
    };
	});
	
});
function initialize($lat, $lng) {     
	var myLatlng = new google.maps.LatLng($lat, $lng);
	var myOptions = {
		zoom: 12,
		center: myLatlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	}
	var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions); 

	var marker = new google.maps.Marker({position: myLatlng,map: map});
	var myLatlng1 = new google.maps.LatLng($lat-0.01, $lng-0.01);
	var marker1 = new google.maps.Marker({position: myLatlng1,map: map});
	var myLatlng2 = new google.maps.LatLng($lat-0.02, $lng-0.01);
	var marker2 = new google.maps.Marker({position: myLatlng2,map: map});
	var myLatlng3 = new google.maps.LatLng($lat+0.01, $lng+0.02);
	var marker3 = new google.maps.Marker({position: myLatlng3,map: map});
	var myLatlng4 = new google.maps.LatLng($lat+0.015, $lng-0.015);
	var marker4 = new google.maps.Marker({position: myLatlng4,map: map});
	var myLatlng5 = new google.maps.LatLng($lat-0.015, $lng-0.02);
	var marker5 = new google.maps.Marker({position: myLatlng5,map: map});
	var myLatlng6 = new google.maps.LatLng($lat-0.02, $lng+0.015);
	var marker6 = new google.maps.Marker({position: myLatlng6,map: map});
	var myLatlng7 = new google.maps.LatLng($lat-0.025, $lng+0.01);
	var marker7 = new google.maps.Marker({position: myLatlng7,map: map});
	var myLatlng8 = new google.maps.LatLng($lat-0.01, $lng+0.025);
	var marker8 = new google.maps.Marker({position: myLatlng8,map: map});
	var myLatlng9 = new google.maps.LatLng($lat+0.015, $lng-0.025);
	var marker9 = new google.maps.Marker({position: myLatlng9,map: map});
	var myLatlng0 = new google.maps.LatLng($lat+0.025, $lng-0.015);
	var marker0 = new google.maps.Marker({position: myLatlng0,map: map});

	map.addListener('click', function(e) {
		$("html, body").animate({ scrollTop: 0 }, 600);
		//$z=('#search-popover-checkIn');
       // $z.animate({opacity: 1}, 500, function(){$z.animate({opacity: 0}, 500, function(){$z.animate({opacity: 1}, 500, function(){$z.animate({opacity: 0}, 500, function(){$z.animate({opacity: 1}, 500, function(){$z.animate({opacity: 0}, 500, function(){$z.animate({opacity: 1}, 500, function(){$z.animate({opacity: 0}, 500, function(){$z.animate({opacity: 1}, 500, function(){$z.animate({opacity: 0}, 500);});});});});});});});});})
        //$('.error_value_field').animate({opacity: 1}, 500);
        animare_error()
  });

	marker.addListener('click', function(e) {$("html, body").animate({ scrollTop: 0 }, 600);$('.error_value_field').animate({opacity: 1}, 500);});
	marker1.addListener('click', function(e) {$("html, body").animate({ scrollTop: 0 }, 600);$('.error_value_field').animate({opacity: 1}, 500);});
	marker2.addListener('click', function(e) {$("html, body").animate({ scrollTop: 0 }, 600);$('.error_value_field').animate({opacity: 1}, 500);});
	marker3.addListener('click', function(e) {$("html, body").animate({ scrollTop: 0 }, 600);$('.error_value_field').animate({opacity: 1}, 500);});
	marker4.addListener('click', function(e) {$("html, body").animate({ scrollTop: 0 }, 600);$('.error_value_field').animate({opacity: 1}, 500);});
	marker5.addListener('click', function(e) {$("html, body").animate({ scrollTop: 0 }, 600);$('.error_value_field').animate({opacity: 1}, 500);});
	marker6.addListener('click', function(e) {$("html, body").animate({ scrollTop: 0 }, 600);$('.error_value_field').animate({opacity: 1}, 500);});
	marker7.addListener('click', function(e) {$("html, body").animate({ scrollTop: 0 }, 600);$('.error_value_field').animate({opacity: 1}, 500);});
	marker8.addListener('click', function(e) {$("html, body").animate({ scrollTop: 0 }, 600);$('.error_value_field').animate({opacity: 1}, 500);});
	marker9.addListener('click', function(e) {$("html, body").animate({ scrollTop: 0 }, 600);$('.error_value_field').animate({opacity: 1}, 500);});
	marker0.addListener('click', function(e) {$("html, body").animate({ scrollTop: 0 }, 600);$('.error_value_field').animate({opacity: 1}, 500);});
}

function animare_error() {
	$z=document.getElementById('search-popover-checkIn');
    $z.animate({opacity: 1}, 500, function(){$z.animate({opacity: 0}, 500, function(){$z.animate({opacity: 1}, 500, function(){$z.animate({opacity: 0}, 500, function(){$z.animate({opacity: 1}, 500, function(){$z.animate({opacity: 0}, 500, function(){$z.animate({opacity: 1}, 500, function(){$z.animate({opacity: 0}, 500, function(){$z.animate({opacity: 1}, 500, function(){$z.animate({opacity: 0}, 500);});});});});});});});});})
        
}
</script>
<?php endif; ?>

<?php //if (empty($seo_data['aparts'])){ ?>
<!-- Popular destinations -->
<div class="popular-dest-block">
	<div class="container">
		<div class="row">
			<h2 class="text-center text-uc">
				<?php echo $this->lang->line('L_GEN_POPULAR_DESTINATIONS'); ?>
			</h2>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-4">
				<a href="/hannover" class="popular-dest-el check_input">
					<span><?php echo $cities[3]['city_name']; ?></span>
					<img src="/public/img/popular-destinations/hannover.jpg" class="img-responsive" alt="">
				</a>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-4">
				<a href="/frankfurt" class="popular-dest-el check_input">
					<span><?php echo $cities[4]['city_name']; ?></span>
					<img src="/public/img/popular-destinations/frankfurt.jpg" class="img-responsive" alt="">
				</a>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-4">
				<a href="/dusseldorf" class="popular-dest-el check_input">
					<span><?php echo $cities[5]['city_name']; ?></span>
					<img src="public/img/popular-destinations/dusseldorf.jpg" class="img-responsive" alt="">
				</a>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-4">
				<a href="/apartment?city=9" class="popular-dest-el check_input">
					<span><?php echo $cities[9]['city_name']; ?></span>
					<img src="public/img/popular-destinations/berlin.jpg" class="img-responsive" alt="">
				</a>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-4">
				<a href="/apartment?city=8" class="popular-dest-el check_input">
					<span><?php echo $cities[8]['city_name']; ?></span>
					<img src="public/img/popular-destinations/stuttgart.jpg" class="img-responsive" alt="">
				</a>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-4">
				<a href="/apartment?city=6" class="popular-dest-el check_input">
					<span><?php echo $cities[6]['city_name']; ?></span>
					<img src="public/img/popular-destinations/cologne.jpg" class="img-responsive" alt="">
				</a>
			</div>
		</div>
	</div>
</div>

<?php //} ?>

<!-- Review block -->
<!--
<div class="review-block">
	<div class="container">
		<div class="row">
			<h2 class="text-center text-uc">
				<?php echo $this->lang->line('L_GEN_REVIEWS_ABOUT_US'); ?>
			</h2>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-4">
				<div class="review">
					<div class="review-text">
						<p>We are now in Hannover! Hotel booked on proffair.com. Thank you very much! Everything was easy, without problems! Feel sure making a booking here!<br><br></p>
					</div>
					<div class="review-footer">
						<div class="rating-stars-main left">
							<div class="rating-stars-bg"></div>
							<div class="rating-stars-value" style="width: 100%"></div>
						</div>
						<div class="right">
							<span>20.05.2014</span>
							<img src="/public/img/icons/flags/BE.png" class="review-flag">
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-4">
				<div class="review">
					<div class="review-text">
						<p>Thank you very much! Wonderful website! I've booked an apartment so cheap and fast! I would recommend this website to everybody planning to travel to Germany in the soonest time!</p>
					</div>
					<div class="review-footer">
						<div class="rating-stars-main left">
							<div class="rating-stars-bg"></div>
							<div class="rating-stars-value" style="width: 100%"></div>
						</div>
						<div class="right">
							<span>19.05.2014</span>
							<img src="/public/img/icons/flags/NL.png" class="review-flag">
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-4">
				<div class="review">
					<div class="review-text">
						<p>Booked accommodations in Berlin and checked-in without any problems! Now planning to go to Frankfurt. The ladies fron call center are always very nice and attentive! Work promptly!</p>
					</div>
					<div class="review-footer">
						<div class="rating-stars-main left">
							<div class="rating-stars-bg"></div>
							<div class="rating-stars-value" style="width: 100%"></div>
						</div>
						<div class="right">
							<span>18.05.2014</span>
							<img src="/public/img/icons/flags/DE.png" class="review-flag">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
-->


<?php $this->load->view('responsive/common/view_footer'); ?>