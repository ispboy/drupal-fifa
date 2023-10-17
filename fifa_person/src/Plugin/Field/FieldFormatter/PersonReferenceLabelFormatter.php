<?php

namespace Drupal\fifa_person\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\Plugin\Field\FieldFormatter\EntityReferenceLabelFormatter;

/**
 * Plugin implementation of the 'fifa_person_reference_label' formatter.
 *
 * @FieldFormatter(
 *   id = "fifa_person_reference_label",
 *   label = @Translation("Label"),
 *   field_types = {"fifa_person_reference"}
 * )
 * 
 */
class PersonReferenceLabelFormatter extends EntityReferenceLabelFormatter {

}