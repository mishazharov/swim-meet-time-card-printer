<?php
session_start();
echo "Name: ".$_SESSION['name']."<br>";
echo "Division: ".$_SESSION['division']."<br>";
echo "Competes with: ". $_SESSION['competes_with']."<br>";
echo "Rank: ".$_SESSION['rank']."<br>";
echo "Id: ". $_SESSION['id']."<br>";
echo "Setup: ".$_SESSION['setup']."<br>";
?>