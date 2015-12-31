
        
    	<!-- <div class="clearfix"></div> -->
		
		<div dir-paginate="post in posts | itemsPerPage: postsPerPage | filter: post.post_title | orderBy:orderByData">
         
            <div data-ng-if="postView == 'list' ">



                <div class="vechicle-single">

                    <div class="vechicle-thumbnail">
                        <div class="overlay">
                             <img  data-ng-src="{{ post.post_thumbnail }}"/>
                            <div class="overlay-shadow">
                                <div class="overlay-content">
                                     <a href="{{ post.post_permalink }}" ng-click="save_date($event, post.post_id, hireon , returnon, pickupLocation, returnLocation, post.post_permalink)" class="btn white"><?php _e('Read More','autorent'); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="vechicle-specification">

                        <header class="vechicle-header col-lg-12 col-md-12 col-sm-12 col-xs-12">

                            <div class="header-inner">
                                <h4 class="title pull-left"><a href="{{ post.post_permalink }}" ng-click="save_date($event, post.post_id, hireon , returnon, pickupLocation, returnLocation, post.post_permalink)">{{ post.post_title }}</a></h4>
                                
                                <?php if(class_exists('Woocommerce')): ?>

                                    <?php 

                                        $currency_pos = get_option( 'woocommerce_currency_pos' );


                                        switch ( $currency_pos ) {
                                        case 'left' :   
                                    ?>
                                            <span class="pull-right">Starting <?php echo esc_attr(get_woocommerce_currency_symbol()); ?>{{post.price}}</span>

                                    <?php         break;
                                             case 'right' :
                                    ?>         
                                            <span class="pull-right">Starting {{post.price}}<?php echo esc_attr(get_woocommerce_currency_symbol()); ?></span>
                                    <?php
                                             break;
                                             case 'left_space' :
                                    ?>         
                                            <span class="pull-right">Starting <?php echo esc_attr(get_woocommerce_currency_symbol()); ?>&nbsp;{{post.price}}</span>
                                    <?php  
                                             break;
                                             case 'right_space' :
                                    ?>         
                                            <span class="pull-right">Starting {{post.price}}&nbsp;<?php echo esc_attr(get_woocommerce_currency_symbol()); ?></span>
                                    <?php
                                             break;
                                        }

                                ?>


                            <?php endif; ?> 
                              
                            </div>

                        </header>




                        <ul class="properties custom-list">

                            <li data-ng-if="post.vehicle_age" class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><?php _e('Vehicle Age','autorent'); ?> <strong>{{post.vehicle_age}}</strong></li>
                            <li data-ng-if="post.people_capacity" class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><?php _e('Capacity (People) ','autorent'); ?><strong>{{post.people_capacity}}+{{post.additional_people}}</strong> </li>
                            <li data-ng-if="post.max_speed" class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><?php _e('Max Speed','autorent'); ?> <strong>{{post.max_speed}}</strong> </li>
                            <li data-ng-if="post.fuel_capacity" class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><?php _e('Fuel Capacity','autorent'); ?> <strong>{{post.fuel_capacity}}</strong></li>
                            <li data-ng-if="post.max_weight" class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><?php _e('Max Weight','autorent'); ?><strong>{{post.max_weight}}</strong> </li>
                            <li data-ng-if="post.min_pilots" class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><?php _e('Pilots (Min.)','autorent'); ?> <strong>{{post.min_pilots}}</strong> </li>
                            <li class="col-lg-6 col-md-6 col-sm-6 col-xs-12" ng-repeat="attribute in post.additional_attrs">
                                {{attribute._name}}<strong>{{attribute._value}}</strong>                               
                            </li>

                        </ul> 

                    </div>
                    <div class="cars-button-link" style="float: right">
                    <a href="{{ post.post_permalink }}" ng-click="save_date($event, post.post_id, hireon , returnon, pickupLocation, returnLocation, post.post_permalink)" class="btn white"><?php _e('More Details','autorent'); ?></a>
                    <a href="index.php?extras=donow&another_var=roman" class="btn white"><?php _e('Book Now','autorent'); ?></a>
                    </div>
                </div>
                
                

            </div>




            <div data-ng-if="postView == 'grid'">


                
                <div class="vechicle-single col-lg-4 col-md-6 col-sm-12 col-xs-12">

                    <div class="vechicle-thumbnail">
                        <div class="overlay">
                            <img data-ng-src="{{ post.post_thumbnail }}"/>
                            <div class="overlay-shadow">
                                <div class="overlay-content">
                                    <a href="{{ post.post_permalink }}" ng-click="save_date($event, post.post_id, hireon , returnon, pickupLocation, returnLocation, post.post_permalink)"  class="btn white"><?php _e('Read More','autorent'); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>




                    <div class="vechicle-specification">
                       
                        <header class="vechicle-header col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="header-inner">
                                <h4 class="title"><a href="{{ post.post_permalink }}" ng-click="save_date($event, post.post_id, hireon , returnon, pickupLocation, returnLocation, post.post_permalink)">{{ post.post_title }}</a></h4>
                               
                                <?php if(class_exists('Woocommerce')): ?>
                
                                    <?php 
        
                                        $currency_pos = get_option( 'woocommerce_currency_pos' );                                
        
                                        switch ( $currency_pos ) {
                                        case 'left' :   
                                    ?>
                                            <span>Starting <?php echo esc_attr(get_woocommerce_currency_symbol()); ?>{{post.price}}</span>
        
                                    <?php         break;
                                             case 'right' :
                                    ?>         
                                            <span>Starting {{post.price}}<?php echo esc_attr(get_woocommerce_currency_symbol()); ?></span>
                                    <?php
                                             break;
                                             case 'left_space' :
                                    ?>         
                                            <span>Starting <?php echo esc_attr(get_woocommerce_currency_symbol()); ?>&nbsp;{{post.price}}</span>
                                    <?php  
                                             break;
                                             case 'right_space' :
                                    ?>         
                                            <span>Starting {{post.price}}&nbsp;<?php echo esc_attr(get_woocommerce_currency_symbol()); ?></span>
                                    <?php
                                             break;
                                        }
        
                                    ?>
        
        
                                <?php endif; ?>
                                
                            </div>
                        </header>

                        <ul class="properties col-lg-12 col-md-12 col-sm-12 col-xs-12">

                            <li data-ng-if="post.vehicle_age"><?php _e('Vehicle Age','autorent'); ?> <strong>{{post.vehicle_age}}</strong></li>
                            <li data-ng-if="post.people_capacity"><?php _e('Capacity (People) ','autorent'); ?><strong>{{post.people_capacity}}+{{post.additional_people}}</strong> </li>
                            <li data-ng-if="post.max_speed"><?php _e('Max Speed','autorent'); ?> <strong>{{post.max_speed}}</strong> </li>
                            <li data-ng-if="post.fuel_capacity"><?php _e('Fuel Capacity','autorent'); ?> <strong>{{post.fuel_capacity}}</strong></li>
                            <li data-ng-if="post.max_weight"><?php _e('Max Weight','autorent'); ?><strong>{{post.max_weight}}</strong> </li>
                            <li data-ng-if="post.min_pilots"><?php _e('Pilots (Min.)','autorent'); ?> <strong>{{post.min_pilots}}</strong> </li>

                            <li ng-repeat="attribute in post.additional_attrs">
                                {{attribute._name}}<strong>{{attribute._value}}</strong>                               
                            </li>

                        </ul>

                    </div>
                </div>
                
            </div>
		</div>

        

		<div class="loading" data-ng-show="loading"><i></i><i></i><i></i></div>		
		<alert style="margin-top:200px;" type="danger" data-ng-show="( posts | filter:QuickSearch).length==0">
            <?php _e('Sorry No Result Found','autorent'); ?>
		</alert>
		
		<!-- <div class="clearfix"></div> -->
		
		<!-- Start pagination  -->
        
        <div class="fleets-listing-footer col-lg-12">
            <div class="fleets-footer-inner">
		      <dir-pagination-controls boundary-links="true" class="pull-right" on-page-change="pageChangeHandler(newPageNumber)" template-url="<?php  echo UOU_ATMF_URL .'/assets/js/vendor/angular-utils-pagination/dirPagination.tpl.html';  ?>"></dir-pagination-controls>
            </div>
		</div>
             <!-- End pagination  -->