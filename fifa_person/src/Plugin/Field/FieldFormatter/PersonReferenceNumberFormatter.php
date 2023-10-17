<?php

namespace Drupal\fifa_person\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;

/**
 * Plugin implementation of the 'fifa_person_reference_number' formatter.
 *
 * @FieldFormatter(
 *   id = "fifa_person_reference_number",
 *   label = @Translation("Number only"),
 *   field_types = {"fifa_person_reference"}
 * )
 */
class PersonReferenceNumberFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $element = [];
    foreach ($items as $delta => $item) {
      if ($item->number) {
        $element[$delta]['number'] = [
          // '#type' => 'item',
          '#title' => $this->t('Number', [], ['context' => 'fifa_person']),
          '#markup' => $item->number,
        ];
      }
    }
    return $element;
  }

}