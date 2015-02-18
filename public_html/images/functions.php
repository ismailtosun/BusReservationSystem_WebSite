<?php

include('config.php');

function isLogged(){
    return (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == true);
}

function isAdmin(){
    return (isset($_SESSION["user_level"]) && $_SESSION["user_level"] == "3");
}
function isEmployee(){
    return (isset($_SESSION["user_level"]) && $_SESSION["user_level"] == "0");
}


function processLogin($data){
    global $db;
    $username = $_POST["username"];
    $password = $_POST["password"];
    $sql = "SELECT * FROM user WHERE user_name = '" . $username. "' AND password = '" . $password ."'";
    $result = $db->get_row($sql, OBJECT);
    if($result){
        $_SESSION["logged_in"] = true;
        $_SESSION["user_id"] = $result->id;
        $_SESSION["user_name"] = $result->user_name;
        $_SESSION["user_level"] = $result->user_level;

        if($result->user_level == "3"){
            return 2;
        }
        return 1;
    }else{
        return false;
    }
}

function search_route($data){
    global $db;
    $from_city = $data["from_city"];
    $to_city = $data["to_city"];
    $date = $data["date"];
    $new_date = date("Y-m-d", strtotime($date));
    $sql = "SELECT route.id, departure_time, fare, from_city, to_city, T.name AS to_city_name, F.name AS from_city_name FROM route INNER JOIN city AS T ON route.to_city = T.id INNER JOIN city AS F ON route.from_city = F.id WHERE from_city = '" . $from_city . "' AND to_city = '" . $to_city . "' AND departure_time BETWEEN '" . $new_date . "' AND ADDDATE('" . $new_date . "',INTERVAL 1 DAY) ORDER BY departure_time ASC";
    $result = $db->get_results($sql);
    return $result;
}

function check_search_params(){
    return ($_POST["from_city"] != "" && $_POST["to_city"] != "" && $_POST["date"] != "" );
}

function getReservedSeats($route_id){
    global $db;
    $sql = "SELECT seat_number FROM reservation WHERE route_id = $route_id";
    $result = $db->get_col($sql);
    return $result;
}

function checkReservationParams($data){
    return !(in_array("", $data));
}

function processReservation($data){
    $customer_id = createCustomer($data);
    createReservation($data["route_id"],$data["seat_number"],$customer_id);
}


function createReservation($route_id, $seat_number, $customer_id){
    global $db;
    $user_id = $_SESSION["user_id"];
    $sql = "INSERT INTO reservation(user_id, route_id, customer_id, date, status, seat_number) VALUES ('" . $user_id . "','" . $route_id . "','" . $customer_id . "', NOW() ,'1','" . $seat_number . "')";
    $db->query($sql);
}

function createCustomer($data){
    global $db;
    $first_name = $data["first_name"];
    $last_name = $data["last_name"];
    $phone_number = $data["phone_number"];
    $gender = $data["gender"];
    $birth_date = $data["birth_date"];
    $birth_date = date("Y-m-d", strtotime($birth_date));

    $email = $data["email"];
    $user_id = $_SESSION["user_id"];
    $sql = "INSERT INTO customer(first_name, last_name, phone_number, gender, birthdate, email, user_id) VALUES ('" . $first_name . "','" . $last_name . "','" . $phone_number . "','" . $gender . "', '" . $birth_date ."' ,'" . $email . "','" . $user_id . "')";
    $db->query($sql);
    return $db->insert_id;
}

function getReservations(){
    global $db;
    $sql = "SELECT DISTINCT Res.id, Res.seat_number, Res.status, C.first_name, C.last_name, C.phone_number, Res.date AS reservation_date, R.departure_time, T.name AS to_city_name, F.name AS from_city_name, Res.user_id FROM reservation AS Res INNER JOIN route AS R INNER JOIN city AS T ON R.to_city = T.id INNER JOIN
           city AS F ON R.from_city = F.id AND Res.id = R.id INNER JOIN user AS U ON Res.user_id = U.id INNER JOIN customer AS C ON Res.customer_id = C.id CROSS JOIN
                         employee AS E";
    $result = $db->get_results($sql, OBJECT);
    return $result;
}

function getLatestReservations(){
    global $db;
    $sql = "SELECT DISTINCT Res.id, Res.seat_number, Res.status, C.first_name, C.last_name, C.phone_number, Res.date AS reservation_date, R.departure_time, T.name AS to_city_name, F.name AS from_city_name, Res.user_id FROM reservation AS Res INNER JOIN route AS R INNER JOIN city AS T ON R.to_city = T.id INNER JOIN
           city AS F ON R.from_city = F.id AND Res.id = R.id INNER JOIN user AS U ON Res.user_id = U.id INNER JOIN customer AS C ON Res.customer_id = C.id CROSS JOIN
                         employee AS E LIMIT 10";
    $result = $db->get_results($sql, OBJECT);
    return $result;
}

function getMySales(){
    global $db;
    $user_id = $_SESSION["user_id"];
    $sql = "SELECT DISTINCT C.first_name, C.last_name, (Res.id), U.id AS user_id, R.fare, Res.status, Res.date AS reservation_date, R.departure_time, T.name AS to_city_name, F.name AS from_city_name FROM (route AS R INNER JOIN city AS T ON R.to_city = T.id INNER JOIN city AS F ON R.from_city = F.id), (user AS U LEFT JOIN reservation AS Res ON Res.user_id = U.id), customer AS C WHERE Res.user_id = $user_id AND Res.route_id = R.id AND C.id = Res.customer_id";
    $result = $db->get_results($sql, OBJECT);
    return $result;
}

function getCityName($id){
    global $db;
    $sql = "SELECT * FROM city WHERE id = $id";
    $result = $db->get_row($sql, OBJECT);
    return $result->name;
}

function getCity($id){
    global $db;
    $sql = "SELECT * FROM city WHERE id = $id";
    $result = $db->get_row($sql, OBJECT);
    return $result;
}

function getCities(){
    global $db;
    $sql = "SELECT * FROM city";
    $result = $db->get_results($sql, OBJECT);
    return $result;
}

function getRoutes(){
    global $db;
    $sql = "SELECT * FROM route";
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
    $sql = "UPDATE route SET from_city = '".$data["from_city"]."', to_city = '".$data["to_city"]."', driver_name = '".$data["driver_name"]."', fare = '".$data["fare"]."', bus_id = '".$data["bus_id"]."', departure_time = '".$data["departure_time"]."'  WHERE id = " . $data["id"];
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
    $sql = "UPDATE employee SET  agent_id = ".$data["agent_id"].",`first_name` = '".$data["first_name"]."',`last_name` = '".$data["last_name"]."', `email` = '".$data["email"]."', phone_number = '".$data["phone_number"]."', gender = ".$data["gender"]." WHERE id = " . $data["id"];
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

function addUser ($user_name,$password,$email)
{
    global $db;
    $sql="INSERT INTO user (user_name,password,email,user_level) VALUES ('$user_name','$password','$email', 1)";
    $db->query($sql);
    return $db->insert_id;
}
function updateUser ($updated_user_id,$updated_user_name,$updated_password,$updated_email,$updated_user_level)
{
    global $db;
    $sql = "UPDATE user SET `user_name` = '$updated_user_name',`password` = '$updated_password', `email` = '$updated_email', user_level = '$updated_user_level'  WHERE id = $updated_user_id";
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


