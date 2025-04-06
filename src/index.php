<?php require 'ComponentsCode/header.php'; ?>

<body>
    <?php
    $sqlQuery = "SELECT * FROM cats;";
    require_once 'data/connection.php';
    $result = $connection->query($sqlQuery);
    $rows = $result->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <div class="filtersContainer">
        <form class="filtersForm" method="post">
            <label for="genderFilter">Select gender</label>
            <select name="genderFilter" id="genderFilter">
                <option value="any">Any</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
            <div>
                <label for="minAge">Min age</label>
                <input name="minAge" id="minAge" value="0" min="0" max="30" type="number">
                <label for="maxAge">Max age</label>
                <input name="maxAge" id="maxAge" value="30" min="0" max="30" type="number">
            </div>
            <button type="submit" name="submitParams" class = "buttonLink">Submit filters</button>
        </form>
        <script>
            document.querySelector("form").addEventListener("submit", function (event) {
                var minAge = document.querySelector("#minAge").value.trim();
                var maxAge = document.querySelector("#maxAge").value.trim();
                if (minAge > maxAge || minAge < 0 || maxAge > 30 || minAge == "" || minAge == "") {
                    event.preventDefault();
                    alert("Enter valid range between 0 and 30!");
                }
            });
        </script>
    </div>

    <button class="addFiltersButton buttonLink">Add filters</button>

    <script>
        document.querySelector(".addFiltersButton").addEventListener("click", function () {
            const container = document.querySelector(".filtersContainer");
            if(container.style.display === "flex"){
                container.style.display = "none";
            }else{
                container.style.display = "flex";
            }
        });
    </script>

    <div id="petLayoutContainer">
        <?php

        #checks for parameters
        $gender = "any";
        $age = array();
        if (isset($_POST["submitParams"])) {
            $gender = $_POST["genderFilter"];
        }

        #creates an array of Cat instances
        require_once 'classes/Cat.php';
        $catInstanceArr = array();
        foreach ($rows as $row) {
            $catInstanceArr[] = new Cat(...array_values($row));
        }
        #iterates trough cat class instances
        require_once 'ComponentsCode/petCard.php';
        for ($i = 0; $i < count($catInstanceArr); $i++) {
            if (
                !isset($_POST["submitParams"])
                ||
                ($gender == "any" || $gender == $catInstanceArr[$i]->gender)
                &&
                ($catInstanceArr[$i]->age >= $_POST["minAge"] && $catInstanceArr[$i]->age <= $_POST["maxAge"])
            ) {
                addCard(
                    $catInstanceArr[$i]->image,
                    $catInstanceArr[$i]->name,
                    "{$catInstanceArr[$i]->gender} | {$catInstanceArr[$i]->age}",
                    $catInstanceArr[$i]->catId
                );
            }
        }
        ?>
    </div>
    <?php require 'ComponentsCode/footer.php'; ?>

</body>