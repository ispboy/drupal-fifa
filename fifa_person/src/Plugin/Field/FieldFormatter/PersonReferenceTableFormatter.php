<?php

namespace Drupal\fifa_person\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;

/**
 * Plugin implementation of the 'fifa_person_reference_table' formatter.
 *
 * @FieldFormatter(
 *   id = "fifa_person_reference_table",
 *   label = @Translation("Table"),
 *   field_types = {"fifa_person_reference"}
 * )
 */
class PersonReferenceTableFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $header[] = '#';
    $header[] = $this->t('Person', [], ['context' => 'fifa_person']);
    $header[] = $this->t('Number', [], ['context' => 'fifa_person']);

    $table = [
      '#type' => 'table',
      '#header' => $header,
    ];

    foreach ($items as $delta => $item) {

      $row = [];

      $row[]['#markup'] = $delta + 1;

      $row[] = $item->get('entity')->getTarget()->getValue()->toLink()->toRenderable();

      $row[]['#markup'] = $item->number;

      $table[$delta] = $row;
    }

    return [$table];
  }

}