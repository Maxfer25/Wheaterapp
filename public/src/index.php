<?php

class My_Custom_Widget extends WP_Widget {

// Main constructor
public function __construct() {
    parent::__construct(
        'my_custom_widget',
        __( 'My Custom Widget', 'text_domain' ),
        array(
            'customize_selective_refresh' => true,
        )
    );
}

// The widget form (for the backend )
public function form( $instance ) {

    // Set widget defaults
    $defaults = array(
        'title'    => '',
        'text'     => '',
        'textarea' => '',
        'checkbox' => '',
        'select'   => '',
    );
    
    // Parse current settings with defaults
    extract( wp_parse_args( ( array ) $instance, $defaults ) ); ?>

    <?php // Widget Title ?>
    <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Widget Title', 'text_domain' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
    </p>

    <?php // Text Field ?>
    <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"><?php _e( 'Text:', 'text_domain' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>" type="text" value="<?php echo esc_attr( $text ); ?>" />
    </p>

    <?php // Textarea Field ?>
    <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'textarea' ) ); ?>"><?php _e( 'Textarea:', 'text_domain' ); ?></label>
        <textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'textarea' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'textarea' ) ); ?>"><?php echo wp_kses_post( $textarea ); ?></textarea>
    </p>

    <?php // Checkbox ?>
    <p>
        <input id="<?php echo esc_attr( $this->get_field_id( 'checkbox' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'checkbox' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $checkbox ); ?> />
        <label for="<?php echo esc_attr( $this->get_field_id( 'checkbox' ) ); ?>"><?php _e( 'Checkbox', 'text_domain' ); ?></label>
    </p>

    <?php // Dropdown ?>
    <p>
        <label for="<?php echo $this->get_field_id( 'select' ); ?>"><?php _e( 'Select', 'text_domain' ); ?></label>
        <select name="<?php echo $this->get_field_name( 'select' ); ?>" id="<?php echo $this->get_field_id( 'select' ); ?>" class="widefat">
        <?php
        // Your options array
        $options = array(
            ''        => __( 'Select', 'text_domain' ),
            'option_1' => __( 'Option 1', 'text_domain' ),
            'option_2' => __( 'Option 2', 'text_domain' ),
            'option_3' => __( 'Option 3', 'text_domain' ),
        );

        // Loop through options and add each one to the select dropdown
        foreach ( $options as $key => $name ) {
            echo '<option value="' . esc_attr( $key ) . '" id="' . esc_attr( $key ) . '" '. selected( $select, $key, false ) . '>'. $name . '</option>';

        } ?>
        </select>
    </p>

<?php }

// Update widget settings
public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['title']    = isset( $new_instance['title'] ) ? wp_strip_all_tags( $new_instance['title'] ) : '';
    $instance['text']     = isset( $new_instance['text'] ) ? wp_strip_all_tags( $new_instance['text'] ) : '';
    $instance['textarea'] = isset( $new_instance['textarea'] ) ? wp_kses_post( $new_instance['textarea'] ) : '';
    $instance['checkbox'] = isset( $new_instance['checkbox'] ) ? 1 : false;
    $instance['select']   = isset( $new_instance['select'] ) ? wp_strip_all_tags( $new_instance['select'] ) : '';
    return $instance;
}

// Display the widget
public function widget( $args, $instance ) {

    extract( $args );

    // Check the widget options
    $title    = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';
    $text     = isset( $instance['text'] ) ? $instance['text'] : '';
    $textarea = isset( $instance['textarea'] ) ?$instance['textarea'] : '';
    $select   = isset( $instance['select'] ) ? $instance['select'] : '';
    $checkbox = ! empty( $instance['checkbox'] ) ? $instance['checkbox'] : false;

    // WordPress core before_widget hook (always include )
    echo $before_widget;

    // Display the widget
?>

    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/cerulean/bootstrap.min.css" integrity="sha384-3fdgwJw17Bi87e1QQ4fsLn4rUFqWw//KU0g8TvV6quvahISRewev6/EocKNuJmEw" crossorigin="anonymous">
    <title>Weather</title>
</head>
<body>
    
    <div class="container p-4">
        <div class="row">
            <div class="col-m-4 mx-auto text-center">
                <div class="card">
                    <div class="card-body">
                        <h1 id="weather-location" class="h3"></h1>
                        <h3 id="weather-description" class="h4"></h3>
                        <h3 id="weather-string"></h3>
                        <ul class="list-group mt-3">
                            <li id="weather-humidity" class="list-group-item"></li>
                            <li id="weather-wind" class="list-group-item"></li>
                        </ul>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form action="" id="w-form">
                            <div class="form-group">
                                <input type="text" id="city" class="form-control" placeholder="Ciudad" autofocus>
                            </div>
                            <div class="form-group">
                                <input type="text" id="countryCode" class="form-control" placeholder="Codigo del país">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-dark btn-block" id="w-change-btn">
                                    Guardar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php
    // WordPress core after_widget hook (always include )
    echo $after_widget;

}

}

// Register the widget
function my_register_custom_widget() {
register_widget( 'My_Custom_Widget' );
}
add_action( 'widgets_init', 'my_register_custom_widget' );
