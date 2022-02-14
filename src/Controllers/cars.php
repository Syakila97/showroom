<?php
use Slim\Http\Request; //namespace
use Slim\Http\Response; //namespace

//include productsProc.php file
include __DIR__ . '/../function/productProc.php';
//read table products

$app->get('/cars', function (Request $request, Response $response, array
$arg){
 return $this->response->withJson(array('data' => 'success'), 200);
});

// read all data from table products
$app->get('/allcars',function (Request $request, Response $response, 
array $arg)
{
 $data = getAllcars($this->db);
if (is_null($data)) {
 return $this->response->withHeader('Access-Control-Allow-Origin', '*') 
 ->withJson(array('error' => 'no data'), 404);
}
return $this->response->withJson(array('data' => $data), 200);
});

//request table products by condition (product id)
$app->get('/cars/[{id}]', function ($request, $response, $args){
 
 $productId = $args['id'];
 if (!is_numeric($productId)) {
 return $this->response
 ->withJson(array('error' => 'numeric paremeter required'), 500);
 }
 $data = getcars($this->db,$productId);
 if (empty($data)) {
 return $this->response->withJson(array('error' => 'no data'), 500);
}
 return $this->response->withJson(array('data' => $data), 200);

});

$app->post('/cars/add', function ($request, $response, $args) {
    $form_data = $request->getParsedBody();
    $data = createcars($this->db, $form_data);
    if ($data <= 0) {
    return $this->response->withJson(array('error' => 'add data fail'), 500);
    }
    return $this->response->withJson(array('add data' => 'success'), 200);
    }
    );


//delete row 
$app->delete('/cars/del/[{id}]', function ($request, $response, $args){   
 $carsId = $args['id']; 
if (!is_numeric($carsId)) { 
 return $this->response->withJson(array('error' => 'numeric paremeter required'), 422); 
} 
$data = deletecars($this->db,$carsId); 
if (empty($data)) { 
return $this->response->withJson(array($carsId=> 'is successfully deleted'), 202);}; }); 

//put table products 
$app->put('/cars/put/[{id}]', function ($request, $response, $args){  $carsId = $args['id']; 
 $date = date("Y-m-j h:i:s"); 
  
if (!is_numeric($carsId)) { 
 return $this->response->withJson(array('error' => 'numeric paremeter required'), 422); } 
 $form_dat=$request->getParsedBody(); 
  
$data=updatecars($this->db,$form_dat,$carsId,$date); if ($data <=0)


return $this->response->withJson(array('data' => 'successfully updated'), 200); 
});

