<?php

namespace Drupal\fifa_person;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\user\EntityOwnerInterface;
use Drupal\Core\Entity\EntityChangedInterface;

/**
 * Provides an interface defining a person entity type.
 */
interface FifaPersonInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

  /**
   * Gets the person title.
   *
   * @return string
   *   Title of the person.
   */
  public function getTitle();

  /**
   * Sets the person title.
   *
   * @param string $title
   *   The person title.
   *
   * @return \Drupal\fifa_person\FifaPersonInterface
   *   The called person entity.
   */
  public function setTitle($title);

  /**
   * Gets the person creation timestamp.
   *
   * @return int
   *   Creation timestamp of the person.
   */
  public function getCreatedTime();

  /**
   * Sets the person creation timestamp.
   *
   * @param int $timestamp
   *   The person creation timestamp.
   *
   * @return \Drupal\fifa_person\FifaPersonInterface
   *   The called person entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the person status.
   *
   * @return bool
   *   TRUE if the person is enabled, FALSE otherwise.
   */
  public function isEnabled();

  /**
   * Sets the person status.
   *
   * @param bool $status
   *   TRUE to enable this person, FALSE to disable.
   *
   * @return \Drupal\fifa_person\FifaPersonInterface
   *   The called person entity.
   */
  public function setStatus($status);

}
