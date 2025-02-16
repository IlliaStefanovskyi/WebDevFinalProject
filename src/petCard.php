<?php 
function addCard($imageLoc, $petName, $petData, $petNotes){
    echo '
    <div class = petCard>
    <div class = petCardImageContainer>
        <img class = "petCardImage" src = "', $imageLoc, '">
    </div>
    <div class = petCardDescription>
        <p class = "petNameOnCard">', $petName, '</p>
        <p class = "petDataOnCard">', $petData, '</p>
        <p class = "notesOnCard">', $petNotes, '</p>
    </div>
    </div>
    ';
}
?>