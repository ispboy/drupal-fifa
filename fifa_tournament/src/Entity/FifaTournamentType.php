<?php

namespace Drupal\fifa_tournament\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Tournament type configuration entity.
 *
 * @ConfigEntityType(
 *   id = "fifa_tournament_type",
 *   label = @Translation("Tournament type"),
 *   handlers = {
 *     "form" = {
 *       "add" = "Drupal\fifa_tournament\Form\FifaTournamentTypeForm",
 *       "edit" = "Drupal\fifa_tournament\Form\FifaTournamentTypeForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm",
 *     },
 *     "list_builder" = "Drupal\fifa_tournament\FifaTournamentTypeListBuilder",
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     }
 *   },
 *   admin_permission = "administer tournament types",
 *   bundle_of = "fifa_tournament",
 *   config_prefix = "fifa_tournament_type",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "add-form" = "/admin/structure/fifa_tournament_types/add",
 *     "edit-form" = "/admin/structure/fifa_tournament_types/manage/{fifa_tournament_type}",
 *     "delete-form" = "/admin/structure/fifa_tournament_types/manage/{fifa_tournament_type}/delete",
 *     "collection" = "/admin/structure/fifa_tournament_types"
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "uuid",
 *   }
 * )
 */
class FifaTournamentType extends ConfigEntityBundleBase {

  /**
   * The machine name of this tournament type.
   *
   * @var string
   */
  protected $id;

  /**
   * The human-readable name of the tournament type.
   *
   * @var string
   */
  protected $label;

}
