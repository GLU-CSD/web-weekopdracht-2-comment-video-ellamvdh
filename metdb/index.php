<?php
include("config.php");
include("reactions.php");

//$getReactions = Reactions::getReactions();
//uncomment de volgende regel om te kijken hoe de array van je reactions eruit ziet
// echo "<pre>".var_dump($getReactions)."</pre>";

if(!empty($_POST)){

    //dit is een voorbeeld array.  Deze waardes moeten erin staan.
    $postArray = [
        'name' => "Ieniminie",
        'email' => "ieniminie@sesamstraat.nl",
        'message' => "Geweldig dit"
    ];

    $setReaction = Reactions::setReaction($postArray);

    if(isset($setReaction['error']) && $setReaction['error'] != ''){
        prettyDump($setReaction['error']);
    }
    

}

?>
<!DOCTYPE html>
<?php 
$conn = mysqli_connect("localhost", "root", "", "data");

if(isset($_POST["submit"])){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $comment = $_POST["comment"];
    $date = date('F d Y');
    $reply_id = $_POST["reply_id"];

    $query = "INSERT INTO tb_data VALUES('', '$name', '$email', '$comment', '$date', '$reply_id')";
    mysqli_query($conn, $query);


}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youtube remake</title>
</head>
<style>
    /* instead of css file */
    *{
        margin: 0px;
        padding: 1px
    }
    body{
        background:rgb(173, 216, 230);
    }
</style>
<body>
    <iframe width="560" height="315" src="https://www.youtube.com/embed/dQw4w9WgXcQ?si=twI61ZGDECBr4ums" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>


    <form action = "" method = "post">
        <h3 id = "title">Leave a comment </h3>
        <input type="hidden" name = "reply_id" id= "reply_id">
        <div>
            <input type="text" name = "name" placeholder= "Your name" required>
        </div>
        <div>
            <input type="text" name = "email" placeholder= "Your email" required>
        </div>

        <div>
            <textarea name="comment"  placeholder="Your comment" required cols="30" rows="10"></textarea>
        </div>
        <div>
            <button type="submit" name= "submit" class= "submit">Submit</button>
        </div>
        

    </form>



    <h2>Comments:</h2>

    <?php
    //only select comment, not included reply 
        $datas = mysqli_query($conn, "SELECT * FROM tb_data WHERE reply_id = 0");
        foreach($datas as $data){
            require 'comment.php';
        }
    ?>



</body>
</html>

<?php
$conn->close();
?>