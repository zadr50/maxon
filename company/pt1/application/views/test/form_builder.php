<?
$this->load->helper('form');
$this->load->library('form_builder');
echo  $this->form_builder->open_form(array('action' => '')); 

//* Prepare variables */
$defaults_object_or_array_from_db = NULL;

$item = new stdClass;
$item->id = 33;
$item->description = '';

$years = range(intval(date('Y')), intval(date('Y')) + 20);
$months = array_map(function ($n) {
	return str_pad($n, 2, '0', STR_PAD_LEFT);
}, range(1, 12));

$exp_month_options = array_combine($months, $months);
$cc_exp_month = '05';

$exp_year_options = array_combine($years, $years);
$cc_exp_year = intval(date('Y')) + 5;

$input_span = 'pull-left ';

/* Build form */
echo $this->form_builder->build_form_horizontal(
		array(
				array(/* HIDDEN */
						'id' => 'id',
						'type' => 'hidden',
						'value' => $item->id
				),
				array(/* INPUT */
						'id' => 'color',
						'placeholder' => 'Item Color',
						'input_addons' => array(
								'pre' => 'color: #',
								'post' => ';'
						),
						'help' => 'this is a help block'
				),
				array(/* DROP DOWN */
						'id' => 'published',
						'type' => 'dropdown',
						'options' => array(
								'1' => 'Published',
								'2' => 'Disabled'
						)
				),
				array(/* TEXTAREA */
						'id' => 'description',
						'type' => 'textarea',
						'class' => 'wysihtml5',
						'placeholder' => 'Item Description (HTML or rich text)',
						'value' => html_entity_decode($item->description)
				),
				array(/* COMBINE */
						'id' => 'expiration_date',
						'type' => 'combine', /* use `combine` to put several input inside the same block */
						'elements' => array(
								array(
										'id' => 'cc_exp_month',
										'label' => 'Expiration Date',
										'autocomplete' => 'cc-exp-month',
										'type' => 'dropdown',
										'options' => $exp_month_options,
										'class' => $input_span . 'required input-small',
										'required' => '',
										'data-items' => '4',
										'pattern' => '\d{1,2}',
										'style' => 'width: auto;',
										'value' => (isset($cc_exp_month) ? $cc_exp_month : '')
								),
								array(
										'id' => 'cc_exp_year',
										'label' => 'Expiration Date',
										'autocomplete' => 'cc-exp-year',
										'type' => 'dropdown',
										'options' => $exp_year_options,
										'class' => $input_span . 'required input-small',
										'required' => '',
										'data-items' => '4',
										'pattern' => '\d{4}',
										'style' => 'width: auto; margin-left: 5px;',
										'value' => (isset($cc_exp_year) ? $cc_exp_year : '')
								)
						)
				),
				array(/* DATE */
						'id' => 'date',
						'type' => 'date'
				),
				array(/* CHECKBOX */
						'id' => 'checkbox_group',
						'label' => 'Checkboxes',
						'type' => 'checkbox',
						'options' => array(
								array(
										'id' => 'checkbox1',
										'value' => 1
										// If no label is set, the value will be used
								),
								array(
										'id' => 'checkbox2',
										'value' => 2,
										'label' => 'Two'
								)
						)
				),
				array(/* RADIO */
						'id' => 'radio_group',
						'label' => 'Radio buttons',
						'type' => 'radio',
						'options' => array(
								array(
										'id' => 'radio_button_yes',
										'value' => 1,
										'label' => 'Yes'
								),
								array(
										'id' => 'radio_button_no',
										'value' => 0,
										'label' => 'No'
								)
						)
				),
				array(/* SUBMIT */
						'id' => 'submit',
						'type' => 'submit'
				)
		), $defaults_object_or_array_from_db);

echo $this->form_builder->close_form();
?>


<?= $this->form_builder->close_form(); ?>
