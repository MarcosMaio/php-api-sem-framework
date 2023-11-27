<?php

class Clients
{
  public function listAll()
  {
    $db = DB::connect();
    $rs = $db->prepare("SELECT * FROM clients ORDER BY name");
    $rs->execute();
    $obj = $rs->fetchAll(PDO::FETCH_ASSOC);

    if ($obj) {
      echo json_encode(['data' => $obj]);
    } else {
      echo json_encode(['data' => "The database is empty"]);
    }
  }

  public function listUnique($param)
  {
    $db = DB::connect();
    $rs = $db->prepare("SELECT * FROM clients WHERE id = :param");
    $rs->bindParam(':param', $param, PDO::PARAM_INT);
    $rs->execute();
    $obj = $rs->fetchObject();

    if ($obj) {
      echo json_encode(['data' => $obj]);
    } else {
      echo json_encode(['data' => "value corresponding to the requested parameter was not found"]);
    }
  }

  public function add()
  {
    $sql = "INSERT INTO clients (";

    $count = 1;
    foreach (array_keys($_POST) as $index) {
      if (count($_POST) > $count) {
        $sql .= "{$index},";
      } else {
        $sql .= "{$index}";
      }
      $count++;
    }

    $sql .= ") VALUES (";

    $count = 1;
    foreach (array_values($_POST) as $value) {
      if (count($_POST) > $count) {
        $sql .= "'{$value}',";
      } else {
        $sql .= "'{$value}'";
      }
      $count++;
    }
    $sql .= ")";

    $db = DB::connect();
    $rs = $db->prepare($sql);
    $exe = $rs->execute();

    if ($exe) {
      echo json_encode(['data' => 'data insertion was successful']);
    } else {
      echo json_encode(['data' => "An error occurred while inserting the data, check if all the necessary columns were inserted correctly"]);
    }
  }

  public function update($param)
  {
    array_shift($_POST);

    // "UPDATE clients SET name = 'new name', email = 'new email' WHERE id= $param"

    $sql = "UPDATE clients SET ";

    $count = 1;
    foreach (array_keys($_POST) as $index) {
      if (count($_POST) > $count) {
        $sql .= "{$index} = '{$_POST[$index]}', ";
      } else {
        $sql .= "{$index} = '{$_POST[$index]}' ";
      }
      $count++;
    }

    $sql .= "WHERE id={$param}";

    $db = DB::connect();
    $rs = $db->prepare($sql);
    $exe = $rs->execute();

    if ($exe) {
      echo json_encode(['data' => 'data update was successful']);
    } else {
      echo json_encode(['data' => "An error occurred while updating the data"]);
    }
  }

  public function delete($param)
  {
    array_shift($_POST);

    // "DELETE FROM clients WHERE ID={$param}"

    $sql = "DELETE FROM clients WHERE id={$param}";

    $db = DB::connect();
    $rs = $db->prepare($sql);
    $exe = $rs->execute();

    if ($exe) {
      echo json_encode(['data' => 'data delete was successful']);
    } else {
      echo json_encode(['data' => "An error occurred while delete the data"]);
    }
  }
}