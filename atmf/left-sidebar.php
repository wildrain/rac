<?php global $autorent_option_data; ?>

<!-- <div class="search-query-info">	
	<ul class="custom-list properties fleet-vechicle-properties">
		{{hireon}};
		{{hireon}};
		{{pickupLocation}};
		{{returnLocation}};
		<li>Vehicle Age <strong>5</strong></li>
		<li>Capacity (People) <strong>4+1</strong> </li>
		<li>Max Speed <strong>1 Ma</strong> </li>
		<li>Fuel Capacity<strong>1 Ma</strong></li>
		<li>Max Weight<strong>1 Ton</strong></li>
		<li>Pilots (Min.)<strong>1</strong></li>
	</ul>	
</div>	 -->



<input type="text" placeholder="<?php echo esc_attr($autorent_option_data['autorent_quick_search_placeholder']); ?> " class="form-control" data-ng-model="QuickSearch">

<h4 class="title-widget"><?php _e('Available On','autorent'); ?></h4>

<form class="default-form">

	<p class="form-row">
		<span class="calendar-input">
			<input type="text" name="hireOn" data-ng-model="dateData.starton_date" placeholder="<?php echo esc_attr($autorent_option_data['autorent_listing_hireon_data']); ?>" data-dateformat="dd-mm-yy">
			<i class="fa fa-calendar"></i>
		</span>
	</p>

	<span class="calendar-input">
		<input type="text" name="RetunOn" data-ng-model="dateData.returnon_date" data-ng-change="grabDate(dateData)" placeholder="<?php echo esc_attr($autorent_option_data['autorent_listing_returnon_data']); ?>" data-dateformat="dd-mm-yy">
		<i class="fa fa-calendar"></i>
	</span>

</form>
					

<script type="text/ng-template" id="items_renderer.html">


	<!-- for taxonomy  -->
	<div ng-if="item.option =='taxonomy' && !item.parent_taxonomy">

		<h4 class="title-widget">{{ item.title }}</h4>

		<div data-ng-if="item.taxonomy">

			<div data-ng-show="item.viewType == 'checkbox'">
				<ul class="autorent-checbox">
					<li data-ng-repeat="(key, value) in item.alloption">
					  <input type="checkbox" data-ng-change="grabResult( this ,formData[item.taxonomy][key], item)"  name="{{value}}" data-ng-model="formData[item.taxonomy][key]"  > {{value}}
					</li>
				</ul>
			</div>

            <div data-ng-show="item.viewType == 'select'">
                <select class="form-control" data-ng-change="grabResult( this ,formData[item.taxonomy] , item)" data-ng-model="formData[item.taxonomy]">
                    <option value="">Please select</option>

                    <option value="{{key}}" data-ng-repeat="(key ,value) in item.alloption">{{value}}</option>
                </select>
            </div>

		</div>

	</div>





	<!--  metadata   -->

	<div data-ng-if="item.option == 'metadata' ">
		<h4 class="title-widget">{{ item.title }}</h4>	


		<div data-ng-if="item.viewType =='range' ">
			<div class="range-slider slider-range-container box-row clearfix">
				<div slider min="item.rangeStart"  max="item.rangeEnd" start="item.start" end="item.end" class="cdbl-slider" onend="grabMeta()" onchnage="addTometa(item.metakey ,item.start , item.end)" key="item.metakey" ></div>
				<br/>

				<div class="clearfix">
					<input type="text" class="range-from" value="{{item.start}} <?php echo esc_attr(get_woocommerce_currency_symbol()); ?>">
					<input type="text" class="range-to" value="{{item.end}} <?php echo esc_attr(get_woocommerce_currency_symbol()); ?>">
				</div>

			</div>
		</div>


		<div data-ng-show="item.viewType == 'checkbox' ">
			<ul data-ng-if="item.metakey">
				<li data-ng-repeat="(key, value) in item.alloption">
				  <input type="checkbox" data-ng-change="grabMeta()" name="{{value}}" data-ng-model="formMeta[item.metakey][value]"> {{value}}
				</li>
			</ul>
		</div>

		<div data-ng-show="item.viewType == 'radio' ">
			<ul data-ng-if="item.metakey">
				<li data-ng-repeat="(key, value) in item.alloption">
				  <input type="radio"   name="{{item.metakey}}" data-ng-model="formMeta[item.metakey]" data-ng-value="{{value}}"  data-ng-change="grabMeta()"> {{value}}
				</li>
			</ul>					
		</div>


		<div data-ng-show="item.viewType == 'select' ">								
            <select class="form-control" data-ng-change="grabMeta()" data-ng-model="formMeta[item.metakey]" data-ng-options="o as o for o in item.alloption"> <option value="">All</option></select>
		</div>

	</div>





	<!--  second stage  , it will show after its parent show  	-->	

	<div data-ng-show="selected_taxonomy.indexOf(item.parent_taxonomy)!=-1">
			
		<h3>{{ item.title }}</h3>	


        <div data-ng-if="item.taxonomy">

            <div data-ng-show="item.viewType == 'checkbox'">
                <ul>
                    <li data-ng-repeat="(key, value) in item.alloption">
                        <input type="checkbox" data-ng-change="grabResult( this ,formData[item.taxonomy][key], item)"  name="{{value}}" ng-model="formData[item.taxonomy][key]"  > {{value}}
                    </li>
                </ul>
            </div>

<!--        <div data-ng-show="item.viewType == 'select'">-->
<!--        	<select class="form-control" data-ng-change="grabResult( this ,formData[item.taxonomy] , item)" data-ng-model="formData[item.taxonomy]">-->
<!--            	<option value="">Please select</option>-->
<!--                <option value="{{key}}" ng-repeat="(key ,value) in item.alloption">{{value}}</option>-->
<!--            </select>-->
<!--         </div>-->
        </div>

	</div>

	<div data-ng-repeat="item in item.items" data-ng-include="'items_renderer.html'"></div>

</script>



<div data-ng-repeat="item in list" data-ng-include="'items_renderer.html'"></div>	

<div class="row">
	<div class="filter col-lg-6 col-md-12">
		<a data-ng-click="doFilter()" class="btn dark" href="#"> <?php  _e('Filter','atmf');  ?></a>
		
	</div>
	<div class="search col-lg-6 col-md-12">
		<a data-ng-click="doReset()" class="btn dark" href="#"> <?php  _e('Reset','atmf');  ?></a>
	</div>
</div>





					 

					