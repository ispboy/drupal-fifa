<?php

namespace Drupal\fifa_person\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\Plugin\Field\FieldWidget\EntityReferenceAutocompleteWidget;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\Validator\ConstraintViolationInterface;

/**
 * Defines the 'fifa_person_club' field widget.
 *
 * @FieldWidget(
 *   id = "fifa_person_club",
 *   label = @Translation("Club for Person"),
 *   field_types = {"fifa_person_club"},
 * )
 */
class ClubWidget extends EntityReferenceAutocompleteWidget {

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
      '#weight' => 10,
    );

    return $widget;
  }

  /**
   * {@inheritdoc}
   */
  public function massageFormValues(array $values, array $form, FormStateInterface $form_state) {
    foreach ($values as $delta => $value) {
      if ($value['number'] === '') {
        $values[$delta]['number'] = NULL;
      }
    }
    return $values;
  }

}
