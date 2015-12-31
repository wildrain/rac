<?php
/**
 * Template Name: ATMF Search Page
 *
 * A template used to demonstrate how to include the template
 * using this plugin.
 *
 * @package ATMF
 * @since 	1.0.0
 * @version	1.0.0
 */

 	get_header();
?>

<!--START : DO NOT DELETE THIS BLOCK -->
<div id="dso" style="display: none;">
    <?php do_action('atmf_hidden_data_show'); ?>
</div>
<!--END: DO NOT DELETE THIS BLOCK -->

<section class="listing">
	<div data-ng-app="atmf" ng-cloak>
		<div data-ng-controller="AtmfFrontEnd">
			<div class="container">
				
				
				<!-- start of main  -->

				<div class="fleet-filter col-lg-3 col-md-4 col-sm-12">
					<div class="toggle-button">
						<h4><?php _e('Filters','autorent'); ?></h4>
					</div>
					<div class="sidebar">

						<?php  get_search_sidebar(); ?>					


					</div>
				</div>
				
				<!-- end of sidebar  -->

				<div class="fleets-listing-header col-lg-9 col-md-8">
					<div class="fleets-listing-inner">
						<h4 class="title pull-left"><?php _e('Available Vechicles','autorent'); ?></h4>
						<?php if(isset($autorent_option_data['autorent_car_storting_switch']) && !empty($autorent_option_data['autorent_car_storting_switch'])): ?>
							<select class="form-control car-order-by" ng-model="orderByData" ng-options="option.value as option.name for option in options"></select>
						<?php endif; ?>

						<div class="fleet-option pull-right">

							<?php global $autorent_option_data;?>

							<input type="hidden" id="selectView"  value="<?php echo esc_attr($autorent_option_data['autorent_select_template_view']); ?>">


							<?php if($autorent_option_data['autorent_select_template_view'] === 'list'): ?>

								<ul class="view-toggle custom-list list-inline">
					                <li class="listView"><a href="#"  data-ng-click="postView='list'; activeLayout = !activeLayout;" data-layout="with-thumb" data-ng-class="activeLayout ? '': 'active' "><i class="fa fa-list-ul"></i></a></li>
					                <li class = "gridView"><a href="#"  data-ng-click="postView='grid'; activeLayout = !activeLayout;" data-layout=""  data-ng-class="activeLayout ? 'active': '' "><i class="fa  fa-th"></i></a></li>
					            </ul>

				        	<?php endif; ?>


				        	<?php if($autorent_option_data['autorent_select_template_view'] === 'grid'): ?>

								<ul class="view-toggle custom-list list-inline">
					                <li class="listView"><a href="#"  data-ng-click="postView='list'; activeLayout = !activeLayout;" data-layout="with-thumb" data-ng-class="activeLayout ? 'active': '' "><i class="fa fa-list-ul"></i></a></li>
					                <li class = "gridView"><a href="#"  data-ng-click="postView='grid'; activeLayout = !activeLayout;" data-layout=""  data-ng-class="activeLayout ? '': 'active' "><i class="fa  fa-th"></i></a></li>
					            </ul>

				        	<?php endif; ?>

							<!-- Start pagination  -->
							<dir-pagination-controls boundary-links="true"  on-page-change="pageChangeHandler(newPageNumber)" template-url="<?php  echo UOU_ATMF_URL .'/assets/js/vendor/angular-utils-pagination/dirPagination.tpl.html';  ?>"></dir-pagination-controls>
							<!-- End pagination  -->

							<div class="number-select" >

				                <select class="form-control ng-pristine ng-valid"  data-ng-model="postsPerPage">
				                    <option value="1">1</option>
				                    <option value="6">6</option>
				                    <option value="9">9</option>
				                    <option value="12">12</option>
				                    <option value="15">15</option>
				                    <option value="18">18</option>
				                    <option value="21">21</option>
				                    <option value="24">24</option>
				                </select>

				            </div>

				        </div>

					</div>

				</div>

				<div class="fleet-listing col-lg-9 col-md-8">


					<div data-ng-if="postView == 'list' " class="fleets-listing-vechicles col-lg-12 col-md-12 col-sm-12 col-xs-12 list-layout">

      					<div class="row">
							
							<?php  get_search_result(); ?>								
						
      					</div>

    				</div>


    				<div data-ng-if="postView == 'grid' " class="fleets-listing-vechicles grid-layout">

      					<div class="row">
							
							<?php  get_search_result(); ?>								
						
      					</div>

    				</div>

    			</div>




		        </div>
				
			</div><!--   end container  -->
		</div>
	</div>
</section>



<!-- Start rental experience -->
<section class="partners">
<?php get_template_part( 'templates/autorent', 'rental_experience'); ?>  
</section>  
<!-- End rental experience --> 

<?php  

 get_footer();




