<?php

/**
 * @file
 * Contains \Drupal\Tests\Core\Entity\Event\EntityEventTest.
 */

namespace Drupal\Tests\Core\Entity\Event;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\Core\Entity\Event\EntityUpdateEvent;
use Drupal\Core\Entity\Event\EntityEvent;
use Drupal\Tests\UnitTestCase;
use Symfony\Component\EventDispatcher\EventDispatcher;

/**
 * @coversDefaultClass \Drupal\Core\Entity\Event\EntityEvent
 * @group Entity
 */
class EntityEventTest extends UnitTestCase {

  /**
   * An EntityEvent object.
   *
   * @var \Drupal\Core\Entity\Event\EntityEventInterface
   */
  protected $entityEvent;

  /**
   * A MutatedEntityEventInterface object
   *
   * @var \Drupal\Core\Entity\Event\MutatedEntityEventInterface
   */
  protected $mutatedEntityEvent;

  /**
   * A mocked entity to create the event with.
   *
   * @var \Drupal\Core\Entity\EntityInterface
   */
  protected $entity;

  /**
   * Another mocked entity to test getOriginalEntity() with.
   *
   * @var \Drupal\Core\Entity\EntityInterface
   */
  protected $changedEntity;

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();

    // Set up an event dispatcher for entity functionality that relies on it.
    $container = new ContainerBuilder();
    $container->set('event_dispatcher', new EventDispatcher());
    \Drupal::setContainer($container);

    // Build a mocked entity.
    $values = array(
      'id' => 1,
      'langcode' => 'en',
      'uuid' => '3bb9ee60-bea5-4622-b89b-a63319d10b3a',
      'label' => $this->randomMachineName(),
    );
    $entity_type_id = $this->randomMachineName();
    $this->entity = $this->getMockForAbstractClass('\Drupal\Core\Entity\Entity', array($values, $entity_type_id));

    $this->entityEvent = new EntityEvent($this->entity);

    // Build a second mocked entity and include the original.
    $this->changedEntity = clone $this->entity;
    $this->changedEntity->original = clone $this->entity;
    $this->changedEntity->label .= ' CHANGED';

    $this->mutatedEntityEvent = new EntityUpdateEvent($this->changedEntity);
  }

  /**
   * Tests the getEntity() method.
   *
   * @covers ::getEntity
   */
  public function testGetEntity() {
    $entity = $this->entityEvent->getEntity();
    $this->assertSame($this->entity, $entity);
  }

  /**
   * Test the getOriginalEntity() method on MutatedEntityEventInterface
   *
   * @covers \Drupal\Core\Entity\Event\EntityUpdateEvent::getOriginalEntity
   */
  public function testGetOriginalEntity() {
    $entity = $this->mutatedEntityEvent->getEntity();
    $this->assertSame($this->changedEntity, $entity);
    $this->assertEquals($this->changedEntity->label, $this->entity->label . ' CHANGED');
  }

}
