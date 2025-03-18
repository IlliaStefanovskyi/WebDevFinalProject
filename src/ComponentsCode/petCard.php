<?php 
function addCard($imageLoc, $petName, $petData){
    echo '
    <a href = "description.php" class = petCard>
    <div class = petCardImageContainer>
        <img class = "petCardImage" src = "', $imageLoc, '">
    </div>
    <div class = petCardDescription>
        <p class = "petNameOnCard">', $petName, '</p>
        <p class = "petDataOnCard">', $petData, '</p>
    </div>
    </a>
    ';
}
?>