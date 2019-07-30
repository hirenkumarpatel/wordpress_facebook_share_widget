<?php

/**
 * Adds Facebookshare_Widget widget.
 */
class Facebookshare_Widget extends WP_Widget {

	/**
	 * Register Facebook share widget with WordPress.
	 */
	function __construct() {
		
		parent::__construct(
			'facebookshare_widget', // Base ID
			esc_html__( 'Facebook Share', 'fb_domain' ), // Title of the widget displayed in adminpanel
			array( 'description' => esc_html__( 'Add Facebook Share widget', 'fb_domain' ), ) // Args description
		);
	}

	/**
	 * Front-end display of Facebook Share widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget']; // you can use anything to display before widget ex. <div>
		
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		
		/**
		 * retriving url of the post
		 */
		global $post;
		$url=get_the_permalink($post->ID);
		$url=esc_url($url);

		/**widget content - the actual output of widget */
		  echo '<div id="fb-root"></div>
		  <div class="fb-share-button" 
		  data-href="'.$url.'" 
		  data-layout="'.$instance['layout'].'" 
		  data-size="'.$instance['size'].'">
		  <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u='.$url.'&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a>
		  </div>';
		
		echo $args['after_widget']; // you can use anything to display after widget ex. </div>
	}

	/**
	 * Back-end Facebook Share widget form.
	 * widget form that we can see in admin panel->appearance->widget 
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		/** Title of the widget in adminpanel */
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Facebook Share', 'fb_domain' );

		/**Size of button to be shown */
		$size = ! empty( $instance['size'] ) ? $instance['size'] : esc_html__( 'large', 'fb_domain' );
		
		/**layout name to be shown (default/full)*/
		$layout = ! empty( $instance['layout'] ) ? $instance['layout'] : esc_html__( 'button_count', 'fb_domain' );
		
		?>

		<!-- html for Title -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'fb_domain' ); ?></label> 
			<input 
			class="widefat" 
			id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" 
			name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" 
			type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		
		<!-- html for  button size -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>"><?php esc_attr_e( 'Widget Size:', 'fb_domain' ); ?></label> 
			<select 
			class="widefat" 
			id="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>" 
			name="<?php echo esc_attr( $this->get_field_name( 'size' ) ); ?>" >
			<option value="large" <?php echo ($size=='large') ? 'selected' : '' ?>>Large</option>
			<option value="small" <?php echo ($size=='small') ? 'selected' : '' ?>>Small</option>
			</select>
		</p>

		<!-- html for layout of subscribe button-->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>"><?php esc_attr_e( 'Layout:', 'fb_domain' ); ?></label> 
			<select 
			class="widefat" 
			id="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>" 
			name="<?php echo esc_attr( $this->get_field_name( 'layout' ) ); ?>" >
			<option value="box_count" <?php echo ($layout=='box_count') ? 'selected' : '' ?>>Box Count</option>
			<option value="button_count" <?php echo ($layout=='button_count') ? 'selected' : '' ?>>Button Count</option>
			<option value="button" <?php echo ($layout=='button') ? 'selected' : '' ?>>Button</option>
			
			</select>
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		/** title to be changed when changed in widget area backend */
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		
		/** size to be changed when changed in widget area backend */
		$instance['size'] = ( ! empty( $new_instance['size'] ) ) ? sanitize_text_field( $new_instance['size'] ) : '';
		
		
		/** layout to be changed when changed in widget area backend */
		$instance['layout'] = ( ! empty( $new_instance['layout'] ) ) ? sanitize_text_field( $new_instance['layout'] ) : '';

		return $instance;
	}

} 
/** 
 * class Youtubesubscribe_Widget
 * next is to register this class to main widget file*/ 