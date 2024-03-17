<?php

namespace Drupal\demo_rest_api\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Drupal\user\Entity\User;

/**
 * Provides a Demo Resource
 *
 * @RestResource(
 *   id = "demo_resource",
 *   label = @Translation("Demo Resource"),
 *   uri_paths = {
 *     "canonical" = "/demo_rest_api/demo_resource",
 *     "create" = "/demo_rest_api/user-registration",
 *   }
 * )
 */

 class DemoResource extends ResourceBase {

    /**
     * Responds to entity GET requests.
     * @return \Drupal\rest\ResourceResponse
     */
    public function get() {
      $response = ['message' => 'Hello, this is a rest service'];
      return new ResourceResponse($response);
    }

    public static function create(ContainerInterface $container, array $config, $module_id, $module_definition) {
        return new static(
          $config,
          $module_id,
          $module_definition,
          $container->getParameter('serializer.formats'),
          $container->get('logger.factory')->get('demo_create'),
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