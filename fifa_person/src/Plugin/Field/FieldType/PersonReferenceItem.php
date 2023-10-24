<?php

namespace Drupal\fifa_person\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\Plugin\Field\FieldType\EntityReferenceItem;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;
use Drupal\Core\StringTranslation\TranslatableMarkup;

/**
 * Defines the 'fifa_person_reference' field type.
 *
 * @FieldType(
 *   id = "fifa_person_reference",
 *   label = @Translation("Person reference"),
 *   description = @Translation("An entity field containing an person reference with sub fields."),
 *   category = @Translation("Reference"),
 *   default_widget = "fifa_person_reference_autocomplete",
 *   default_formatter = "fifa_person_reference_label",
 *   list_class = "\Drupal\Core\Field\EntityReferenceFieldItemList",
 * )
 */
class PersonReferenceItem extends EntityReferenceItem {

  /**
   * {@inheritdoc}
   */
  public static function defaultStorageSettings() {
    return [
      'target_type' => 'fifa_person',
    ] + parent::defaultStorageSettings();
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties = parent::propertyDefinitions($field_definition);
    $number_definition = DataDefinition::create('integer')
      ->setLabel(new TranslatableMarkup('Number'))
      ->setRequired(FALSE);
    $properties['number'] = $number_definition;
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
    // reset it! otherwise,
    // entityreference will Add all the commonly referenced entity types as distinct pre-configured
    // options. 
  }

}