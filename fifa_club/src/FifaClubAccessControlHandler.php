<?php

namespace Drupal\fifa_club;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Defines the access control handler for the club entity type.
 */
class FifaClubAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    $uid = $account->id();

    switch ($operation) {
      case 'view':
        return AccessResult::allowedIfHasPermission($account, 'view club');

      case 'update':
        if ($uid > 0 && $entity->getOwnerId() === $uid) {
          return AccessResult::allowedIfHasPermissions($account, ['edit own club', 'administer club'], 'OR');
        } else {
          return AccessResult::allowedIfHasPermissions($account, ['edit any club', 'administer club'], 'OR');
        }

      case 'delete':
        return AccessResult::allowedIfHasPermissions($account, ['delete club', 'administer club'], 'OR');

      default:
        // No opinion.
        return AccessResult::neutral();
    }

  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermissions($account, ['create club', 'administer club'], 'OR');
  }

}
