<?php

namespace Drupal\fifa_tournament;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface defining a tournament entity type.
 */
interface FifaTournamentInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

}
