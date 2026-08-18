( function( blocks, element, serverSideRender, blockEditor, components ) {

	const el = element.createElement;
	const PlainText = blockEditor.PlainText;
	const BlockControls = blockEditor.BlockControls;
	const { Fragment } = element;
	const { RichText, InspectorControls } = blockEditor;
	const { TextControl, SelectControl, TextareaControl, ToggleControl, Panel, PanelBody, PanelRow } = components;
	const { __ } = window.wp.i18n;

	blocks.registerBlockType( 'total/testimonial-form', {
		title: __( 'Testimonial Form', 'testimonial-submission-form-for-total' ),
		icon: 'testimonial',
		category: 'total',
		keywords: [
			__( 'testimonials', 'testimonial-submission-form-for-total' )
		],
		attributes: {
			notification_email: {
				type: 'string'
			},
			notification_subject: {
				type: 'string'
			},
			notification_message: {
				type: 'string'
			},
			enable_recaptcha: {
				type: 'boolean',
				default: false,
			},
			enable_notifications: {
				type: 'boolean',
				default: true,
			},
			field_title: {
				type: 'boolean',
				default: true,
			},
			field_name: {
				type: 'boolean',
				default: true,
			},
			field_company: {
				type: 'boolean',
				default: true,
			},
			field_url: {
				type: 'boolean',
				default: true,
			},
			field_rating: {
				type: 'boolean',
				default: true,
			},
			field_content: {
				type: 'boolean',
				default: true,
			},
			rating_max: {
				type: 'integer',
				default: 5
			},
			content_rows: {
				type: 'integer',
				default: 4
			},
			content_cols: {
				type: 'integer',
				default: 40
			},
			label_title: {
				type: 'string'
			},
			label_name: {
				type: 'string'
			},
			label_company: {
				type: 'string'
			},
			label_url: {
				type: 'string'
			},
			label_rating: {
				type: 'string'
			},
			label_content: {
				type: 'string'
			},
			submit: {
				type: 'string'
			},
			success_message: {
				type: 'string'
			},
		},
		edit: function( props ) {

			return (
				el( Fragment, {},

					el( InspectorControls, {},

						/* General Settings */
						el( PanelBody, { title: __( 'General', 'testimonial-submission-form-for-total' ), initialOpen: true },

							el( PanelRow, {},
								el( ToggleControl,
									{
										label: __( 'Enable reCAPTCHA?', 'testimonial-submission-form-for-total' ),
										checked: props.attributes.enable_recaptcha,
										onChange: ( value ) => {
											props.setAttributes( { enable_recaptcha: value } );
										}
									}
								)
							),

							el( PanelRow, {},
								el( ToggleControl,
									{
										label: __( 'Display Title Field?', 'testimonial-submission-form-for-total' ),
										checked: props.attributes.field_title,
										onChange: ( value ) => {
											props.setAttributes( { field_title: value } );
										}
									}
								)
							),

							el( PanelRow, {},
								el( ToggleControl,
									{
										label: __( 'Display Name Field?', 'testimonial-submission-form-for-total' ),
										checked: props.attributes.field_name,
										onChange: ( value ) => {
											props.setAttributes( { field_name: value } );
										}
									}
								)
							),

							el( PanelRow, {},
								el( ToggleControl,
									{
										label: __( 'Display Company Field?', 'testimonial-submission-form-for-total' ),
										checked: props.attributes.field_company,
										onChange: ( value ) => {
											props.setAttributes( { field_company: value } );
										}
									}
								)
							),

							el( PanelRow, {},
								el( ToggleControl,
									{
										label: __( 'Display URL Field?', 'testimonial-submission-form-for-total' ),
										checked: props.attributes.field_url,
										onChange: ( value ) => {
											props.setAttributes( { field_url: value } );
										}
									}
								)
							),

							el( PanelRow, {},
								el( ToggleControl,
									{
										label: __( 'Display Rating Field?', 'testimonial-submission-form-for-total' ),
										checked: props.attributes.field_rating,
										onChange: ( value ) => {
											props.setAttributes( { field_rating: value } );
										}
									}
								)
							),

							el( PanelRow, {},
								el( ToggleControl,
									{
										label: __( 'Display Content Field?', 'testimonial-submission-form-for-total' ),
										checked: props.attributes.field_content,
										onChange: ( value ) => {
											props.setAttributes( { field_content: value } );
										}
									}
								)
							),

							el( PanelRow, {},
								el( TextControl,
									{
										label: __( 'Max Rating?', 'testimonial-submission-form-for-total' ),
										value: props.attributes.rating_max,
										type: 'number',
										onChange: ( value ) => {
											props.setAttributes( { rating_max: parseInt( value ) } );
										}
									}
								)
							),

						),

						/* Labels */
						el( PanelBody, { title: __( 'Labels', 'testimonial-submission-form-for-total' ), initialOpen: false },

							el( PanelRow, {},
								el( TextControl,
									{
										label: __( 'Review Title', 'testimonial-submission-form-for-total' ),
										value: props.attributes.label_title,
										onChange: ( value ) => {
											props.setAttributes( { label_title: value } );
										}
									}
								)
							),

							el( PanelRow, {},
								el( TextControl,
									{
										label: __( 'Your Name', 'testimonial-submission-form-for-total' ),
										value: props.attributes.label_name,
										onChange: ( value ) => {
											props.setAttributes( { label_name: value } );
										}
									}
								)
							),

							el( PanelRow, {},
								el( TextControl,
									{
										label: __( 'Your Company', 'testimonial-submission-form-for-total' ),
										value: props.attributes.label_company,
										onChange: ( value ) => {
											props.setAttributes( { label_company: value } );
										}
									}
								)
							),

							el( PanelRow, {},
								el( TextControl,
									{
										label: __( 'Your Website URL', 'testimonial-submission-form-for-total' ),
										value: props.attributes.label_url,
										onChange: ( value ) => {
											props.setAttributes( { label_url: value } );
										}
									}
								)
							),

							el( PanelRow, {},
								el( TextControl,
									{
										label: __( 'Rating', 'testimonial-submission-form-for-total' ),
										value: props.attributes.label_rating,
										onChange: ( value ) => {
											props.setAttributes( { label_rating: value } );
										}
									}
								)
							),

							el( PanelRow, {},
								el( TextControl,
									{
										label: __( 'Review', 'testimonial-submission-form-for-total' ),
										value: props.attributes.label_content,
										onChange: ( value ) => {
											props.setAttributes( { label_rating: value } );
										}
									}
								)
							),

							el( PanelRow, {},
								el( TextControl,
									{
										label: __( 'Submit', 'testimonial-submission-form-for-total' ),
										value: props.attributes.submit,
										onChange: ( value ) => {
											props.setAttributes( { submit: value } );
										}
									}
								)
							),

						),

						/* Notices */
						el( PanelBody, { title: __( 'Notification', 'testimonial-submission-form-for-total' ), initialOpen: false },

							el( PanelRow, {},
								el( ToggleControl,
									{
										label: __( 'Enable notifications?', 'testimonial-submission-form-for-total' ),
										checked: props.attributes.enable_notifications,
										onChange: ( value ) => {
											props.setAttributes( { enable_notifications: value } );
										}
									}
								)
							),

							el( PanelRow, {},
								el( TextControl,
									{
										label: __( 'Custom Notication Email', 'testimonial-submission-form-for-total' ),
										value: props.attributes.notification_email,
										onChange: ( value ) => {
											props.setAttributes( { notification_email: value } );
										}
									}
								)
							),

							el( PanelRow, {},
								el( TextControl,
									{
										label: __( 'Custom Notication Subject', 'testimonial-submission-form-for-total' ),
										value: props.attributes.notification_subject,
										onChange: ( value ) => {
											props.setAttributes( { notification_subject: value } );
										}
									}
								)
							),

							el( PanelRow, {},
								el( TextareaControl,
									{
										label: __( 'Custom Notication Message', 'testimonial-submission-form-for-total' ),
										value: props.attributes.notification_message,
										onChange: ( value ) => {
											props.setAttributes( { notification_message: value } );
										}
									}
								)
							),

						),

					),

					/** Render block **/
					el( serverSideRender, {
						block: 'total/testimonial-form',
						attributes: props.attributes,
					} ),

				)

			);

		},

		save: function( props ) {
			return null;
		},

	} );

} )( window.wp.blocks, window.wp.element, window.wp.serverSideRender, window.wp.blockEditor, window.wp.components );