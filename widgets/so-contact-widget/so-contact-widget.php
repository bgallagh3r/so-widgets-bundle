<?php
/*
Widget Name: Contact Form
Description: A light weight contact form builder.
Author: SiteOrigin
Author URI: https://siteorigin.com
*/

class SiteOrigin_Widgets_ContactForm_Widget extends SiteOrigin_Widget {

	function __construct(){

		parent::__construct(
			'sow-contact-form',
			__('SiteOrigin Contact Form', 'siteorigin-widgets'),
			array(
				'description' => __( 'Create a simple contact form for your users to get hold of you.', 'siteorigin-widgets' ),
			),
			array(),
			array(
				'title' => array(
					'type' => 'text',
					'label' => __('Title', 'siteorigin-widgets'),
					'default' => __('Contact Us', 'siteorigin-widgets'),
				),

				'display_title' => array(
					'type' => 'checkbox',
					'label' => __('Display title', 'siteorigin-widgets'),
				),

				'settings' => array(
					'type' => 'section',
					'label' => __('Settings', 'siteorigin-widgets'),
					'hide' => true,
					'fields' => array(
						'to' => array(
							'type' => 'text',
							'label' => __('To email address', 'siteorigin-widgets'),
							'description' => __('Where contact emails will be delivered to.', 'siteorigin-widgets'),
							'sanitize' => 'email',
						),
						'default_subject' => array(
							'type' => 'text',
							'label' => __('Default subject', 'siteorigin-widgets'),
							'description' => __("Subject to use when there isn't one available.", 'siteorigin-widgets'),
						),
						'subject_prefix' => array(
							'type' => 'text',
							'label' => __('Subject prefix', 'siteorigin-widgets'),
							'description' => __('Prefix added to all incoming email subjects.', 'siteorigin-widgets'),
						),
						'success_message' => array(
							'type' => 'tinymce',
							'label' => __('Success message', 'siteorigin-widgets'),
							'description' => __('Message to display after message successfully sent.', 'siteorigin-widgets'),
							'default' => __("Thanks for contacting us. We'll get back to you shortly.", 'siteorigin-widgets')
						),
						'submit_text' => array(
							'type' => 'text',
							'label' => __('Submit button text', 'siteorigin-widgets'),
							'default' => __("Contact Us", 'siteorigin-widgets')
						)
					)
				),

				'fields' => array(

					'type' => 'repeater',
					'label' => __('Fields', 'siteorigin-widgets'),
					'item_name' => __('Field', 'siteorigin-widgets'),
					'item_label' => array(
						'selector'     => "[id*='label']",
					),
					'fields' => array(

						'type' => array(
							'type' => 'select',
							'label' => __( 'Field Type', 'siteorigin-widgets' ),
							'options' => array(
								'name' => __( 'Name', 'siteorigin-widgets' ),
								'email' => __( 'Email', 'siteorigin-widgets' ),
								'subject' => __( 'Subject', 'siteorigin-widgets' ),
								'text' => __( 'Text', 'siteorigin-widgets' ),
								'textarea' => __( 'Text Area', 'siteorigin-widgets' ),
								'select' => __( 'Dropdown Select', 'siteorigin-widgets' ),
								'checkboxes' => __( 'Checkboxes', 'siteorigin-widgets' ),
							),
							'state_emitter' => array(
								'callback' => 'select',
								'args' => array( 'field_type_{$repeater}' ),
							)
						),

						'label' => array(
							'type' => 'text',
							'label' => __('Label', 'siteorigin-widgets'),
						),

						'required' => array(
							'type' => 'section',
							'label' => __('Required Field', 'siteorigin-widgets'),
							'fields' => array(
								'required' => array(
									'type' => 'checkbox',
									'label' => __('Required field', 'siteorigin-widgets'),
									'description' => __('Is this field required?', 'siteorigin-widgets'),
								),
								'missing_message' => array(
									'type' => 'text',
									'label' => __('Missing message', 'siteorigin-widgets'),
									'description' => __('Error message to display if this field is missing.', 'siteorigin-widgets'),
								)
							)
						),

						// This are for select and checkboxes
						'options' => array(
							'type' => 'repeater',
							'label' => __( 'Options', 'siteorigin-widgets' ),
							'item_name' => __( 'Option', 'siteorigin-widgets' ),
							'item_label' => array( 'selector' => "[id*='value']" ),
							'fields' => array(
								'value' => array(
									'type' => 'text',
									'label' => __( 'Value', 'siteorigin-widgets' ),
								),
							),

							// These are only required for a few states
							'state_handler' => array(
								'field_type_{$repeater}[select,checkboxes]' => array('show'),
								'_else[field_type_{$repeater}]' => array( 'hide' ),
							),
						),
					),
				),

				'spam' => array(
					'type' => 'section',
					'label' => __( 'Spam Protection', 'siteorigin-widgets' ),
					'hide' => true,
					'fields' => array(


						'recaptcha' => array(
							'type' => 'section',
							'label' => __('Recaptcha', 'siteorigin-widgets'),
							'fields' => array(
								'use_captcha' => array(
									'type' => 'checkbox',
									'label' => __( 'Use Captcha', 'siteorigin-widgets' ),
									'default' => false,
								),
								'site_key' => array(
									'type' => 'text',
									'label' => __( 'ReCaptcha Site Key', 'siteorigin-widgets' ),
								),
								'secret_key' => array(
									'type' => 'text',
									'label' => __( 'ReCaptcha Secret Key', 'siteorigin-widgets' ),
								),
							)
						),

						'akismet' => array(
							'type' => 'section',
							'label' => __('akismet', 'siteorigin-widgets'),
							'fields' => array(
								'use_akismet'=> array(
									'type' => 'checkbox',
									'label' => __( 'Use Akismet filtering', 'siteorigin-widgets' ),
									'default' => true,
								),
								'spam_action'=> array(
									'type' => 'select',
									'label' => __( 'Spam action', 'siteorigin-widgets' ),
									'options' => array(
										'error' => __('Show error message', 'siteorigin-widgets'),
										'tag' => __('Tag as spam in subject', 'siteorigin-widgets'),
									),
									'description' => __('How to handle submissions that are identified as spam.', 'siteorigin-widgets'),
									'default' => 'error',
								),
							)
						),
					)
				),

				'design' => array(
					'type' => 'section',
					'label' => __('Design', 'siteorigin-widgets'),
					'hide' => true,
					'fields' => array(

						'container' => array(
							'type' => 'section',
							'label' => __('Container', 'siteorigin-widgets'),
							'fields' => array(
								'background' => array(
									'type' => 'color',
									'label' => __('Background color', 'siteorigin-widgets'),
									'default' => '#f2f2f2',
								),
								'padding' => array(
									'type' => 'slider',
									'label' => __('Padding', 'siteorigin-widgets'),
									'default' => 10,
									'max' => 100,
									'min' => 0
								),
								'border_color' => array(
									'type' => 'color',
									'label' => __('Border color', 'siteorigin-widgets'),
									'default' => '#c0c0c0',
								),
								'border_width' => array(
									'type' => 'slider',
									'label' => __('Border width', 'siteorigin-widgets'),
									'default' => 1,
									'max' => 10,
									'min' => 0
								),
								'border_style' => array(
									'type' => 'select',
									'label' => __('Border style', 'siteorigin-widgets'),
									'default' => 'solid',
									'options' => array(
										'none' => __( 'None', 'siteorigin-widgets' ),
										'hidden' => __( 'Hidden', 'siteorigin-widgets' ),
										'dotted' => __( 'Dotted', 'siteorigin-widgets' ),
										'dashed' => __( 'Dashed', 'siteorigin-widgets' ),
										'solid' => __( 'Solid', 'siteorigin-widgets' ),
										'double' => __( 'Double', 'siteorigin-widgets' ),
										'groove' => __( 'Groove', 'siteorigin-widgets' ),
										'ridge' => __( 'Ridge', 'siteorigin-widgets' ),
										'inset' => __( 'Inset', 'siteorigin-widgets' ),
										'outset' => __( 'Outset', 'siteorigin-widgets' ),
									)
								),
							)
						),

						'errors' => array(
							'type' => 'section',
							'label' => __('Error messages', 'siteorigin-widgets'),
							'fields' => array(
								'background' => array(
									'type' => 'color',
									'label' => __('Error background color', 'siteorigin-widgets'),
									'default' => '#fce4e5',
								),
								'border_color' => array(
									'type' => 'color',
									'label' => __('Error background color', 'siteorigin-widgets'),
									'default' => '#ec666a',
								),
								'text_color' => array(
									'type' => 'color',
									'label' => __('Error text color', 'siteorigin-widgets'),
									'default' => '#ec666a',
								),
								'padding' => array(
									'type' => 'slider',
									'label' => __('Error padding', 'siteorigin-widgets'),
									'default' => 5,
								),
								'margin' => array(
									'type' => 'slider',
									'label' => __('Error margin', 'siteorigin-widgets'),
									'default' => 10,
								),
							)
						),

						'submit' => array(
							'type' => 'section',
							'label' => __('Submit button', 'siteorigin-widgets'),
							'fields' => array(
								'styled' => array(
									'type' => 'checkbox',
									'label' => __('Style submit button', 'siteorigin-widgets'),
									'description' => __('Style the button or leave it with default theme styling.', 'siteorigin-widgets'),
									'default' => true,
								),

								'background_color' => array(
									'type' => 'color',
									'label' => __('Background color', 'siteorigin-widgets'),
									'default' => '#eeeeee',
								),
								'background_gradient' => array(
									'type' => 'slider',
									'label' => __('Gradient intensity', 'siteorigin-widgets'),
									'default' => 10,
								),
								'border_color' => array(
									'type' => 'color',
									'label' => __('Background color', 'siteorigin-widgets'),
									'default' => '#989a9c',
								),
								'border_style' => array(
									'type' => 'select',
									'label' => __('Border style', 'siteorigin-widgets'),
									'default' => 'solid',
									'options' => array(
										'none' => __('None', 'siteorigin-widgets'),
										'solid' => __('Solid', 'siteorigin-widgets'),
									)
								),
								'border_radius' => array(
									'type' => 'slider',
									'label' => __('Border rounding', 'siteorigin-widgets'),
									'default' => 3,
									'max' => 50,
									'min' => 0
								),
								'text_color' => array(
									'type' => 'color',
									'label' => __('Text color', 'siteorigin-widgets'),
									'default' => '#5a5a5a',
								),
								'weight' => array(
									'type' => 'select',
									'label' => __('Font weight', 'siteorigin-widgets'),
									'default' => '500',
									'options' => array(
										'normal' => __('Normal', 'siteorigin-widgets'),
										'500' => __('Semi-bold', 'siteorigin-widgets'),
										'bold' => __('Bold', 'siteorigin-widgets'),
									)
								),
								'padding' => array(
									'type' => 'slider',
									'label' => __('Padding', 'siteorigin-widgets'),
									'default' => 10,
									'max' => 50,
									'min' => 0
								),
							)
						),

					)
				)
			)
		);
	}

	/**
	 * Initialize the contact form widget
	 */
	function initialize(){

	}

	function modify_instance( $instance ){
		// Use this to set up an initial version of the
		if( empty($instance['settings']['to']) ) {
			$current_user = wp_get_current_user();
			$instance['settings']['to'] = $current_user->user_email;
		}
		if( empty($instance['fields']) ) {
			$instance['fields'] = array(
				array(
					'type' => 'name',
					'label' => __('Your Name', 'siteorigin-widgets'),
					'required' => array(
						'required' => true,
						'missing_message' => __('Please enter your name', 'siteorigin-widgets'),
					),
				),
				array(
					'type' => 'email',
					'label' => __('Your Email', 'siteorigin-widgets'),
					'required' => array(
						'required' => true,
						'missing_message' => __('Please enter a valid email address', 'siteorigin-widgets'),
					),
				),
				array(
					'type' => 'subject',
					'label' => __('Subject', 'siteorigin-widgets'),
					'required' => array(
						'required' => true,
						'missing_message' => __('Please enter a subject', 'siteorigin-widgets'),
					),
				),
				array(
					'type' => 'textarea',
					'label' => __('Message', 'siteorigin-widgets'),
					'required' => array(
						'required' => true,
						'missing_message' => __('Please write something', 'siteorigin-widgets'),
					),
				),
			);
		}

		return $instance;
	}

	function get_template_variables( $instance, $args ) {
		$vars = array();

		unset($instance['title']);
		unset($instance['display_title']);
		unset($instance['design']);
		unset($instance['panels_data']);

		$vars['instance_hash'] = md5( serialize( $instance) );
		return $vars;
	}

	function get_less_variables( $instance ){
		$vars = array(
			// All the container variables.
			'container_background' => $instance['design']['container']['background'],
			'container_padding' => $instance['design']['container']['padding'] . 'px',
			'container_border_color' => $instance['design']['container']['border_color'],
			'container_border_width' => $instance['design']['container']['border_width'] . 'px',
			'container_border_style' => $instance['design']['container']['border_style'],

			// The error message styles
			'error_background' => $instance['design']['errors']['background'],
			'error_border' => $instance['design']['errors']['border_color'],
			'error_text' => $instance['design']['errors']['text_color'],
			'error_padding' => $instance['design']['errors']['padding'] . 'px',
			'error_margin' => $instance['design']['errors']['margin'] . 'px',

			// The submit button
			'submit_background_color' => $instance['design']['submit']['background_color'],
			'submit_background_gradient' => $instance['design']['submit']['background_gradient'] . '%',
			'submit_border_color' => $instance['design']['submit']['border_color'],
			'submit_border_style' => $instance['design']['submit']['border_style'],
			'submit_border_radius' => $instance['design']['submit']['border_radius'] . 'px',
			'submit_text_color' => $instance['design']['submit']['text_color'],
			'submit_weight' => $instance['design']['submit']['weight'],
			'submit_padding' => $instance['design']['submit']['padding'] . 'px',
		);

		return $vars;
	}

	static function name_from_label( $label, & $ids ){
		$it = 0;

		$label = str_replace( ' ', '-', strtolower( $label ) );
		$label = sanitize_html_class( $label );
		do {
			$id = $label . ( $it > 0 ? '-' . $it : '' );
			$it++;
		} while( !empty($ids[$id]) );
		$ids[$id] = true;

		return $id;
	}

	/**
	 * Render the form fields
	 *
	 * @param $fields
	 * @param $errors
	 */
	function render_form_fields( $fields, $errors = array() ){

		$field_ids = array();

		foreach( $fields as $i => $field ) {
			if( empty( $field['type'] ) ) continue;

			$field_name = $this->name_from_label( !empty($field['label']) ? $field['label'] : $i, $field_ids );
			$field_id = 'sow-contact-form-field-' . $field_name;

			$value = '';
			if( !empty($_POST[$field_name]) ) {
				$value = stripslashes_deep( $_POST[$field_name] );
			}

			?><div class="sow-form-field sow-form-field-<?php echo sanitize_html_class( $field['type'] ) ?>"><?php
			if( !empty($field['label']) ) {
				?><label for="<?php echo esc_attr( $field_id ) ?>"><strong><?php echo esc_html( $field['label'] ) ?></strong></label> <?php
			}

			if( !empty($errors[$field_name]) ) {
				?>
				<div class="sow-error">
					<?php echo wp_kses_post( $errors[$field_name] ) ?>
				</div>
				<?php
			}

			switch( $field['type'] ) {
				case 'email':
				case 'text':
					echo '<input type="' . $field['type'] . '" name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" value="' . esc_attr($value) . '" class="sow-text-field" />';
					break;

				case 'select':
					echo '<select  name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '">';
					if( !empty($field['options']) ) {
						foreach( $field['options'] as $option ) {
							echo '<option value="' . esc_attr( $option['value'] ) . '" ' . selected( $option['value'], $value, false ) . '>' . esc_html($option['value']) . '</option>';
						}
					}
					echo '</select>';
					break;

				case 'checkboxes':
					if( !empty($field['options']) ) {
						if( empty($value) || !is_array( $value ) ) {
							$value = array();
						}

						echo '<ul>';
						foreach ( $field['options'] as $i => $option ) {
							echo '<li>';
							echo '<label>';
							echo '<input type="checkbox" value="' . esc_attr($option['value']) . '" name="' . esc_attr( $field_name ) . '[]" id="' . esc_attr( $field_id ) . '-' . $i . '" ' . checked( in_array($option['value'], $value) , true, false) . ' /> ';
							echo esc_html( $option['value'] );
							echo '</li>';
						}
						echo '</ul>';
					}
					break;

				case 'textarea':
					echo '<textarea name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" rows="10">' . esc_textarea($value) . '</textarea>';
					break;

				case 'subject':
				case 'name':
				default:
					echo '<input type="text" name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '"  value="' . esc_attr($value) . '"  class="sow-text-field" />';
					break;

			}

			?></div><?php
		}
	}

	/**
	 * Ajax action handler to send the form
	 */
	function contact_form_action( $instance, $storage_hash ){
		if( empty($_POST['instance_hash']) || $_POST['instance_hash'] != $storage_hash ) return false;
		if( empty($instance['fields']) ) {
			array(
				'status' => null,
			);
		}

		$errors = array();
		$email_fields = array();
		$post_vars = stripslashes_deep( $_POST );

		$field_ids = array();
		foreach( $instance['fields'] as $i => $field ) {
			if( empty( $field['type'] ) ) continue;
			$field_name = $this->name_from_label( !empty($field['label']) ? $field['label'] : $i, $field_ids );
			$value = !empty( $post_vars[$field_name] ) ? $post_vars[$field_name] : '';

			if( $field['required']['required'] && empty($value) ) {
				$errors[$field_name] = !empty($field['required']['missing_message']) ? $field['required']['missing_message'] : __('Required field', 'siteorigin-widgets');
				continue;
			}

			switch( $field['type'] ) {
				case 'email':
					if( $value != sanitize_email($value) ) {
						$errors[$field_name] = __('Invalid email address.', 'siteorigin-widgets');
					}
					break;
			}

			if( in_array( $field['type'], array( 'email', 'name', 'subject' ) ) ) {
				$email_fields[$field['type']] = $value;
			}
			else {
				if( empty($email_fields['message']) ) $email_fields['message'] = array();

				switch( $field['type'] ) {
					case 'checkboxes':
						$email_fields['message'][] = array(
							'label' => $field['label'],
							'value' => implode(', ', $value),
						);
						break;

					default:
						$email_fields['message'][] = array(
							'label' => $field['label'],
							'value' => $value,
						);
						break;
				}
			}
		}

		// Add in the default subject and subject prefix
		if( empty($email_fields['subject']) && !empty($instance['settings']['default_subject']) ) {
			$email_fields['subject'] = $instance['settings']['default_subject'];
		}
		if( !empty($instance['settings']['subject_prefix']) ) {
			$email_fields['subject'] = $instance['settings']['subject_prefix'] . ' ' . $email_fields['subject'];
		}

		// Now we do some email message validation
		if( empty($errors) ) {
			$email_errors = $this->validate_mail( $email_fields );
			if( !empty($email_errors) ) {
				$errors['_general'] = $email_errors;
			}
		}

		// And if we get this far, do some spam filtering and Captcha checking
		if( empty($errors) ) {
			$spam_errors = $this->spam_check( $post_vars, $email_fields, $instance );
			if( !empty($spam_errors) ) {
				// Now we can decide how we want to handle this spam status
				if( !empty($spam_errors['akismet']) && $instance['spam']['akismet']['spam_action'] == 'tag' ) {
					unset($spam_errors['akismet']);
					$email_fields['subject'] = '[spam] ' . $email_fields['subject'];
				}
			}

			if( !empty($spam_errors) ) {
				$errors['_general'] = $spam_errors;
			}
		}

		if( empty($errors) ) {
			// We can send the email
			if( !$this->send_mail( $email_fields, $instance ) ) {
				$errors['_general']['send'] = __('Error sending email, please try again later.', 'siteorigin-widgets');
			}
		}

		return array(
			'status' => empty($errors) ? 'success' : 'fail',
			'errors' => $errors
		);
	}

	/**
	 * Validate fields of an email message
	 */
	function validate_mail( $email_fields ){
		$errors = array();
		if( empty($email_fields['email']) ) {
			$errors['email'] = __('A valid email is required', 'siteorigin-widgets');
		}
		elseif( function_exists('filter_var') && !filter_var($email_fields['email'], FILTER_VALIDATE_EMAIL) ) {
			$errors['email'] = __('The email address is invalid', 'siteorigin-widgets');
		}

		if( empty($email_fields['subject']) ) {
			$errors['subject'] = __('Missing subject', 'siteorigin-widgets');
		}

		return $errors;
	}

	/**
	 * Check the email for spam
	 *
	 * @param $email_fields
	 * @param $instance
	 *
	 * @return array
	 */
	function spam_check( $post_vars, $email_fields, $instance ){
		$errors = array();

		if( $instance['spam']['recaptcha']['use_captcha'] ) {
			$result = wp_remote_post(
				'https://www.google.com/recaptcha/api/siteverify',
				array(
					'body' => array(
						'secret' => $instance['spam']['recaptcha']['secret_key'],
						'response' => $post_vars['g-recaptcha-response'],
						'remoteip' => isset( $_SERVER['REMOTE_ADDR'] ) ? $_SERVER['REMOTE_ADDR'] : null,
					)
				)
			);

			if( !is_wp_error($result) && !empty($result['body']) ) {
				$result = json_decode( $result['body'], true );
				if( isset($result['success']) && !$result['success'] ) {
					$errors['recaptcha'] = __('Error validating your Captcha response.', 'siteorigin-widgets');
				}
			}
		}

		if( $instance['spam']['akismet']['use_akismet'] && class_exists( 'Akismet' ) ) {
			$comment = array();

			$message_text = array();
			foreach($email_fields['message'] as $m) {
				$message_text[] = $m['value'];
			}

			$comment['comment_text'] = $email_fields['subject'] . "\n\n" . implode("\n\n", $message_text);
			$comment['comment_author'] = !empty($email_fields['name']) ? $email_fields['name'] : '';
			$comment['comment_author_email'] = $email_fields['email'];
			$comment['comment_post_ID'] = get_the_ID();

			$comment['comment_type'] = 'contact-form';

			$comment['user_ip'] = isset( $_SERVER['REMOTE_ADDR'] ) ? $_SERVER['REMOTE_ADDR'] : null;
			$comment['user_agent'] = isset( $_SERVER['HTTP_USER_AGENT'] ) ? $_SERVER['HTTP_USER_AGENT'] : null;
			$comment['referrer'] = isset( $_SERVER['HTTP_REFERER'] ) ? $_SERVER['HTTP_REFERER'] : null;
			$comment['blog'] = get_option('home');
			$comment['blog_lang'] = get_locale();
			$comment['blog_charset'] = get_option('blog_charset');

			// Pretend to check with Akismet
			$response = Akismet::http_post( Akismet::build_query( $comment ), 'comment-check' );
			$is_spam = !empty($response[1]) && $response[1] == 'true';

			if( $is_spam ) {
				$errors['akismet'] = __('Unfortunately our system identified your message as spam.', 'siteorigin-widgets');
			}
		}

		return $errors;
	}

	function send_mail( $email_fields, $instance ){
		$body = '<strong>From:</strong> ' . $email_fields['name'] . ' <' . sanitize_email( $email_fields['email'] ) . ">\n\n";
		foreach( $email_fields['message'] as $m ) {
			$body .= '<strong>' . $m['label'] . ':</strong>';
			$body .= "\n";
			$body .= $m['value'];
			$body .= "\n\n";
		}
		$body = wpautop( trim($body) );

		$headers = array(
			'Content-Type: text/html; charset=UTF-8',
			'From: ' . $email_fields['name'] . ' <' . sanitize_email( $email_fields['email'] ) . '>'
		);

		return wp_mail( $instance['settings']['to'], $email_fields['subject'], $body, $headers );
	}

}
siteorigin_widget_register( 'sow-contact-form', __FILE__, 'SiteOrigin_Widgets_ContactForm_Widget' );