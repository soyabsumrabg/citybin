<?php
/**
 * Contact Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.
$first_name        = !empty(get_field( 'first_name' )) ? get_field( 'first_name' ) : 'First Name';
$last_name         = get_field( 'last_name' );
$email             = get_field( 'email' );
$phone             = get_field( 'phone' );
$background_color  = get_field( 'background_color' ); // ACF's color picker.
$text_color        = get_field( 'text_color' ); // ACF's color picker.

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}
// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'contact';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}
if ( $background_color || $text_color ) {
    $class_name .= ' has-custom-acf-color';
}

// Build a valid style attribute for background and text colors.
$styles = array( 'background-color: ' . $background_color, 'color: ' . $text_color );
$style  = implode( '; ', $styles );
?>

<div <?php echo esc_attr( $anchor ); ?>class="<?php echo esc_attr( $class_name ); ?>" style="<?php echo esc_attr( $style ); ?>">
    <div class="contact__col">
        <p><b>First Name:</b> <?php echo esc_html( $first_name ); ?></p>
        <p><b>Last Name:</b> <?php echo esc_html( $last_name ); ?></p>
        <p><b>Email:</b> <?php echo esc_html( $email ); ?></p>
        <p><b>Contact No:</b> <?php echo esc_html( $phone ); ?></p>
    </div>
</div>
