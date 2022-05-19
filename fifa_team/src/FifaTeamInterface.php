<?php

namespace Drupal\fifa_team;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\user\EntityOwnerInterface;
use Drupal\Core\Entity\EntityChangedInterface;

/**
 * Provides an interface defining a team entity type.
 */
interface FifaTeamInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

  /**
   * Gets the team title.
   *
   * @return string
   *   Title of the team.
   */
  public function getTitle();

  /**
   * Sets the team title.
   *
   * @param string $title
   *   The team title.
   *
   * @return \Drupal\fifa_team\FifaTeamInterface
   *   The called team entity.
   */
  public function setTitle($title);

  /**
   * Gets the team creation timestamp.
   *
   * @return int
   *   Creation timestamp of the team.
   */
  public function getCreatedTime();

  /**
   * Sets the team creation timestamp.
   *
   * @param int $timestamp
   *   The team creation timestamp.
   *
   * @return \Drupal\fifa_team\FifaTeamInterface
   *   The called team entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the team status.
   *
   * @return bool
   *   TRUE if the team is enabled, FALSE otherwise.
   */
  public function isEnabled();

  /**
   * Sets the team status.
   *
   * @param bool $status
   *   TRUE to enable this team, FALSE to disable.
   *
   * @return \Drupal\fifa_team\FifaTeamInterface
   *   The called team entity.
   */
  public function setStatus($status);

}
