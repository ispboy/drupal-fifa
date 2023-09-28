<?php

namespace Drupal\fifa_person\Plugin\Importer;

use Drupal\csv_importer\Plugin\ImporterBase;

/**
 * Class PersonImporter.
 *
 * @Importer(
 *   id = "person_content_importer",
 *   entity_type = "fifa_person",
 *   label = @Translation("Person content importer")
 * )
 */
class PersonImporter extends ImporterBase {}
