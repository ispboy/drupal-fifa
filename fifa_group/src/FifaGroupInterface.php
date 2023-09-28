<?php

namespace Drupal\fifa_group;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\user\EntityOwnerInterface;
use Drupal\Core\Entity\EntityChangedInterface;

/**
 * Provides an interface defining a group entity type.
 */
interface FifaGroupInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

  /**
   * Gets the group title.
   *
   * @return string
   *   Title of the group.
   */
  public function getTitle();

  /**
   * Sets the group title.
   *
   * @param string $title
   *   The group title.
   *
   * @return \Drupal\fifa_group\FifaGroupInterface
   *   The called group entity.
   */
  public function setTitle($title);

  /**
   * Gets the group creation timestamp.
   *
   * @return int
   *   Creation timestamp of the group.
   */
  public function getCreatedTime();

  /**
   * Sets the group creation timestamp.
   *
   * @param int $timestamp
   *   The group creation timestamp.
   *
   * @return \Drupal\fifa_group\FifaGroupInterface
   *   The called group entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the group status.
   *
   * @return bool
   *   TRUE if the group is enabled, FALSE otherwise.
   */
  public function isEnabled();

  /**
   * Sets the group status.
   *
   * @param bool $status
   *   TRUE to enable this group, FALSE to disable.
   *
   * @return \Drupal\fifa_group\FifaGroupInterface
   *   The called group entity.
   */
  public function setStatus($status);

}
