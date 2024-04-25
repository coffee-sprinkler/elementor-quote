<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor Quote of the Day Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Elementor_Quote_Widget extends \Elementor\Widget_Base {

  public function get_name() {
		return 'quote';
	}

  public function get_title() {
		return esc_html__( 'Quote of the Day', 'elementor-quote-widget' );
	}

  public function get_icon() {
		return 'eicon-blockquote';
	}

  public function get_categories() {
		return [ 'general' ];
	}

  public function get_keywords() {
		return [ 'quote', 'day' ];
	}

  public function get_custom_help_url() {
		return 'https://github.com/coffee-sprinkler/elementor-quote-widget/readme.MD';
	}

  protected function register_controls() {

    $this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'elementor-quote-widget' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

    $this->add_control(
        'selected_quotes',
        [
            'label' => esc_html__( 'Select Quote', 'elementor-quote-widget' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'multiple' => false,
            'options' => $this->get_dynamic_options(),
            'label_block' => true
        ]
    );

    $this->add_control(
			'text_align',
			[
				'label' => esc_html__( 'Alignment', 'elementor-quote-widget' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'elementor-quote-widget' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'elementor-quote-widget' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'elementor-quote-widget' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'left',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
			]
		);

    $this->end_controls_section();

    $this->start_controls_section(
			'style_section',
			[
				'label' => esc_html__( 'Styles', 'elementor-quote-widget' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

    $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}}',
			]
		);

    $this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Text Color', 'elementor-quote-widget' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} q' => 'color: {{VALUE}}',
				],
        'separator' => 'after'
			]
		);

    $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'quote_typography',
				'selector' => '{{WRAPPER}} q',
			]
		);

    $this->end_controls_section();

    $this->start_controls_section(
			'dimension_section',
			[
				'label' => esc_html__( 'Dimensions', 'elementor-quote-widget' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

    $this->add_control(
			'margin',
			[
				'label' => esc_html__( 'Margin', 'elementor-quote-widget' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 0,
					'left' => 0,
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
        'separator' => 'before'
			]
		);

    $this->add_control(
			'border_style',
			[
				'label' => esc_html__( 'Border Style', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__( 'Default', 'textdomain' ),
					'none' => esc_html__( 'None', 'textdomain' ),
					'solid'  => esc_html__( 'Solid', 'textdomain' ),
					'dashed' => esc_html__( 'Dashed', 'textdomain' ),
					'dotted' => esc_html__( 'Dotted', 'textdomain' ),
					'double' => esc_html__( 'Double', 'textdomain' ),
				],
				'selectors' => [
					'{{WRAPPER}}' => 'border-style: {{VALUE}};',
				],
			]
		);

    $this->add_control(
			'padding',
			[
				'label' => esc_html__( 'Padding', 'elementor-quote-widget' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 0,
					'left' => 0,
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

    $this->add_control(
			'border-radius',
			[
				'label' => esc_html__( 'Border Radius', 'elementor-quote-widget' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 0,
					'left' => 0,
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}}' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

    $this->end_controls_section();

	}

  protected function render() {
    $settings = $this->get_settings_for_display();

    if ( empty( $settings['selected_quotes'] ) ) {
      return;
    } 

    $quote = $settings['selected_quotes'];

    ?>
    <div class="elementor-quote-widget">
      <q><?= $quote ?></q>
    </div>
    <?php 
  }

  protected function content_template() {
    ?>
    <#
    view.addRenderAttribute( 'quote', 'class', 'elementor-quote-widget' );
    view.addInlineEditingAttributes( 'quote' );
    #>
    <div {{{ view.getRenderAttributeString( 'quote' ) }}}>
        <q>{{{ settings.selected_quotes }}}</q>
    </div>
    <?php
  }


  private function get_dynamic_options() {
    $quotes = $this->get_limited_quotes(); // Fetch quotes from your JSON file
    $options = [];

    foreach ($quotes as $quote) { 
      $full_quote = sprintf('%s - %s', $quote['quote'], $quote['author']);
      $options[$full_quote] = $full_quote; // Use full quote as both key and value
    }

    return $options;
  }

  private function get_limited_quotes() {
    // Read quotes from JSON file
    $json_file = plugin_dir_path(__FILE__) . 'quotes.json';

    if (file_exists($json_file)) {
        $quotes_json = file_get_contents($json_file);
        $quotes_data = json_decode($quotes_json, true);

        if (is_array($quotes_data) && isset($quotes_data['quotes'])) {
            $quotes = $quotes_data['quotes'];

            $limited_quotes = array_slice($quotes, 0, 5); // Limit to 5 quotes

            return $limited_quotes;
        }
    }

    return [];
  }
}