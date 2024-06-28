<?php if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Elementor_Custom_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'listing_widget';
	}

	public function get_title() {
		return __( 'Listing Widget', 'plugin-name' );
	}

	public function get_icon() {
		return 'eicon-code';
	}

	public function get_categories() {
		return [ 'general' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Listings', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'post_quantity',
			[
				'label' => __( 'Number of properties in the widget', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 50,
				'step' => 1,
				'default' => 5,
			]
		);

		$this->add_control(
			'show_filter',
			[
				'label' => __( 'Show Filter', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'plugin-name' ),
				'label_off' => __( 'Hide', 'plugin-name' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'city_term',
			[
				'label' => __('Select City', 'your-plugin-textdomain'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => $this->get_taxonomy_terms_options('localization'), // Replace with your actual taxonomy slug
				'label_block' => true,
			]
		);


		$this->add_control(
			'market_term',
			[
				'label' => __('Select Type', 'your-plugin-textdomain'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => $this->get_taxonomy_terms_options('market'), // Replace with your actual taxonomy slug
				'label_block' => true,
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$post_quantity = $settings['post_quantity'];

		$city_term_id = $settings['city_term'];
		$market_term_id = $settings['market_term'];

		$tax_query = [];

		$show_filter = $settings['show_filter'];
		if ('yes' === $show_filter) {
			include( __DIR__ . '/templates/filter.php');
        }


		if ($city_term_id) {
			$tax_query[] = [
				'taxonomy' => 'localization',
				'field'    => 'name',
				'terms'    => $city_term_id,
			];
		}

		if ($market_term_id) {
			$tax_query[] = [
				'taxonomy' => 'market',
				'field'    => 'name',
				'terms'    => $market_term_id,
			];
		}

		$args = [
			'post_type' => 'imoveis', // Replace with your custom post type
			'posts_per_page' => $post_quantity,
			'tax_query' => $tax_query,
		];

		if (empty($tax_query)) {
			unset($args['tax_query']);
		}

		$loop = new WP_Query( $args );


		if ( $loop->have_posts() ) {
			echo '<div>
<div id="fadeOverlay"></div>
<div class="lds-ring d-none" id="preloader">
    <div></div>
    <div></div>
    <div></div>
    <div></div>
</div>
<div class="listing-widget-wrapper"  id="listing-wrapper">';
			while ( $loop->have_posts() ) {
				$loop->the_post();
				$neighborhood = get_post_meta( get_the_ID(), '_neighborhood', true );
				$price = get_post_meta( get_the_ID(), '_price', true );
				$rooms = get_post_meta( get_the_ID(), '_rooms', true );
				$bathroom = get_post_meta( get_the_ID(), '_bathroom', true );
				$parking = get_post_meta( get_the_ID(), '_parking', true );
				?>
                <div class="card listing-widget-item">
                    <img src="<?php the_post_thumbnail_url();?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h4 class="mb-1 fs-xs fw-normal text-uppercase text-primary"><?php echo get_taxonomy_term_names(get_the_ID(), 'market')[0];?></h4>
                        <a href="<?php the_permalink();?>"><h5 class="card-title"><?php the_title();?></h5></a>
                        <p class="mb-2 fs-sm text-muted"><?php echo $neighborhood;?></p>
                        <div class="hp-listing__attributes hp-listing__attributes--primary">
                            <div class="fw-bold">
                                <i class="fi-cash mt-n1 me-2 lead align-middle opacity-70"></i>
                                $<?php echo $price;?>
                            </div>
                        </div>
                        <div class="card-footer mt-4 d-flex align-items-center justify-content-center mx-3 pt-3 text-nowrap hp-listing__attributes hp-listing__attributes--secondary">
                            <span class="d-inline-block mx-1 px-2 fs-sm"><?php echo $rooms;?>
                                <i class="finder-icon ms-1 mt-n1 fs-lg text-muted fi-bed"></i>
                            </span>
                            <span class="d-inline-block mx-1 px-2 fs-sm"><?php echo $bathroom;?>
                                <i class="finder-icon ms-1 mt-n1 fs-lg text-muted fi-bath"></i>
                            </span>
                            <?php if($parking == 'on'){
                                echo '
                                <span class="d-inline-block mx-1 px-2 fs-sm">
                                <i class="finder-icon ms-1 mt-n1 fs-lg text-muted fi-car"></i>
                            </span>
                                ';
                            }?>

                        </div>
                    </div>
                </div>
			<?php }
			echo '</div>';


		} else {
			echo '<p>No items found</p>';
		}
		wp_reset_postdata();
		echo '</div>';
	}

	protected function _content_template() {
		//$settings = $this->get_settings_for_display();
		?>
        <#
        var post_quantity = settings.post_quantity || 5; // Default value or fallback
        var show_filter = settings.show_filter || 'no'; // Default value or fallback

        if (show_filter === 'yes') {
        #>
		<?php include( __DIR__ . '/templates/preview/filter.php'); ?>
        <#
        }
        #>

        <div id="listing-container">
            <div id="fadeOverlay"></div>
            <div class="lds-ring d-none" id="preloader">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div class="listing-widget-wrapper" id="listing-wrapper">
            </div>
        </div>


		<?php
	}

	private function get_taxonomy_terms_options($taxonomy_slug) {
		$terms = get_terms([
			'taxonomy' => $taxonomy_slug,
			'hide_empty' => true,
		]);

		$options = ['' => __('All', 'your-plugin-textdomain')];

		if (!empty($terms) && !is_wp_error($terms)) {
			foreach ($terms as $term) {
				$options[$term->name] = $term->name;
			}
		}


		$options = array_merge(['' => __('All', 'your-plugin-textdomain')], $options);

		return $options;
	}
}



