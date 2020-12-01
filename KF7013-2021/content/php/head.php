<?php

function makeHead ($pageTitle) {
	$headContent = <<<HEAD
		<!DOCTYPE html>
		<html lang="en">
		<head>
		<link rel="stylesheet" href="./assets/stylesheets/main.css">
		<title>$pageTitle</title>
		<meta charset="utf-8">
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="Keywords" content="travel, fun, hotels, flights, trip, travelling, photographer, beach, style, sunset, holiday, lifestyle, life, traveltheworld, beauty, mountains, sea, tourism, traveler, traveller, architecture">
	HEAD;
	return $headContent;
}

?>