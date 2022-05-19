<?php

namespace Drupal\fifa_match;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\user\EntityOwnerInterface;
use Drupal\Core\Entity\EntityChangedInterface;

/**
 * Provides an interface defining a match entity type.
 */
interface FifaMatchInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

  /**
   * Gets the match title.
   *
   * @return string
   *   Title of the match.
   */
  public function getTitle();

  /**
   * Sets the match title.
   *
   * @param string $title
   *   The match title.
   *
   * @return \Drupal\fifa_match\FifaMatchInterface
   *   The called match entity.
   */
  public function setTitle($title);

  /**
   * Gets the match creation timestamp.
   *
   * @return int
   *   Creation timestamp of the match.
   */
  public function getCreatedTime();

  /**
   * Sets the match creation timestamp.
   *
   * @param int $timestamp
   *   The match creation timestamp.
   *
   * @return \Drupal\fifa_match\FifaMatchInterface
   *   The called match entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the match status.
   *
   * @return bool
   *   TRUE if the match is enabled, FALSE otherwise.
   */
  public function isEnabled();

  /**
   * Sets the match status.
   *
   * @param bool $status
   *   TRUE to enable this match, FALSE to disable.
   *
   * @return \Drupal\fifa_match\FifaMatchInterface
   *   The called match entity.
   */
  public function setStatus($status);

}
