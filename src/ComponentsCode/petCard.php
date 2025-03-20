<?php 
function addCard($imageLoc, $petName, $petData,$catId){
    #catIdWill be used to redirect to correct cat description page
    require_once 'data/safety.php';
    echo '
    <a href="description.php?id=',  makeSafe($catId), '" class = petCard>
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