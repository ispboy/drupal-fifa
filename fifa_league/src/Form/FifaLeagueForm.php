<?php

namespace Drupal\fifa_league\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the league entity edit forms.
 */
class FifaLeagueForm extends ContentEntityForm {

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
      $this->messenger()->addStatus($this->t('New league %label has been created.', $message_arguments));
      $this->logger('fifa_league')->notice('Created new league %label', $logger_arguments);
    }
    else {
      $this->messenger()->addStatus($this->t('The league %label has been updated.', $message_arguments));
      $this->logger('fifa_league')->notice('Updated new league %label.', $logger_arguments);
    }

    $form_state->setRedirect('entity.fifa_league.canonical', ['fifa_league' => $entity->id()]);
  }

}
