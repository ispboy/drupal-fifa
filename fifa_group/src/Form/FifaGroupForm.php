<?php

namespace Drupal\fifa_group\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the group entity edit forms.
 */
class FifaGroupForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {

    $entity = $this->getEntity();
    $result = $entity->save();
    $link = $entity->toLink($this->t('View'))->toRenderable();

    $message_arguments = ['%label' => $this->entity->label()];
    $logger_arguments = $message_arguments + ['link' => render($link)];

    if ($result == SAVED_NEW) {
      $this->messenger()->addStatus($this->t('New group %label has been created.', $message_arguments));
      $this->logger('fifa_group')->notice('Created new group %label', $logger_arguments);
    }
    else {
      $this->messenger()->addStatus($this->t('The group %label has been updated.', $message_arguments));
      $this->logger('fifa_group')->notice('Updated new group %label.', $logger_arguments);
    }

    $form_state->setRedirect('entity.fifa_group.canonical', ['fifa_group' => $entity->id()]);
  }

}
