<?php

include "connect-database.php";
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

if(isset($_SESSION["id"])){
$userId = $_SESSION["id"];
} else {
    $userId=-1;
}

if(!isset($_POST["searchKeyword"])){
    $_POST["searchKeyword"]="";
}

$query = "SELECT * FROM note WHERE userId=" . $userId
    . " AND `title` LIKE '%" . $_POST["searchKeyword"] . "%' ORDER BY `id` DESC";

$result = mysqli_query($link, $query);

$maxTitleLetters = 18;
$maxContentLetters = 400;

if ($result) {
    while ($row = mysqli_fetch_array($result)) {
        if (strlen($row["title"]) > $maxTitleLetters) {
            $titleSummary = substr($row["title"], 0, $maxTitleLetters) . "...";
        } else {
            $titleSummary = $row["title"];
        }

        //strip all the HTML tags from the original content
        $strippedContent = strip_tags($row["content"]);

        if (strlen($strippedContent) > $maxContentLetters) {
            $contentSummary = substr($strippedContent, 0, $maxContentLetters) . "...";
        } else {
            $contentSummary = $strippedContent;
        }

        $selectState =" ";
        if (isset($_SESSION["currentNoteId"]) and $row["id"] == $_SESSION["currentNoteId"]) {
            $selectState = " selected";}

         echo
            '<div class="list-group-item bg-light note'.$selectState.'" id=' . $row["id"] .
            ' data-toggle="popover" data-trigger="hover"
         title="' . $row["title"] . '"
         data-content="' . $contentSummary . '">

         <div class="row p-0 m-0">
            <div class="col-9 p-0 m-0">
            <b>' . $titleSummary . '</b> <br>
            <i class="fa fa-calendar"></i>
            <i id="fullDate">' . $row["date"] . '</i>
            </div>

            <div class="hidden" id="fullTitle">' . $row["title"] . '</div>
            <div class="hidden" id="fullContent">' . $row["content"] . '</div>

            <div class="col-3 p-0 m-0">
            <div class="row p-0 m-0 justify-content-end">
            <button class="btn btn-dark star"><i class="fa fa-star"></i></button>
            </div>

            <div class="row p-0 m-0 justify-content-end">
            <button class="btn btn-dark delete"><i class="fa fa-trash"></i></button>
            </div>

            </div>

        </div>

        </div>';
    }
}
?>

