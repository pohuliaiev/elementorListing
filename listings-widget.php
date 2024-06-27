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
			'heading',
			[
				'label' => __( 'Heading', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Hello World', 'plugin-name' ),
				'placeholder' => __( 'Type your heading here', 'plugin-name' ),
			]
		);

		$this->add_control(
			'color',
			[
				'label' => __( 'Text Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .custom-heading' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		echo '<h2 class="custom-heading" style="color: ' . esc_attr( $settings['color'] ) . ';">' . esc_html( $settings['heading'] ) . '</h2>';

		include( __DIR__ . '/templates/filter.php');

		$args = array(
			'post_type' => 'imoveis',
			'posts_per_page' => 4,
		);
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
		?>
        <#
        var settings = settings;
        #>
        <h2 class="custom-heading" style="color: {{ settings.color }};">{{{ settings.heading }}}</h2>

		<?php
	}
}



