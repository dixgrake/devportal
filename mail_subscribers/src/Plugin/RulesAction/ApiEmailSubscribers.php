<?php

namespace Drupal\mail_subscribers\Plugin\RulesAction;

use Drupal\Core\Language\LanguageInterface;
use Drupal\Core\Mail\MailManagerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\rules\Core\RulesActionBase;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\mail_subscribers\Service\MailService;

/**
 * Provides "Email API subscribers" rules action.
 *
 * @RulesAction(
 *   id = "rules_email_api_subscribers",
 *   label = @Translation("Email API subscribers"),
 *   category = @Translation("Subscribers"),
 *   context = {
 *     "node" = @ContextDefinition("entity:node",
 *       label = @Translation("The API to email subscribers of")
 *     ),
 *     "members" = @ContextDefinition("boolean",
 *       label = @Translation("Send to all developer organization members"),
 *       description = @Translation("If disabled then the mail will only be sent to the owner of the developer organization."),
 *       default_value = FALSE,
 *       required = FALSE
 *     ),
 *     "subject" = @ContextDefinition("string",
 *       label = @Translation("Subject"),
 *       description = @Translation("The email's subject.")
 *     ),
 *     "message" = @ContextDefinition("string",
 *       label = @Translation("Message"),
 *       description = @Translation("The email's message body.")
 *     ),
 *     "reply" = @ContextDefinition("email",
 *       label = @Translation("Reply to"),
 *       description = @Translation("The mail's reply-to address. Leave it empty to use the site-wide configured address."),
 *       default_value = NULL,
 *       allow_null = TRUE,
 *       required = FALSE
 *     ),
 *     "language" = @ContextDefinition("language",
 *       label = @Translation("Language"),
 *       description = @Translation("If specified, the language used for getting the mail message and subject."),
 *       default_value = NULL,
 *       required = FALSE
 *     ),
 *   }
 * )
 *
 * @todo: Define that message Context should be textarea comparing with textfield Subject
 * @todo: Add access callback information from Drupal 7.
 */
class ApiEmailSubscribers extends RulesActionBase implements ContainerFactoryPluginInterface {

  /**
   * The logger channel the action will write log messages to.
   *
   * @var \Psr\Log\LoggerInterface
   */
  protected $logger;

  /**
   * @var \Drupal\Core\Mail\MailManagerInterface
   */
  protected $mailManager;

  /**
   * @var \Drupal\mail_subscribers\Service\MailService
   */
  protected $subscriberMailService;

  /**
   * Constructs a SendEmail object.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $pluginId
   *   The plugin ID for the plugin instance.
   * @param mixed $pluginDefinition
   *   The plugin implementation definition.
   * @param \Psr\Log\LoggerInterface $logger
   *   The alias storage service.
   * @param \Drupal\Core\Mail\MailManagerInterface $mail_manager
   *   The mail manager service.
   * @param \Drupal\mail_subscribers\Service\MailService $subscriberMailService
   *   The subscriber mail service
   */
  public function __construct(array $configuration, $pluginId, $pluginDefinition, LoggerInterface $logger, MailManagerInterface $mail_manager, MailService $subscriberMailService) {
    parent::__construct($configuration, $pluginId, $pluginDefinition);
    $this->logger = $logger;
    $this->mailManager = $mail_manager;
    $this->subscriberMailService = $subscriberMailService;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $pluginId, $pluginDefinition) {
    return new static(
      $configuration,
      $pluginId,
      $pluginDefinition,
      $container->get('logger.factory')->get('rules'),
      $container->get('plugin.manager.mail'),
      $container->get('mail_subscribers.mail_service')
    );
  }

  /**
   * Email subscribers of a given API.
   *
   * @param \Drupal\node\NodeInterface $node
   *   The API to email the subscribers of.
   * @param boolean $members
   *   Email all members or just devorg owners.
   * @param string $subject
   *   Subject of the email.
   * @param string $message
   *   Email message text.
   * @param string|null $reply
   *   (optional) Reply to email address.
   * @param \Drupal\Core\Language\LanguageInterface|null $language
   *   (optional) Language code.
   *
   * @throws \Exception
   */
  protected function doExecute($node, $members = FALSE, $subject, $message, $reply = NULL, LanguageInterface $language = NULL) {
    $langcode = $language !== null ? $language->getId() : LanguageInterface::LANGCODE_SITE_DEFAULT;
    $mailParams = [
      'subject' => $subject,
      'message' => $message,
    ];

    if ($node->getType() === 'api') {
      if ($members === TRUE) {
        $toList = $this->subscriberMailService->getApiSubscribingMembers($node->id());
      }
      else {
        $toList = $this->subscriberMailService->getApiSubscribingOwners($node->id());
      }

      $mailParams['langcode'] = $langcode;

      $this->subscriberMailService->sendEmail($mailParams, $toList, $reply);
      if ($members === TRUE) {
        $this->logger->notice('Sent email to members subscribing to API %api', array(
          '%api' => $node->getTitle()
        ));
      }
      else {
        $this->logger->notice('Sent email to owners subscribing to API %api', array(
          '%api' => $node->getTitle()
        ));
      }
    }
    else {
      $this->logger->error('Node %api is not an API', array(
        '%api' => $node->getTitle()
      ));
    }
  }

}
