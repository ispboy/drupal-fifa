<?php

namespace Drupal\fifa_team\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the team entity edit forms.
 */
class FifaTeamForm extends ContentEntityForm {

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
        $this->messenger()->addStatus($this->t('New team %label has been created.', $message_arguments));
        $this->logger('fifa_team')->notice('Created new team %label', $logger_arguments);
        break;

      case SAVED_UPDATED:
        $this->messenger()->addStatus($this->t('The team %label has been updated.', $message_arguments));
        $this->logger('fifa_team')->notice('Updated team %label.', $logger_arguments);
        break;
    }

    $form_state->setRedirect('entity.fifa_team.canonical', ['fifa_team' => $entity->id()]);

    return $result;
  }

}
