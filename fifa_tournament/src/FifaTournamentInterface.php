<?php

namespace Drupal\fifa_tournament;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\user\EntityOwnerInterface;
use Drupal\Core\Entity\EntityChangedInterface;

/**
 * Provides an interface defining a tournament entity type.
 */
interface FifaTournamentInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

  /**
   * Gets the tournament title.
   *
   * @return string
   *   Title of the tournament.
   */
  public function getTitle();

  /**
   * Sets the tournament title.
   *
   * @param string $title
   *   The tournament title.
   *
   * @return \Drupal\fifa_tournament\FifaTournamentInterface
   *   The called tournament entity.
   */
  public function setTitle($title);

  /**
   * Gets the tournament creation timestamp.
   *
   * @return int
   *   Creation timestamp of the tournament.
   */
  public function getCreatedTime();

  /**
   * Sets the tournament creation timestamp.
   *
   * @param int $timestamp
   *   The tournament creation timestamp.
   *
   * @return \Drupal\fifa_tournament\FifaTournamentInterface
   *   The called tournament entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the tournament status.
   *
   * @return bool
   *   TRUE if the tournament is enabled, FALSE otherwise.
   */
  public function isEnabled();

  /**
   * Sets the tournament status.
   *
   * @param bool $status
   *   TRUE to enable this tournament, FALSE to disable.
   *
   * @return \Drupal\fifa_tournament\FifaTournamentInterface
   *   The called tournament entity.
   */
  public function setStatus($status);

}
