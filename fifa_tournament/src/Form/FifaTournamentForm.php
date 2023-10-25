<?php

namespace Drupal\fifa_tournament\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the tournament entity edit forms.
 */
class FifaTournamentForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $result = parent::save($form, $form_state);

    $entity = $this->getEntity();

    $message_arguments = ['%label' => $entity->toLink()->toString()];
    $logger_arguments = [
      '%label' => $entity->label(),
      'link' => $entity->toLink($this->t('View'))->toString(),
    ];

    switch ($result) {
      case SAVED_NEW:
        $this->messenger()->addStatus($this->t('New tournament %label has been created.', $message_arguments));
        $this->logger('fifa_tournament')->notice('Created new tournament %label', $logger_arguments);
        break;

      case SAVED_UPDATED:
        $this->messenger()->addStatus($this->t('The tournament %label has been updated.', $message_arguments));
        $this->logger('fifa_tournament')->notice('Updated tournament %label.', $logger_arguments);
        break;
    }

    $form_state->setRedirect('entity.fifa_tournament.canonical', ['fifa_tournament' => $entity->id()]);

    return $result;
  }

}
