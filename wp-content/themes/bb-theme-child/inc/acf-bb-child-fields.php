<?php

/*
 * Registers and loads multiple ACF fields
 *
 * This function hooks into 'acf/include_fields' to define Advanced Custom Fields (ACF) entirely via code, rather than using the ACF plugin UI
 * 
 * Important:
 * - These fields are hardcoded and will not appear in the ACF plugin admin interface
 * - Any changes to the field definitions must be done in this function
 * - Ensures the 'acf_add_local_field_group' function exists before adding fields
 *
 * @return void
 */

add_action( 'acf/include_fields', function() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
	'key' => 'group_6900da20b2f48',
	'title' => 'Page Settings',
	'fields' => array(
		array(
			'key' => 'field_6900da21faefe',
			'label' => 'Alternative Title',
			'name' => 'page_settings_alt_title',
			'aria-label' => '',
			'type' => 'text',
			'instructions' => 'This will replace the page title that appears in the hero section. Max. 50 characters.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'maxlength' => 50,
			'allow_in_bindings' => 0,
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
		),
		array(
			'key' => 'field_6900da81077e2',
			'label' => 'Summary',
			'name' => 'page_settings_blurb',
			'aria-label' => '',
			'type' => 'text',
			'instructions' => 'A short page summary displayed below the title in the hero section. Max. 220 characters.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'maxlength' => 220,
			'allow_in_bindings' => 0,
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
		),
		array(
			'key' => 'field_6900dac9077e3',
			'label' => 'Primary Button Text',
			'name' => 'page_settings_button_text',
			'aria-label' => '',
			'type' => 'text',
			'instructions' => 'Max. 25 characters.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'maxlength' => 25,
			'allow_in_bindings' => 0,
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
		),
		array(
			'key' => 'field_6900dc9a077e5',
			'label' => 'Primary Button Link',
			'name' => 'page_settings_button_link',
			'aria-label' => '',
			'type' => 'link',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_6900dac9077e3',
						'operator' => '!=empty',
					),
				),
			),
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'array',
			'allow_in_bindings' => 0,
		),
		array(
			'key' => 'field_6900db22077e4',
			'label' => 'Secondary Button Text',
			'name' => 'page_settings_button_text_2',
			'aria-label' => '',
			'type' => 'text',
			'instructions' => 'Max. 25 characters.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'maxlength' => 25,
			'allow_in_bindings' => 0,
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
		),
		array(
			'key' => 'field_6900dd89077e6',
			'label' => 'Secondary Button Link',
			'name' => 'page_settings_button_link_2',
			'aria-label' => '',
			'type' => 'link',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_6900db22077e4',
						'operator' => '!=empty',
					),
				),
			),
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'array',
			'allow_in_bindings' => 0,
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'post',
			),
		),
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'page',
			),
		),
	),
	'menu_order' => 1,
	'position' => 'acf_after_title',
	'style' => 'seamless',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
	'show_in_rest' => 0,
	'display_title' => '',
) );

	acf_add_local_field_group( array(
	'key' => 'group_6900df71add40',
	'title' => 'Background Shape',
	'fields' => array(
		array(
			'key' => 'field_6900df72cefad',
			'label' => 'Show Background Shape',
			'name' => 'show_background_shape',
			'aria-label' => '',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => 'Check this box to show the background shape.',
			'default_value' => 0,
			'allow_in_bindings' => 0,
			'ui' => 0,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),
		array(
			'key' => 'field_6900e10fe88ef',
			'label' => 'Start Percentage',
			'name' => 'background_shape_start',
			'aria-label' => '',
			'type' => 'range',
			'instructions' => 'Percentage of the page where the shape starts.',
			'required' => 1,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_6900df72cefad',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'min' => 0,
			'max' => 100,
			'allow_in_bindings' => 0,
			'step' => 1,
			'prepend' => '',
			'append' => '%',
		),
		array(
			'key' => 'field_6900e133e88f0',
			'label' => 'End Percentage',
			'name' => 'background_shape_end',
			'aria-label' => '',
			'type' => 'range',
			'instructions' => 'Percentage of the page where the shape ends.',
			'required' => 1,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_6900df72cefad',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'min' => 0,
			'max' => 100,
			'allow_in_bindings' => 0,
			'step' => 1,
			'prepend' => '',
			'append' => '%',
		),
		array(
			'key' => 'field_6900e2eb2a5a4',
			'label' => 'Top Shape',
			'name' => 'background_shape_top',
			'aria-label' => '',
			'type' => 'select',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_6900df72cefad',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'slanted' => 'Slanted',
				'arrow' => 'Arrow',
				'arrow-inverted' => 'Arrow (Inverted)',
				'concave' => 'Concave',
				'concave-inverted' => 'Concave (Inverted)',
				'curve' => 'Curve',
				'curve-2' => 'Curve 2',
				'wave' => 'Wave',
				'wave-2' => 'Wave 2',
				'wave-3' => 'Wave 3',
			),
			'default_value' => false,
			'return_format' => 'array',
			'multiple' => 0,
			'allow_null' => 1,
			'allow_in_bindings' => 0,
			'ui' => 0,
			'ajax' => 0,
			'placeholder' => '',
			'create_options' => 0,
			'save_options' => 0,
		),
		array(
			'key' => 'field_6900e3952a5a5',
			'label' => 'Bottom Shape',
			'name' => 'background_shape_bottom',
			'aria-label' => '',
			'type' => 'select',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_6900df72cefad',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'slanted' => 'Slanted',
				'arrow' => 'Arrow',
				'arrow-inverted' => 'Arrow (Inverted)',
				'concave' => 'Concave',
				'concave-inverted' => 'Concave (Inverted)',
				'curve' => 'Curve',
				'curve-2' => 'Curve 2',
				'wave' => 'Wave',
				'wave-2' => 'Wave 2',
				'wave-3' => 'Wave 3',
			),
			'default_value' => false,
			'return_format' => 'array',
			'multiple' => 0,
			'allow_null' => 1,
			'allow_in_bindings' => 0,
			'ui' => 0,
			'ajax' => 0,
			'placeholder' => '',
			'create_options' => 0,
			'save_options' => 0,
		),
		array(
			'key' => 'field_6900e281c68f1',
			'label' => 'Flip Horizontally',
			'name' => 'background_shape_flip',
			'aria-label' => '',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_6900df72cefad',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => 'Check this box to flip the background shape horizontally.',
			'default_value' => 0,
			'allow_in_bindings' => 0,
			'ui' => 0,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'post',
			),
		),
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'page',
			),
		),
	),
	'menu_order' => 2,
	'position' => 'acf_after_title',
	'style' => 'seamless',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
	'show_in_rest' => 0,
	'display_title' => '',
) );
} );