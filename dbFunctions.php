<?php
/**
 * Created by PhpStorm.
 * User: f-mkotsovoulou
 * Date: 3/16/2018
 * Time: 2:00 PM
 */

function getArtists()
{
    include "db.php";
    $results = $db->query("select * from artists");
    $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);
    return $resultsArray;
}


function getPaintings()
{
    include "db.php";
    $results = $db->query("select title, filename from paintings");
    $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);
    return $resultsArray;
}

function getPaintingBlob($id) {
    include "db.php";
    $results = $db->prepare("select title, image, price, name as artist from paintings p, artists a where p.artistid = a.id and p.id = ?");
    $results->bindValue(1, $id);
    $results->execute();
    
    $resultsArray = $results->fetchAll(PDO::FETCH_ASSOC);
    return $resultsArray;
     
}

function addArtist($artistName) {
      include "db.php";
      try{ 
      $sql = "insert into artists (name) values (?)";
      $result = $db->prepare($sql);
      $result->bindValue(1,$artistName);
      $result->execute();
      return true;
      } catch (PDOException $e) {
          echo "Error " . $e->getMessage();
          return false;
      }
}   
function deleteArtist($artistName) {
      include "db.php";
      try{ 
      $sql = "delete from artists where name = ?";
      $result = $db->prepare($sql);
      $result->bindValue(1,$artistName);
      $result->execute();
      return true;
      } catch (PDOException $e) {
          echo "Error " . $e->getMessage();
          return false;
      }
}

function updateArtist($id, $newArtistName) {
      include "db.php";
      try{ 
      $sql = "update artists set name = ? where id = ?";
      $result = $db->prepare($sql);
      $result->bindValue(1,$newArtistName);
      $result->bindValue(2,$id);
      $result->execute();
      return true;
      } catch (PDOException $e) {
          echo "Error " . $e->getMessage();
          return false;
      }
}

