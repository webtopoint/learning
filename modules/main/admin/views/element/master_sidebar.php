
<div data-kt-menu-trigger="click" class="menu-item <?=active('pages',['index','category','menu','static_pages'],'show')?> menu-accordion">
	<span class="menu-link">
		<span class="menu-icon">
			<!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
			<span class="svg-icon svg-icon-5">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
					<path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
					<path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="black" />
				</svg>
			</span>
			<!--end::Svg Icon-->
		</span>
		<span class="menu-title">{text_page_area}</span>
		<span class="menu-arrow"></span>
	</span>
	<div class="menu-sub menu-sub-accordion" kt-hidden-height="291" style="display: <?=active('pages',['index','category','menu','static_pages'],'block','none')?>; overflow: hidden;">
	    
		<div class="menu-item">
			<a class="menu-link <?=active('pages','index','active')?>" href="/admin/pages/">
				<span class="menu-bullet">
					<span class="bullet bullet-dot"></span>
				</span>
				<span class="menu-title">{text_all_pages}</span>
			</a>
		</div>
		
		<div class="menu-item">
			<a class="menu-link <?=active('pages','category','active')?>" href="/admin/pages/category">
				<span class="menu-bullet">
					<span class="bullet bullet-dot"></span>
				</span>
				<span class="menu-title">{text_page_category}</span>
			</a>
		</div>
		
		<div class="menu-item">
			<a class="menu-link <?=active('pages','menu','active')?>" href="/admin/pages/menu">
				<span class="menu-bullet">
					<span class="bullet bullet-dot"></span>
				</span>
				<span class="menu-title">{text_website_menu}</span>
			</a>
		</div>
		
		<div class="menu-item">
			<a class="menu-link <?=active('pages','static_pages','active')?>" href="/admin/pages/static_pages">
				<span class="menu-bullet">
					<span class="bullet bullet-dot"></span>
				</span>
				<span class="menu-title">{text_static_page}</span>
			</a>
		</div>
		
		
	</div>
</div> 
<div data-kt-menu-trigger="click" class="menu-item <?=active('setting',['language_text','index','important_links','social_links'],'show')?> menu-accordion">
	<span class="menu-link">
		<span class="menu-icon">
			<!--begin::Svg Icon | path: icons/duotune/arrows/arr001.svg-->
			<span class="svg-icon svg-icon-5">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
					<path d="M14.4 11H3C2.4 11 2 11.4 2 12C2 12.6 2.4 13 3 13H14.4V11Z" fill="black" />
					<path opacity="0.3" d="M14.4 20V4L21.7 11.3C22.1 11.7 22.1 12.3 21.7 12.7L14.4 20Z" fill="black" />
				</svg>
			</span>
			<!--end::Svg Icon-->
		</span>
		<span class="menu-title">{settings}</span>
		<span class="menu-arrow"></span>
	</span>
	<div class="menu-sub menu-sub-accordion" kt-hidden-height="291" style="display: <?=active('setting',['language_text','important_links','social_links','index'],'block','none')?>; overflow: hidden;">
	    
		<div class="menu-item">
			<a class="menu-link <?=active('setting','language_text')?>" href="/admin/setting/language_text">
				<span class="menu-bullet">
					<span class="bullet bullet-dot"></span>
				</span>
				<span class="menu-title">{language_text}</span>
			</a>
		</div>
		
		<div class="menu-item">
			<a class="menu-link <?=active('setting','important_links')?>" href="/admin/setting/important_links">
				<span class="menu-bullet">
					<span class="bullet bullet-dot"></span>
				</span>
				<span class="menu-title">{important_links}</span>
			</a>
		</div>
		
		<div class="menu-item">
			<a class="menu-link <?=active('setting','social_links')?>" href="/admin/setting/social_links">
				<span class="menu-bullet">
					<span class="bullet bullet-dot"></span>
				</span>
				<span class="menu-title">{social_links}</span>
			</a>
		</div>
		
		<div class="menu-item">
			<a class="menu-link <?=active('setting','index')?>" href="/admin/setting">
				<span class="menu-bullet">
					<span class="bullet bullet-dot"></span>
				</span>
				<span class="menu-title">{text_setting}</span>
			</a>
		</div>
		
		<!--<div class="menu-item">-->
		<!--	<a class="menu-link <?=active('setting','footer')?>" href="/admin/setting/footer">-->
		<!--		<span class="menu-bullet">-->
		<!--			<span class="bullet bullet-dot"></span>-->
		<!--		</span>-->
		<!--		<span class="menu-title">{text_footer_setting}</span>-->
		<!--	</a>-->
		<!--</div>-->
		
	</div>
</div> 