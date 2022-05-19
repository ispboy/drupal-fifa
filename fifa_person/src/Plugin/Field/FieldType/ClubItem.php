<?php

namespace Drupal\fifa_person\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\Plugin\Field\FieldType\EntityReferenceItem;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;
use Drupal\Core\StringTranslation\TranslatableMarkup;

/**
 * Defines the 'fifa_person_club' field type.
 *
 * @FieldType(
 *   id = "fifa_person_club",
 *   label = @Translation("Club for Person"),
 *   description = @Translation("A field containing Club reference with a Number."),
 *   category = @Translation("Reference"),
 *   default_widget = "entity_reference_autocomplete",
 *   default_formatter = "entity_reference_label",
 *   list_class = "\Drupal\Core\Field\EntityReferenceFieldItemList",
 * )
 */
class ClubItem extends EntityReferenceItem {

  /**
   * {@inheritdoc}
   */
  public static function defaultStorageSettings() {
    return [
      'target_type' => \Drupal::moduleHandler()
        ->moduleExists('fifa_club') ? 'fifa_club' : NULL,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties = parent::propertyDefinitions($field_definition);
    $quantity_definition = DataDefinition::create('integer')
      ->setLabel(new TranslatableMarkup('Number'))
      ->setRequired(FALSE);
    $properties['number'] = $quantity_definition;
    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {

    $schema = parent::schema($field_definition);
    $schema['columns']['number'] = array(
      'type' => 'int',
      'size' => 'small',
      'unsigned' => TRUE,
    );

    return $schema;
  }

  /**
   * {@inheritdoc}
   */
  public static function getPreconfiguredOptions() {
    return [];
  }

}
