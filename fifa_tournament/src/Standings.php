<?php

namespace Drupal\fifa_tournament;

class Standings {
  private $tournament;
  private $matches;
  private $results = [];

  public function __construct($tournament, $matches) {
      $this->tournament = $tournament;
      $this->matches = $matches;
      $bundle = $tournament->bundle();
      if (\method_exists($this, $bundle)) {
        $this->$bundle();
      }
  }

  public function parseMatch($match, $delta) {
    $item = [
      'tid' => $match->field_team[$delta]->entity->id(),
      'name' => $match->field_team[$delta]->entity->label(),
      'gs' => $match->field_goals_scored[$delta]->value,
      'ga' => $match->field_goals_against[$delta]->value,
      'w' => 0,
      'd' => 0,
      'l' => 0,
      'pt' => 0,
    ];
    if ($item['gs'] > $item['ga']) {
      $item['w'] = 1;
      $item['pt'] = 3;
    } elseif ($item['gs'] == $item['ga']) {
      $item['d'] = 1;
      $item['pt'] = 1;
    } else {
      $item['l'] = 1;
    }
    return $item;
  }

  public function league() {
    $tournament = $this->tournament;
    $matches = $this->matches;
    $teams = $tournament->get('field_team')->referencedEntities();
    $group = [
      'teams' => $teams,
      'matches' => $matches,
    ];

    $this->results['none'] = $this->getRoundRobin($group);
  }

  public function getResults() {
    return $this->results;
  }

  public function championship() {
    $tournament = $this->tournament;
    $matches = $this->matches;
    $teams = $tournament->get('field_team')->referencedEntities();
    $groups = [];

    //parse group stage
    foreach ($teams as $delta => $team) {
      if ($team->field_group_stages->value) {
        $groups[$team->field_group_stages->value]['teams'][] = $team;
      }
    }

    foreach ($matches as $id => $match) {
      if ($match->field_group_stages->value) {
        $groups[$match->field_group_stages->value]['matches'][] = $match;
      }
    }

    foreach ($groups as $gid => $group) {
      if (isset($group['teams'])) {
        $this->results[$gid] = $this->getRoundRobin($group);
      }
    }

  }

  public function getRoundRobin($group) {
    $teams = $group['teams'];
    $matches = $group['matches'];
    $items = [];
    foreach ($teams as $team) {
      $id = $team->id();
      $items[$id] = [
        'name' => $team->label(),
        'mp' => 0,
        'gs' => 0,
        'ga' => 0,
        'gd' => 0,
        'w' => 0,
        'd' => 0,
        'l' => 0,
        'pt' => 0,
      ];
    }

    $history = [];
    foreach ($matches as $id => $match) {
      if (count($match->field_team) == 2 && count($match->field_goals_scored) == 2) {
        $history[] = $this->parseMatch($match, 0);
        $history[] = $this->parseMatch($match, 1);
      }
    }
    foreach ($history as $record) {
      $tid = $record['tid'];
      $items[$tid]['mp'] ++;
      $items[$tid]['gs'] += $record['gs'];
      $items[$tid]['ga'] += $record['ga'];
      $items[$tid]['w'] += $record['w'];
      $items[$tid]['d'] += $record['d'];
      $items[$tid]['l'] += $record['l'];
      $items[$tid]['pt'] += $record['pt'];
      $items[$tid]['gd'] += $record['gs'] - $record['ga'];
    }

    foreach ($items as $key => $row) {
        $points[$key]  = $row['pt'];
        $gf[$key] = $row['gs'];
        $gd[$key] = $row['gd'];
        $items[$key]['nid'] = $key;
    }

    array_multisort($points, SORT_DESC, $gd, SORT_DESC, $gf, SORT_DESC, $items);

    return $items;
  }

}
