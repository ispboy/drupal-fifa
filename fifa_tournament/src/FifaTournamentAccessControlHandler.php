<?php

namespace Drupal\fifa_tournament;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Defines the access control handler for the tournament entity type.
 */
class FifaTournamentAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    $uid = $account->id();

    switch ($operation) {
      case 'view':
        return AccessResult::allowedIfHasPermission($account, 'view tournament');

      case 'update':
        if ($uid > 0 && $entity->getOwnerId() === $uid) {
          return AccessResult::allowedIfHasPermissions($account, ['edit own tournament', 'administer tournament'], 'OR');
        } else {
          return AccessResult::allowedIfHasPermissions($account, ['edit any tournament', 'administer tournament'], 'OR');
        }

      case 'delete':
        return AccessResult::allowedIfHasPermissions($account, ['delete tournament', 'administer tournament'], 'OR');

      default:
        // No opinion.
        return AccessResult::neutral();
    }

  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermissions($account, ['create tournament', 'administer tournament'], 'OR');
  }

}
