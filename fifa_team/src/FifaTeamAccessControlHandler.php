<?php

namespace Drupal\fifa_team;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Defines the access control handler for the team entity type.
 */
class FifaTeamAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    $uid = $account->id();

    switch ($operation) {
      case 'view':
        return AccessResult::allowedIfHasPermission($account, 'view team');

      case 'update':
        if ($uid > 0 && $entity->getOwnerId() === $uid) {
          return AccessResult::allowedIfHasPermissions($account, ['edit own team', 'administer team'], 'OR');
        } else {
          return AccessResult::allowedIfHasPermissions($account, ['edit any team', 'administer team'], 'OR');
        }

      case 'delete':
        if ($uid > 0 && $entity->getOwnerId() === $uid) {
          return AccessResult::allowedIfHasPermissions($account, ['delete own team', 'administer team'], 'OR');
        } else {
          return AccessResult::allowedIfHasPermissions($account, ['delete any team', 'administer team'], 'OR');
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
    return AccessResult::allowedIfHasPermissions($account, ['create team', 'administer team'], 'OR');
  }

}
