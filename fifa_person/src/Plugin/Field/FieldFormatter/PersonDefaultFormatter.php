<?php

namespace Drupal\fifa_person\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\Plugin\Field\FieldFormatter\EntityReferenceLabelFormatter;

/**
 * Plugin implementation of the 'fifa_person_person_default' formatter.
 *
 * @FieldFormatter(
 *   id = "fifa_person_person_default",
 *   label = @Translation("Default"),
 *   field_types = {"fifa_person_person"}
 * )
 */
class PersonDefaultFormatter extends EntityReferenceLabelFormatter {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = parent::viewElements($items, $langcode);
    $values = $items->getValue();

    foreach ($elements as $delta => $entity) {
      if (isset($values[$delta]['number'])) {
        $elements[$delta]['#suffix'] = ' ' . $values[$delta]['number']. '号';
      }
    }

    return $elements;
  }

}
