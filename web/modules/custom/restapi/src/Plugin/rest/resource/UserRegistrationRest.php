<?php
namespace Drupal\restapi\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Psr\Log\LoggerInterface;
use Drupal\Core\Session\AccountProxyInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Drupal\user\Entity\User;

/**
 * Provides a resource to create users using REST API.
 *
 * @RestResource(
 *   id = "user_registration_rest",
 *   label = @Translation("User Registration API"),
 *   uri_paths = {
 *     "create" = "/api/user-registration",
 *   }
 * )
 */
class UserRegistrationRest extends ResourceBase {
  protected $loggedUser;

  public function __construct(array $config, $module_id, $module_definition, array $serializer_formats, LoggerInterface $logger, AccountProxyInterface $current_user) {
    parent::__construct($config, $module_id, $module_definition, $serializer_formats, $logger);
    $this->loggedUser = $current_user;
  }

  public static function create(ContainerInterface $container, array $config, $module_id, $module_definition) {
    return new static(
      $config,
      $module_id,
      $module_definition,
      $container->getParameter('serializer.formats'),
      $container->get('logger.factory')->get('user_registration_api'),
      $container->get('current_user')
    );
  }

  public function post(Request $data) {
    try {
      $content = $data->getContent();
      $params = json_decode($content, TRUE);
      $message_string = "";

      // Validate and process user registration data here.

      // Example: Create a new user.
      $user = User::create([
        'name' => $params['email'],
        'mail' => $params['email'],
        'status' => 1,
        // Add other fields as needed.
      ]);
      $user->save();

      return new JsonResponse(['message' => 'User registered successfully.']);
    } catch (\Exception $e) {
      return new JsonResponse(['error' => $e->getMessage()], 500);
    }
  }
}
