<?php
/*
 * Plugin Name: Testimonial Submission Form for Total
 * Description: Adds a new shortcode [testimonial_form] to allow visitors to submit testimonials via the front-end.
 * Version: 1.2
 * Author: WPExplorer
 * Author URI: https://www.wpexplorer.com/
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 * WC tested up to: 5.4.1
 *
 * Text Domain: testimonial-submission-form-for-total
 * Domain Path: /languages
 */

/**
 * Main Testimonial_Submission_Form_For_Total Class.
 */
if ( ! class_exists( 'Testimonial_Submission_Form_For_Total' ) ) {

	final class Testimonial_Submission_Form_For_Total {

		/**
		 * Testimonial_Submission_Form_For_Total constructor.
		 */
		public function __construct() {

			// Map to WPBakery.
			add_action( 'vc_after_mapping', __CLASS__ . '::vc_after_mapping', 50 );

			// Register Shortcode.
			add_shortcode( 'testimonial_form', __CLASS__ . '::display_form' );

			// Register Block.
			add_action( 'init', __CLASS__ . '::register_block' );
			add_action( 'enqueue_block_editor_assets', __CLASS__ . '::block_scripts' );

			// Register scripts
			add_action( 'wp_enqueue_scripts', __CLASS__ . '::register_scripts' );

		}

		/**
		 * VC functions.
		 */
		public static function vc_after_mapping() {
			vc_lean_map( 'testimonial_form', __CLASS__ . '::vc_map' );
		}

		/**
		 * Returns block attributes.
		 */
		public static function get_block_attributes() {
			return [
				'notification_email' => [
					'type' => 'string',
					'default' => ''
				],
				'notification_subject' => [
					'type' => 'string',
					'default' => ''
				],
				'notification_message' => [
					'type' => 'string',
					'default' => ''
				],
				'enable_recaptcha' => [
					'type' => 'boolean',
					'default' => false
				],
				'enable_notifications' => [
					'type' => 'boolean',
					'default' => true
				],
				'field_title' => [
					'type' => 'boolean',
					'default' => true
				],
				'field_name' => [
					'type' => 'boolean',
					'default' => true
				],
				'field_company' => [
					'type' => 'boolean',
					'default' => true
				],
				'field_url' => [
					'type' => 'boolean',
					'default' => true
				],
				'field_rating' => [
					'type' => 'boolean',
					'default' => true
				],
				'field_content' => [
					'type' => 'boolean',
					'default' => true
				],
				'rating_max' => [
					'type' => 'integer',
					'default' => 5
				],
				'content_rows' => [
					'type' => 'integer',
					'default' => 4
				],
				'content_cols' => [
					'type' => 'integer',
					'default' => 40
				],
				'label_title' => [
					'type' => 'string',
					'default' => esc_html__( 'Review Title', 'testimonial-submission-form-for-total' )
				],
				'label_name' => [
					'type' => 'string',
					'default' => esc_html__( 'Your Name', 'testimonial-submission-form-for-total' )
				],
				'label_company' => [
					'type' => 'string',
					'default' => esc_html__( 'Your Company', 'testimonial-submission-form-for-total' ),
				],
				'label_url' => [
					'type' => 'string',
					'default' => esc_html__( 'Your Website URL', 'testimonial-submission-form-for-total' ),
				],
				'label_rating' => [
					'type' => 'string',
					'default' => esc_html__( 'Rating', 'testimonial-submission-form-for-total' ),
				],
				'label_content' => [
					'type' => 'string',
					'default' => esc_html__( 'Review', 'testimonial-submission-form-for-total' ),
				],
				'submit' => [
					'type' => 'string',
					'default' => esc_html__( 'Submit', 'testimonial-submission-form-for-total' ),
				],
				'success_message' => [
					'type' => 'string',
					'default' => esc_html__( 'Your testimonial was submitted successfully.', 'testimonial-submission-form-for-total' ),
				],
			];
		}

		/**
		 * Map shortcode to VC.
		 */
		public static function vc_map() {
			return array(
				'name' => esc_html__( 'Testimonial Form', 'testimonial-submission-form-for-total' ),
				'description' => esc_html__( 'Front-end testimonial submission form.', 'testimonial-submission-form-for-total' ),
				'base' => 'testimonial_form',
				'category' => function_exists( 'vcex_shortcodes_branding' ) ? vcex_shortcodes_branding() : '',
				'icon' => 'vcex_element-icon vcex_element-icon--testimonial',
				'params' => array(
					array(
						'type' => 'vcex_ofswitch',
						'heading' => esc_html__( 'Enable reCAPTCHA?', 'testimonial-submission-form-for-total' ),
						'param_name' => 'enable_recaptcha',
						'std' => 'off',
						'vcex' => array(
							'on' => 'on',
							'off' => 'off'
						),
					),
					array(
						'type' => 'vcex_ofswitch',
						'heading' => esc_html__( 'Display Title Field?', 'testimonial-submission-form-for-total' ),
						'param_name' => 'field_title',
						'std' => 'on',
						'vcex' => array( 'on' => 'on', 'off' => 'off' )
					),
					array(
						'type' => 'vcex_ofswitch',
						'heading' => esc_html__( 'Display Name Field?', 'testimonial-submission-form-for-total' ),
						'param_name' => 'field_name',
						'std' => 'on',
						'vcex' => array( 'on' => 'on', 'off' => 'off' )
					),
					array(
						'type' => 'vcex_ofswitch',
						'heading' => esc_html__( 'Display Company Field?', 'testimonial-submission-form-for-total' ),
						'param_name' => 'field_company',
						'std' => 'on',
						'vcex' => array( 'on' => 'on', 'off' => 'off' )
					),
					array(
						'type' => 'vcex_ofswitch',
						'heading' => esc_html__( 'Display URL Field?', 'testimonial-submission-form-for-total' ),
						'param_name' => 'field_url',
						'std' => 'on',
						'vcex' => array( 'on' => 'on', 'off' => 'off' )
					),
					array(
						'type' => 'vcex_ofswitch',
						'heading' => esc_html__( 'Display Rating Field?', 'testimonial-submission-form-for-total' ),
						'param_name' => 'field_rating',
						'std' => 'on',
						'vcex' => array( 'on' => 'on', 'off' => 'off' )
					),
					array(
						'type' => 'vcex_ofswitch',
						'heading' => esc_html__( 'Display Content Field?', 'testimonial-submission-form-for-total' ),
						'param_name' => 'field_content',
						'std' => 'on',
						'vcex' => array( 'on' => 'on', 'off' => 'off' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Max Rating?', 'testimonial-submission-form-for-total' ),
						'param_name' => 'rating_max',
						'value' => '5',
					),
					// Labels
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Review Title', 'testimonial-submission-form-for-total' ),
						'param_name' => 'label_title',
						'group' =>  esc_html__( 'Labels', 'testimonial-submission-form-for-total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Your Name', 'testimonial-submission-form-for-total' ),
						'param_name' => 'label_name',
						'group' =>  esc_html__( 'Labels', 'testimonial-submission-form-for-total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Your Company', 'testimonial-submission-form-for-total' ),
						'param_name' => 'label_company',
						'group' =>  esc_html__( 'Labels', 'testimonial-submission-form-for-total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Your Website URL', 'testimonial-submission-form-for-total' ),
						'param_name' => 'label_url',
						'group' => esc_html__( 'Labels', 'testimonial-submission-form-for-total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Rating', 'testimonial-submission-form-for-total' ),
						'param_name' => 'label_rating',
						'group' => esc_html__( 'Labels', 'testimonial-submission-form-for-total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Review', 'testimonial-submission-form-for-total' ),
						'param_name' => 'label_content',
						'group' => esc_html__( 'Labels', 'testimonial-submission-form-for-total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Submit', 'testimonial-submission-form-for-total' ),
						'param_name' => 'submit',
						'group' => esc_html__( 'Labels', 'testimonial-submission-form-for-total' ),
					),
					// Notification.
					array(
						'type' => 'vcex_ofswitch',
						'heading' => esc_html__( 'Enable notifications?', 'testimonial-submission-form-for-total' ),
						'param_name' => 'enable_notifications',
						'std' => 'on',
						'vcex' => array( 'on' => 'on', 'off' => 'off' ),
						'description' => esc_html__( 'If enabled, an email notification will be sent to the admin whenever a new testimonial is submitted.', 'testimonial-submission-form-for-total' ),
						'group' => esc_html__( 'Notification', 'testimonial-submission-form-for-total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Custom Notication Email', 'testimonial-submission-form-for-total' ),
						'param_name' => 'notification_email',
						'description' => esc_html__( 'Enter a custom email address to use for notifications instead of the "Administration Email Address".', 'testimonial-submission-form-for-total' ),
						'group' => esc_html__( 'Notification', 'testimonial-submission-form-for-total' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Custom Notication Subject', 'testimonial-submission-form-for-total' ),
						'param_name' => 'notification_subject',
						'group' => esc_html__( 'Notification', 'testimonial-submission-form-for-total' ),
						'description' => esc_html__( 'Override the default notification subject.', 'testimonial-submission-form-for-total' ),
					),
					array(
						'type' => 'textarea',
						'heading' => esc_html__( 'Custom Notication Message', 'testimonial-submission-form-for-total' ),
						'param_name' => 'notification_message',
						'group' => esc_html__( 'Notification', 'testimonial-submission-form-for-total' ),
						'description' => esc_html__( 'Override the default notification message.', 'testimonial-submission-form-for-total' ),
					),
				)
			);
		}

		/**
		 * Register testimonial_form shortcode.
		 */
		public static function display_form( $atts ) {

			// Remove empty values from from $atts array.
			if ( ! empty( $atts ) && is_array( $atts ) ) {
				$atts = array_filter( $atts, __CLASS__ . '::filter_form_attributes_array' );
			}

			// Parse attributes.
			$atts = shortcode_atts( array(
				'className'            => '', //gutenberg extra classes.

				'notification_email'   => '',
				'notification_subject' => '',
				'notification_message' => '',

				'enable_recaptcha'     => 'off',
				'enable_notifications' => 'on',

				'field_title'          => 'on',
				'field_name'           => 'on',
				'field_company'        => 'on',
				'field_url'            => 'on',
				'field_rating'         => 'on',
				'field_content'        => 'on',

				'rating_max'           => 5,
				'content_rows'         => 4,
				'content_cols'         => 40,

				'label_title'          => esc_html__( 'Review Title', 'testimonial-submission-form-for-total' ),
				'label_name'           => esc_html__( 'Your Name', 'testimonial-submission-form-for-total' ),
				'label_company'        => esc_html__( 'Your Company', 'testimonial-submission-form-for-total' ),
				'label_url'            => esc_html__( 'Your Website URL', 'testimonial-submission-form-for-total' ),
				'label_rating'         => esc_html__( 'Rating', 'testimonial-submission-form-for-total' ),
				'label_content'        => esc_html__( 'Review', 'testimonial-submission-form-for-total' ),
				'submit'               => esc_html__( 'Submit', 'testimonial-submission-form-for-total' ),
				'success_message'      => esc_html__( 'Your testimonial was submitted successfully.', 'testimonial-submission-form-for-total' ),

			), $atts );

			if ( empty( $atts['notification_email'] ) ) {
				$atts['notification_email'] = get_bloginfo( 'admin_email' );
			}

			if ( empty( $atts['notification_subject'] ) ) {
				$atts['notification_subject'] = sprintf(
					esc_html__( 'New pending testimonial at %s.', 'testimonial-submission-form-for-total' ),
					esc_html( get_bloginfo( 'name' ) )
				);
			}

			if ( empty( $atts['notification_message'] ) ) {
				$atts['notification_message'] = sprintf(
					esc_html__( 'You have a new pending testimonial. <a href="%s">Manage Testimonials &rarr;</a>.', 'testimonial-submission-form-for-total' ),
					esc_url( admin_url( 'edit.php?post_type=testimonials' ) )
				);
			}

			$output = '';

				if ( 'on' === $atts['enable_recaptcha'] || true === $atts['enable_recaptcha'] ) {
					wp_enqueue_script( 'recaptcha' );
					ob_start();
						echo self::recaptcha();
					$output .= ob_get_clean();
				}

				$submission = self::submit_testimonial( $atts );
				$success = ( isset( $submission['status'] ) && 'success' === $submission['status'] );

				if ( ! empty( $submission['message'] ) ) {
					$output .= wp_kses_post( $submission['message'] );
				}

				if ( apply_filters( 'tsft_css', true ) ) {
					$output .= self::inline_css();
				}

				$form_class = '';
				if ( ! empty( $atts['className'] ) ) {
					$form_class = ' class="' . esc_attr( $atts['className'] ) . '"';
				}

				$output .= '<form method="post" id="tsft-form"' . $form_class . '>';

					// Title.
					if ( 'on' === $atts['field_title'] || true === $atts['field_title'] ) {
						$value = ( ! $success && isset( $_POST[ 'tsft_title' ] ) ) ? wp_strip_all_tags( $_POST[ 'tsft_title' ] ) : '';
						$output .= '<div class="tsft-form__field wpex-block wpex-mb-15">';
							$output .= '<span class="tsft-form__label wpex-font-semibold wpex-mb-5 wpex-block"><label for="tsft_title">' . esc_html( $atts['label_title'] ) . '</label></span>';
							$output .= '<span class="tsft-form__input wpex-block"><input type="text" name="tsft_title" id="tsft_title" value="' . esc_attr( $value ) . '" required></span>';
						$output .= '</div>';
					}

					// Name.
					if ( 'on' === $atts['field_name'] || true === $atts['field_name'] ) {
						$value = ( ! $success && isset( $_POST[ 'tsft_name' ] ) ) ? wp_strip_all_tags( $_POST[ 'tsft_name' ] ) : '';
						$output .= '<div class="tsft-form__field wpex-block wpex-mb-15">';
							$output .= '<span class="tsft-form__label wpex-font-semibold wpex-mb-5 wpex-block"><label for="tsft_name">' . esc_html( $atts['label_name'] ) . '</label></span>';
							$output .= '<span class="tsft-form__input wpex-block"><input type="text" name="tsft_name" id="tsft_name" value="' . esc_attr( $value ) . '" required></span>';
						$output .= '</div>';
					}

					// Company.
					if ( 'on' === $atts['field_company'] || true === $atts['field_company'] ) {
						$value = ( ! $success && isset( $_POST[ 'tsft_company' ] ) ) ? wp_strip_all_tags( $_POST[ 'tsft_company' ] ) : '';
						$output .= '<div class="tsft-form__field wpex-block wpex-mb-15">';
							$output .= '<span class="tsft-form__label wpex-font-semibold wpex-mb-5 wpex-block"><label for="tsft_company">' . esc_html( $atts['label_company'] ) . '</label></span>';
							$output .= '<span class="tsft-form__input wpex-block"><input type="text" name="tsft_company" value="' . esc_attr( $value ) . '" id="tsft_company"></span>';
						$output .= '</div>';
					}

					// URL.
					if ( 'on' === $atts['field_url'] || true === $atts['field_url'] ) {
						$value = ( ! $success && isset( $_POST[ 'tsft_url' ] ) ) ? wp_strip_all_tags( $_POST[ 'tsft_url' ] ) : '';
						$output .= '<div class="tsft-form__field wpex-block wpex-mb-15">';
							$output .= '<span class="tsft-form__label wpex-font-semibold wpex-mb-5 wpex-block"><label for="tsft_url">' . esc_html( $atts['label_url'] ) . '</label></span>';
							$output .= '<span class="tsft-form__input wpex-block"><input type="text" name="tsft_url" id="tsft_url" value="' . esc_attr( $value ) . '"></span>';
						$output .= '</div>';
					}

					// Rating.
					if ( 'on' === $atts['field_rating'] || true === $atts['field_rating'] ) {
						$value = ( ! $success && isset( $_POST[ 'tsft_rating' ] ) ) ? absint( $_POST[ 'tsft_rating' ] ) : '';
						if ( 0 === $value ) {
							$value = '';
						}
						$output .= '<div class="tsft-form__field wpex-block wpex-mb-15">';
							$output .= '<span class="tsft-form__label wpex-font-semibold wpex-mb-5 wpex-block"><label for="tsft_rating">' . esc_html( $atts['label_rating'] ) . '</label></span>';
							$output .= '<div class="tsft-form__select wpex-select-wrap"><select name="tsft_rating" id="tsft_rating">';
								$x = ! empty( $atts['rating_max'] ) ? absint( $atts['rating_max'] ) : 5;
								while ( $x > 0 ) {
									$output .= '<option value="' . esc_attr( $x ) .'" ' . selected( $value, $x, false ) . '>' . esc_html( $x ) .'</option>';
									$x--;
								}
							$output .= '</select></div>';
						$output .= '</div>';
					}

					// Review.
					if ( 'on' === $atts['field_content'] || true === $atts['field_content'] ) {
						$value = ( ! $success && isset( $_POST[ 'tsft_content' ] ) ) ? wp_strip_all_tags( $_POST[ 'tsft_content' ] ) : '';
						$required = apply_filters( 'tsft_post_content_required', true ) ? ' required' : '';
						$output .= '<div class="tsft-form__field wpex-block wpex-mb-15">';
							$output .= '<span class="tsft-form__label wpex-font-semibold wpex-mb-5 wpex-block"><label for="tsft_content">' . esc_html( $atts['label_content'] ) . '</label></span>';
							$output .= '<span class="tsft-form__textarea"><textarea type="text" name="tsft_content" id="tsft_content" rows="' . esc_attr( absint( $atts['content_rows'] ) ) . '" cols="' . esc_attr( absint( $atts['content_cols'] ) ) . '"' . esc_attr( $required ) . '>' . esc_html( $value ) . '</textarea></span>';
						$output .= '</div>';
					}

					// Security nonce.
					$output .= wp_nonce_field( 'tsft_nonce_action', 'tsft_nonce_field', true, false );

					// Submit.
					$output .= '<button type="submit" class="tsft-form__submit">' . esc_attr( $atts['submit'] ) . '</button>';

				$output .= '</form>';

			return $output;

		}

		/**
		 * Adds some CSS for the form.
		 */
		protected static function inline_css() {
			$css = '
				#tsft-form input, #tsft-form select, #tsft-form textarea { width: 100%; max-width: none; }
				#tsft-form input:invalid { box-shadow: none; }
			';
			if ( function_exists( 'wpex_minify_css' ) ) {
				return '<style>' . wpex_minify_css( $css ) . '</style>';
			} else {
				return '<style>' . $css . '</style>';
			}
		}

		/**
		 * Remove empty attributes but keep booleans.
		 */
		protected static function filter_form_attributes_array( $var ) {
			return $var !== '';
		}

		/**
		 * Save testmionial based on submission.
		 */
		protected static function submit_testimonial( $atts ) {

			// IMPORTANT SECURITY CHECK
			if ( empty( $_POST[ 'tsft_nonce_field' ] ) || ! wp_verify_nonce( $_POST[ 'tsft_nonce_field' ], 'tsft_nonce_action' ) ) {
				return;
			}

			if ( ! empty( $atts['enable_recaptcha'] ) && 'on' === $atts['enable_recaptcha'] ) {

				$captcha_check = self::captcha_check();

				if ( ! $captcha_check ) {
					return array(
						'status' => 'captcha-error',
						'message' => '<div class="tsft-form__error wpex-alert wpex-alert-error">' . esc_html__( 'Could not verify captcha.', 'testimonial-submission-form-for-total' ) . '</div>',
					);
				}

			}

			if ( apply_filters( 'tsft_post_content_required', true ) && empty( $_POST[ 'tsft_content' ] ) ) {
				return false;
			}

			$args = array(
				'post_title' => isset( $_POST[ 'tsft_title' ] ) ? trim( wp_strip_all_tags( $_POST[ 'tsft_title' ] ) ) : esc_html__( 'New Testimonial', 'testimonial-submission-form-for-total' ),
				'post_content' => wp_strip_all_tags( $_POST[ 'tsft_content' ] ),
				'post_status' => apply_filters( 'tsft_new_status', 'pending' ),
				'post_type' => 'testimonials',
			);

			$meta_input = array();

			if ( isset( $_POST[ 'tsft_name' ] ) ) {
				$meta_input[ 'wpex_testimonial_author' ] = trim( wp_strip_all_tags( $_POST[ 'tsft_name' ] ) );
			}

			if ( isset( $_POST[ 'tsft_company' ] ) ) {
				$meta_input[ 'wpex_testimonial_company' ] = trim( wp_strip_all_tags( $_POST[ 'tsft_company' ] ) );
			}

			if ( isset( $_POST[ 'tsft_url' ] ) ) {
				$meta_input[ 'wpex_testimonial_url' ] = trim( wp_strip_all_tags( $_POST[ 'tsft_url' ] ) );
			}

			if ( isset( $_POST[ 'tsft_rating' ] ) ) {
				$meta_input[ 'wpex_post_rating' ] = absint( $_POST[ 'tsft_rating' ] );
			}

			if ( $meta_input ) {
				$args[ 'meta_input' ] = $meta_input;
			}

			$post_id = wp_insert_post( $args );

			if ( ! is_wp_error( $post_id ) ) {

				self::send_notification( $atts );

				if ( ! empty( $atts[ 'success_message' ] ) ) {
					return array(
						'status' => 'success',
						'message' => '<div class="tsft-form__success wpex-alert wpex-alert-success">' . wp_strip_all_tags( $atts[ 'success_message' ] ) . '</div>',
					);
				}

			} else {
				return array(
					'status' => 'wp-error',
					'message' => '<div class="tsft-form__success wpex-alert wpex-alert-errpr">' . wp_strip_all_tags( $post_id->get_error_message() ) . '</div>',
				);
			}

		}

		/**
		 * Send notification email to admin.
		 */
		protected static function send_notification( $atts ) {
			if ( array_key_exists( 'enable_notifications', $atts ) && 'on' === $atts['enable_notifications'] ) {
				$mail_to = ! empty( $atts['notification_email'] ) ? sanitize_email( $atts['notification_email'] ) : '';
				$mail_subject = ! empty( $atts['notification_subject'] ) ? wp_strip_all_tags( $atts['notification_subject'] ) : '';
				$mail_message = ! empty( $atts['notification_message'] ) ? wp_kses_post( $atts['notification_message'] ) : '';
				if ( $mail_to && $mail_message ) {
					$mail_headers = array('Content-Type: text/html; charset=UTF-8');
					wp_mail( $mail_to, $mail_subject, $mail_message, $mail_headers );
				}
			}
		}

		/**
		 * Register a new block.
		 */
		public static function register_block() {

			if ( ! function_exists( 'register_block_type' ) ) {
				// Block editor is not available.
				return;
			}

			register_block_type( 'total/testimonial-form', array(
				'editor_script'   => [ 'total-testimonial-form-block' ],
				'render_callback' => __CLASS__ . '::display_form',
				'attributes'      => self::get_block_attributes(),
			) );

		}

		/**
		 * Register block scripts.
		 */
		public static function block_scripts() {

			wp_register_script(
				'total-testimonial-form-block',
				plugin_dir_url( __FILE__ ) . 'blocks/testimonial-form/block.min.js',
				[ 'wp-blocks', 'wp-element', 'wp-editor' ],
				filemtime( plugin_dir_path( __FILE__ ) . 'blocks/testimonial-form/block.min.js' )
			);

		}

		/**
		 * Register form scripts.
		 */
		public static function register_scripts() {

			if ( ! function_exists( 'wpex_get_recaptcha_keys' ) ) {
				return;
			}

			$site_key = wpex_get_recaptcha_keys( 'site' );

			if ( $site_key ) {
				wp_register_script(
					'recaptcha',
					esc_url( 'https://www.google.com/recaptcha/api.js?render=' . esc_attr( trim( $site_key ) ) )
				);
			}

		}

		/**
		 * Inline reCAPTCHA script.
		 */
		public static function recaptcha() {

			$site_key = '';

			if ( function_exists( 'wpex_get_recaptcha_keys' ) ) {
				$site_key = wpex_get_recaptcha_keys( 'site' );
			}

			if ( ! $site_key ) {
				return;
			}

			?>

			<script>
				( function( $ ) {
					'use strict';
						$( document ).ready( function() {
							var $form = $( '#tsft-form' );
							$form.submit( function( event ) {
								event.preventDefault();
								grecaptcha.ready(function() {
									grecaptcha.execute( '<?php echo esc_html( wp_strip_all_tags( $site_key ) ); ?>', {
										action: 'testimonial_form'
									} ).then( function( token ) {
										$form.prepend( '<input type="hidden" name="tsft_recaptcha-token" value="' + token + '">' );
									$form.unbind( 'submit' ).submit();
									} );
								} );
							} );
						} );
				} ) ( jQuery );
			</script>

		<?php }

		/**
		 * Register form scripts.
		 */
		public static function captcha_check() {

			if ( empty( $_POST['tsft_recaptcha-token'] ) ) {
				return false;
			}

			$keys = wpex_get_recaptcha_keys();

			if ( empty( $keys['secret'] ) ) {
				return false;
			}

			$recaptcha = wp_remote_get( 'https://www.google.com/recaptcha/api/siteverify?secret=' . esc_attr( trim( $keys['secret'] ) ) .'&response=' . esc_attr( $_POST['tsft_recaptcha-token'] ) );

			if ( empty( $recaptcha['body'] ) ) {
				return false; // 'reCAPTCHA keys are most likely incorrect.'
			} else {

				$recaptcha = json_decode( $recaptcha['body'], false );

				// This is a human.
				if ( true == $recaptcha->success
					&& 0.5 <= $recaptcha->score
					&& 'testimonial_form' === $recaptcha->action
				) {
					return true;
				}

				// Score less than 0.5 indicates suspicious activity. Return an error.
				else {
					return false;
				}

			}

		}

	}

	new Testimonial_Submission_Form_For_Total;

}