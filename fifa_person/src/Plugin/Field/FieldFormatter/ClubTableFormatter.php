<?php

namespace Drupal\fifa_person\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;

/**
 * Plugin implementation of the 'fifa_person_club_table' formatter.
 *
 * @FieldFormatter(
 *   id = "fifa_person_club_table",
 *   label = @Translation("Table"),
 *   field_types = {"fifa_person_club"}
 * )
 */
class ClubTableFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {

    $header[] = '#';
    $header[] = $this->t('Club');
    $header[] = $this->t('Number');

    $table = [
      '#type' => 'table',
      '#header' => $header,
    ];

    foreach ($items as $delta => $item) {
      $row = [];

      $row[]['#markup'] = $delta + 1;

      $row[]['#markup'] = $item->club;

      $row[]['#markup'] = $item->number;

      $table[$delta] = $row;
    }

    return [$table];
  }

}
