<?php

/**
 * @file
 * Contains Drupal\Core\Entity\Event\EntityEvent.
 */

namespace Drupal\Core\Entity\Event;

use Drupal\Core\Entity\EntityInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Base class for Entity events.
 */
class EntityEvent extends Event implements EntityEventInterface {

  /**
   * Event dispatcher
   *
   * @var \Drupal\Core\Entity\EntityInterface
   */
  protected $entity;

  /**
   * EntityEvent constructor.
   *
   * @param \Drupal\Core\Entity\EntityInterface $entity
   *   The entity that was operated on.
   */
  public function __construct(EntityInterface $entity) {
    $this->entity = $entity;
  }

  /**
   * {@inheritDoc}
   */
  public function getEntity() {
    return $this->entity;
  }

}
