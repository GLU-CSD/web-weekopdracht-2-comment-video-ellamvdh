<?php
include("config.php");
include("reactions.php");

$getReactions = Reactions::getReactions();
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youtube remake</title>
    <link rel="stylesheet" href="mystyle.css">
</head>
<body>
    <iframe width="560" height="315" src="https://www.youtube.com/embed/dQw4w9WgXcQ?si=twI61ZGDECBr4ums" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

        <form action="" method="POST">

        <div>
            <label>Name:
                <input type= "text" name = "Name" required />
            </label>
        </div>

        <div>
            <label>Email:
                <input type= "text" name = "Email" required />
            </label>
        </div>

        <!-- <p> Comment:</p> -->
        <div> 
            <label>Comment: <br />
                <textarea name="Comment"  required cols="30" rows="10"></textarea>
            </label>
        </div>

        <input type= "submit" name ="Submit" vlaue= "Submit" />


    </form>

</body>
</html>

<?php
    if(isset($_POST["Submit"])){
        print"<h2> Your comment had been submitted! </h2>";

        $Name = $_POST["Name"];
        $Email = $_POST["Email"];
        $Comment = $_POST["Comment"];

        //Old Comments
        $Old = fopen("comments.txt", "r+t");
        $Old_Comments = fread($Old, 1024);

        //Add new Comment
        $Write = fopen("comments.txt", "w+");

        $string = 
            "<div class = 'comment'><span>".$Name."</span><br /><span>".$Email."</span><br />
            <span>".date("d/m/Y")."</span><br />
            <span>".$Comment."</span></div>\n".$Old_Comments;
        
        fwrite($Write, $string);
        fclose($Write);
        fclose($Old);
    }

    //Display all the comments
    $Read = fopen("comments.txt", "r+t");
    echo "<h1>Comments:</h1><hr>".fread($Read, 1024);
    fclose($Read);
    




$con->close();
?>