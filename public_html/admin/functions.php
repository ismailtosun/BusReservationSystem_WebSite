<?php

include('../config.php');

function getRoutes(){
    global $db;
    $sql = "SELECT * FROM route";
    $result = $db->get_results($sql, OBJECT);
    return $result;
}

function getCities(){
    global $db;
    $sql = "SELECT * FROM city";
    $result = $db->get_results($sql, OBJECT);
    return $result;
}

function getRoute($id){
    global $db;
    $sql = "SELECT * FROM route WHERE id = $id";
    $result = $db->get_row($sql, OBJECT);
    return $result;
}

function updateRoute($data){
    global $db;
    $sql = "UPDATE route SET `from` = '".$data["from_city"]."', `to` = '".$data["to_city"]."', driver_name = '".$data["driver_name"]."', fare = '".$data["fare"]."', bus_id = '".$data["bus_id"]."', departure_time = '".$data["departure_time"]."'  WHERE id = " . $data["id"];
    $db->query($sql);
}

function deleteRoute($id){
    global $db;
    $sql = "DELETE FROM route WHERE id = $id";
    $result = $db->query($sql, OBJECT);
    return $result;
}
function addRoute ($new_city_from ,$new_city_to, $new_bus_id, $new_driver_name , $new_fare, $new_departure_time)
{
    global $db;
    $sql="INSERT INTO route (from_city,to_city,driver_name,fare,departure_time,bus_id) VALUES ('$new_city_from' ,'$new_city_to', '$new_driver_name' , '$new_fare', '$new_departure_time',$new_bus_id )";
    $result = $db->query($sql, OBJECT);
    return $result;
}




function updateBus ($data)
{
    global $db;
    $sql = "UPDATE bus SET `name` = '".$data["bus_name"]."', `seat_count` = ".$data["seat_count"].", type = '".$data["type"]."', plate = '".$data["plate"]."'  WHERE id = " . $data["id"];
    $db->query($sql);
}
function deleteBus ($id)
{
    global $db;
    $sql = "DELETE FROM bus WHERE id = $id";
    $result = $db->query($sql, OBJECT);
    return $result;
}
function addBus ($new_name,$new_seat_count,$new_type,$new_plate)
{
    global $db;
    $sql="INSERT INTO bus (name,seat_count,type,plate) VALUES ('$new_name',$new_seat_count,'$new_type','$new_plate')";
    $result = $db->query($sql, OBJECT);
    return $result;
}
function getBus($id){
    global $db;
    $sql = "SELECT * FROM bus WHERE id = $id";
    $result = $db->get_row($sql, OBJECT);
    return $result;
}
function getBuses(){
    global $db;
    $sql = "SELECT * FROM bus";
    $result = $db->get_results($sql, OBJECT);
    return $result;
}




function updateAgent ($data)
{
    global $db;
    $sql = "UPDATE agent SET `name` = '".$data["agent_name"]."', `email` = '".$data["email"]."', phone = '".$data["phone"]."', address = '".$data["address"]."'  WHERE id = " . $data["id"];
    $db->query($sql);
}
function deleteAgent ($id)
{
    global $db;
    $sql = "DELETE FROM agent WHERE id = $id";
    $result = $db->query($sql, OBJECT);
    return $result;
}
function addAgent ($agent_name,$email,$phone,$address)
{
    global $db;
    $sql="INSERT INTO agent (name,email,phone,address) VALUES ('$agent_name','$email','$phone','$address')";
    $result = $db->query($sql, OBJECT);
    return $result;
}
function getAgent($id)
{
    global $db;
    $sql = "SELECT * FROM agent WHERE id = $id";
    $result = $db->get_row($sql, OBJECT);
    return $result;
}
function getAgents(){
    global $db;
    $sql = "SELECT * FROM agent";
    $result = $db->get_results($sql, OBJECT);
    return $result;
}



function updateEmployee ($data)
{
    global $db;
    $sql = "UPDATE employee SET  agent_id = ".$data["agent_id"].",`first_name` = '".$data["first_name"]."',`last_name` = '".$data["last_name"]."', `email` = '".$data["email"]."', phone_number = '".$data["phone_number"]."', gender = ".$data["gender"]." , user_id = ".$data["user_id"]."  WHERE id = " . $data["id"];
    $db->query($sql);
}
function deleteEmployee ($id)
{
    global $db;
    $sql = "DELETE FROM employee WHERE id = $id";
    $result = $db->query($sql, OBJECT);
    return $result;
}
function addEmployee ($agent_id,$first_name,$last_name,$email,$phone_number,$gender,$user_id)
{
    global $db;
    $sql="INSERT INTO employee (agent_id,first_name,last_name,email,phone_number,gender,user_id) VALUES ($agent_id,'$first_name','$last_name','$email','$phone_number',$gender,$user_id)";
    $result = $db->query($sql, OBJECT);
    return $result;
}
function getEmployee($id)
{
    global $db;
    $sql = "SELECT * FROM employee WHERE id = $id";
    $result = $db->get_row($sql, OBJECT);
    return $result;
}
function getEmployees(){
    global $db;
    $sql = "SELECT * FROM employee";
    $result = $db->get_results($sql, OBJECT);
    return $result;
}

function addUser ($user_id,$user_name,$password,$user_level,$email)
{
    global $db;
    $sql="INSERT INTO user (id,user_name,password,email,user_level) VALUES ($user_id,'$user_name','$password','$email',$user_level)";
    $result = $db->query($sql, OBJECT);
    return $result;
}
function updateUser ($updated_user_id,$updated_user_name,$updated_password,$updated_email,$updated_user_level)
{
    global $db;
    $sql = "UPDATE user SET  id = $updated_user_id ,`user_name` = '$updated_user_name',`password` = '$updated_password', `email` = '$updated_email', user_level = '$updated_user_level'  WHERE id = $updated_user_id";
    $db->query($sql);
}
function getUser($id)
{
    global $db;
    $sql = "SELECT * FROM user WHERE id = $id";
    $result = $db->get_row($sql, OBJECT);
    return $result;
}
function deleteUser ($id)
{
    global $db;
    $sql = "DELETE FROM user WHERE id = $id";
    $result = $db->query($sql, OBJECT);
    return $result;
}




