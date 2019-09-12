<?php

namespace Drupal\resume\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\resume\Controller\ResumeController;

/**
 * Provides a 'ResumeBlock' block.
 *
 * @Block(
 *  id = "resume_block",
 *  admin_label = @Translation("Resume block"),
 * )
 */
class ResumeBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    // $build = [];
    // $build['resume_block']['#markup'] = 'Implement ResumeBlock.';

    // return $build;
    $controller_variable = new ResumeController;
    $rendering_in_block = $controller_variable->successpage();
    return $rendering_in_block;
  }

}
