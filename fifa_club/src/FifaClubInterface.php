<?php

namespace Drupal\fifa_club;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\user\EntityOwnerInterface;
use Drupal\Core\Entity\EntityChangedInterface;

/**
 * Provides an interface defining a club entity type.
 */
interface FifaClubInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

  /**
   * Gets the club title.
   *
   * @return string
   *   Title of the club.
   */
  public function getTitle();

  /**
   * Sets the club title.
   *
   * @param string $title
   *   The club title.
   *
   * @return \Drupal\fifa_club\FifaClubInterface
   *   The called club entity.
   */
  public function setTitle($title);

  /**
   * Gets the club creation timestamp.
   *
   * @return int
   *   Creation timestamp of the club.
   */
  public function getCreatedTime();

  /**
   * Sets the club creation timestamp.
   *
   * @param int $timestamp
   *   The club creation timestamp.
   *
   * @return \Drupal\fifa_club\FifaClubInterface
   *   The called club entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the club status.
   *
   * @return bool
   *   TRUE if the club is enabled, FALSE otherwise.
   */
  public function isEnabled();

  /**
   * Sets the club status.
   *
   * @param bool $status
   *   TRUE to enable this club, FALSE to disable.
   *
   * @return \Drupal\fifa_club\FifaClubInterface
   *   The called club entity.
   */
  public function setStatus($status);

}
