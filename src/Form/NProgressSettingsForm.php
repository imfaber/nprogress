<?php

/**
* @file
* Contains \Drupal\nprogress\Form\NProgressSettingsForm.
*/

namespace Drupal\nprogress\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
* Configure NProgress settings for this site.
*/
class NProgressSettingsForm extends ConfigFormBase {

  /**
  * {@inheritdoc}
  */
  public function getFormId() {
    return 'nprogress_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['nprogress.settings'];
  }

  /**
  * {@inheritdoc}
  */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $config = $this->config('nprogress.settings'); // Default settings

    $form['page_load'] = [
      '#type' => 'details',
      '#title' => $this->t('Page load settings'),
      '#open' => TRUE,
    ];

    $form['page_load']['nprogress_page_display'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Display progressbar on every page.'),
      '#default_value' => $config->get('page.display'),
    ];

    $form['page_load']['nprogress_page_timer'] = [
      '#default_value' => $config->get('page.timer'),
      '#type' => 'number',
      '#title' => $this->t('Progressbar timer'),
      '#description' => $this->t('Time to display progressbar on each page (milliseconds).'),
    ];

    $form['page_load']['nprogress_page_color'] = [
      '#type' => 'color',
      '#title' => $this->t('Color'),
      '#default_value' => $config->get('page.color'),
    ];

    $form['ajax_load'] = [
      '#type' => 'details',
      '#title' => $this->t('AJAX settings'),
      '#open' => TRUE,
    ];

    $form['ajax_load']['nprogress_ajax_display'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Display progressbar on ajax load.'),
      '#default_value' => $config->get('ajax.display'),
    ];

    $form['ajax_load']['nprogress_ajax_color'] = [
      '#type' => 'color',
      '#title' => $this->t('Color'),
      '#default_value' => $config->get('ajax.color'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();
    $this->config('nprogress.settings')
      ->set('page.display', $values['nprogress_page_display'])
      ->set('page.timer', $values['nprogress_page_timer'])
      ->set('page.color', $values['nprogress_page_color'])
      ->set('ajax.display', $values['nprogress_ajax_display'])
      ->set('ajax.color', $values['nprogress_ajax_color'])
      ->save();

  }
}
