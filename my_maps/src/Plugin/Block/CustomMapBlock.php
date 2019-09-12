<?php

namespace Drupal\my_maps\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\node\Entity\Node;

/**
 * Provides a 'CustomMapBlock' block.
 *
 * @Block(
 *  id = "custom_map_block",
 *  admin_label = @Translation("Custom map block"),
 * )
 */
class CustomMapBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Drupal\Core\Entity\EntityTypeManagerInterface definition.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * Constructs a new CustomMapBlock object.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param string $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The EntityTypeManagerInterface definition.
   */
  public function __construct(
    array $configuration,
    $plugin_id,
    $plugin_definition,
    EntityTypeManagerInterface $entity_type_manager
  ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->entityTypeManager = $entity_type_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('entity_type.manager')
    );
  }

  /**
   * {@inheritdoc}
   */
  // public function defaultConfiguration() {
  //   return [
  //     'description' => My custom map,
  //   ] + parent::defaultConfiguration();
  // }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form['description'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Description'),
      '#default_value' => $this->configuration['description'],
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '0',
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['description'] = $form_state->getValue('description');
  }

  /**
   * {@inheritdoc}
   */
  // public function build() {
  //   $build = [];
  //   // $build['#theme'] = 'custom_map_block';
  //   // $build['#conten'][] = $this->configuration['description'];
  //   $build['custom_maps_block_title']['markup'] = '<p>' . $this->configuration['title'] . '</p>';

  //   return $build;
  // }

/**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    // $build['#theme'] = 'custom_maps_block';
    // $build['#conten'][] = $this->configuration['description'];

    // $build['custom_maps_block_title']['#markup'] = '<p>' . $this->configuration['title'] = '</p>'; 
    // return $build;

    // Get the current node object
    $node = \Drupal::routeMatch()->getParameter('node');
    if ($node instanceof Node) {
      $build = [
        '#theme' => 'my_maps',
        '#description' => $this->configuration['description'],
        '#attached' => array(
          'library' => array(
            'my_maps/custom_map',
          ),
          'drupalSettings' => array(
            // Return the first Geofield value
            'geofield' => $node->get('field_geofield')->getValue()[0],
            'title' => $node->getTitle(),
          ),
        ),
      ];
    }
     return $build;
  }
}