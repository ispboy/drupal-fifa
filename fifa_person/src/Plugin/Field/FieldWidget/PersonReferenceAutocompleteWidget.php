<?php

namespace Drupal\fifa_person\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\Plugin\Field\FieldWidget\EntityReferenceAutocompleteWidget;
use Drupal\Core\Form\FormStateInterface;

/**
 * Defines the 'fifa_person_reference_autocomplete' field widget.
 *
 * @FieldWidget(
 *   id = "fifa_person_reference_autocomplete",
 *   label = @Translation("Autocomplete"),
 *   description = @Translation("An autocomplete text field."),
 *   field_types = {"fifa_person_reference"},
 * )
 */
class PersonReferenceAutocompleteWidget extends EntityReferenceAutocompleteWidget {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $widget = parent::formElement($items, $delta, $element, $form, $form_state);

    $widget['number'] = array(
      '#title' => $this->t('Number', [], ['context' => 'fifa_person']),
      '#type' => 'number',
      '#default_value' => isset($items[$delta]->number) ? $items[$delta]->number : NULL,
      '#min' => 0,
      '#size' => 6,
      '#weight' => 999, //the parent elements' weight is increment.
    );

    return $widget;
  }

  /**
   * {@inheritdoc}
   */
  public function massageFormValues(array $values, array $form, FormStateInterface $form_state) {
    $values = parent::massageFormValues($values, $form, $form_state);
    foreach ($values as $delta => $value) {
      if ($value['number'] === '') {
        $values[$delta]['number'] = NULL;
      }
    }
    return $values;
  }

}