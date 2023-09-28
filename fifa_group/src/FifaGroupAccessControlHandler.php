<?php

namespace Drupal\fifa_group;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Defines the access control handler for the group entity type.
 */
class FifaGroupAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    $uid = $account->id();

    switch ($operation) {
      case 'view':
        return AccessResult::allowedIfHasPermission($account, 'view group');

      case 'update':
        if ($uid > 0 && $entity->getOwnerId() === $uid) {
          return AccessResult::allowedIfHasPermissions($account, ['edit own group', 'administer group'], 'OR');
        } else {
          return AccessResult::allowedIfHasPermissions($account, ['edit any group', 'administer group'], 'OR');
        }

      case 'delete':
        if ($uid > 0 && $entity->getOwnerId() === $uid) {
          return AccessResult::allowedIfHasPermissions($account, ['delete own group', 'administer group'], 'OR');
        } else {
          return AccessResult::allowedIfHasPermissions($account, ['delete any group', 'administer group'], 'OR');
        }

      default:
        // No opinion.
        return AccessResult::neutral();
    }

  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermissions($account, ['create group', 'administer group'], 'OR');
  }

}
