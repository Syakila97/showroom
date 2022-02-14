<?php
//get all products
function getAllcars($db)
{
$sql = 'Select p.id, p.name, p.company, p.color, p.model, c.id as category from cars p ';
$sql .='Inner Join cars c on p.id = c.id';
$stmt = $db->prepare ($sql);
$stmt ->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
//get product by id
function getcars($db, $productId)
{
$sql = 'Select p.id, p.name, p.company, p.color, p.model, c.id as category from cars p ';
$sql .= 'Inner Join cars c on p.id = c.id ';
$sql .= 'Where p.id = :id';
$stmt = $db->prepare ($sql);
$id = (int) $productId;
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//add new product
function createcars($db, $form_data) {
    $sql = 'Insert into cars (id, name, company, color, model)';
    $sql .= 'values (:id, :name, :company, :color, :model)';
    $stmt = $db->prepare ($sql);
    $stmt->bindParam(':id', $form_data['id']);
    $stmt->bindParam(':name', $form_data['name']);
    $stmt->bindParam(':company', ($form_data['company']));
    $stmt->bindParam(':color', ($form_data['color']));
    $stmt->bindParam(':model', $form_data['model']);
    $stmt->execute();
    return $db->lastInsertID();//insert last number.. continue
    }

//delete product by id 
function deletecars($db,$carsId) { 
    $sql = ' Delete from cars where id = :id'; 
    $stmt = $db->prepare($sql); 
    $id = (int)$carsId; 
    $stmt->bindParam(':id', $id, PDO::PARAM_INT); 
    $stmt->execute(); 
    } 
    


//update product by id 
function updatecars($db,$form_dat,$carsId,$date) { 
    $sql = 'UPDATE cars SET id = :id , name = :name , company = :company , color = :color , model = :model ';  $sql .=' WHERE id = :id'; 
    $stmt = $db->prepare ($sql); 
    $id = (int)$carsId; 
    $mod = $date; 
    $stmt->bindParam(':id', $id, PDO::PARAM_INT); 
    $stmt->bindParam(':name', $form_dat['name']); 
    $stmt->bindParam(':id', $form_dat['id']);  $stmt->bindParam(':name', ($form_dat['name']));  $stmt->bindParam (':company', ($form_dat['company'])); 
     $stmt->bindParam(':color', $form_dat['color']);$stmt->bindParam(':model', $form_dat['model']); 
    $stmt->execute(); 
     
   }