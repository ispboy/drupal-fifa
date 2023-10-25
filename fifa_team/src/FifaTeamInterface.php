<?php

namespace Drupal\fifa_team;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface defining a team entity type.
 */
interface FifaTeamInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

}
