<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

$app->get('/api/elem', function(Request $request, Response $response){
  $sql = "SELECT * FROM test";
  try{
      // Get DB Object
      $db = new db();
      // Connect
      $db = $db->connect();
      $stmt = $db->query($sql);
      $customers = $stmt->fetchAll(PDO::FETCH_OBJ);
      $db = null;
      echo json_encode($customers);
  } catch(PDOException $e){
      echo '{"error": {"text": '.$e->getMessage().'}';
  }
});

$app->get('/api/elem/{id}', function(Request $request, Response $response){
  $id = $request->getAttribute('id');
  $sql = "SELECT * FROM test WHERE id = $id";
  try{
      // Get DB Object
      $db = new db();
      // Connect
      $db = $db->connect();
      $stmt = $db->query($sql);
      $customer = $stmt->fetch(PDO::FETCH_OBJ);
      $db = null;
      echo json_encode($customer);
  } catch(PDOException $e){
      echo '{"error": {"text": '.$e->getMessage().'}';
  }
});
