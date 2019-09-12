<?php
/**
 * @file
 * Contains \Drupal\resume\Plugin\Block\XaiBlock.
 */
namespace Drupal\resume\Plugin\Block;
use Drupal\Core\Block\BlockBase;
/**
 * Provides a 'resume' block.
 *
 * @Block(
 *   id = "article_block",
 *   admin_label = @Translation("Resume block"),
 *   category = @Translation("Custom resume block example")
 * )
 */
class hello_world extends BlockBase {
  /**
   * {@inheritdoc}
   */

  public function build() {
    return array(
      '#type' => 'markup',
      '#markup' => 'This block list the article.',
    );
  }
}