<?php require 'ComponentsCode/header.php'; ?>

<body>
    <div class=footerAway>
        <div>
            <script>
                //to save the search phrase
                let search = "<?php echo $_GET['search'] ?>";
                document.querySelector(".searchCatBox").value = search;
            </script>
            <?php

            //selects query to receive cats depending on search
            //orders cats by inbound date (oldest to newest)
            if (isset($_GET["search"])) {
                require_once "data/safety.php";
                $sqlQuery = "
                    SELECT * 
                    FROM cats 
                    WHERE name LIKE '%" . makeSafe($_GET["search"]) . "%'
                    OR description LIKE '%" . makeSafe($_GET["search"]) . "%'
                    OR breed LIKE '%" . makeSafe($_GET["search"]) . "%'
                    order by inboundDate asc";
            } else {
                $sqlQuery = "SELECT * FROM cats order by inboundDate asc;";
            }
            //fetches query
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
                    <button type="submit" name="submitParams" class="buttonLink">Submit filters</button>
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
                    if (container.style.display === "flex") {
                        container.style.display = "none";
                    } else {
                        container.style.display = "flex";
                    }
                });
            </script>

            <div id="petLayoutContainer">
                <h2 id="noCatsFound"></h2>
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

                #iterates trough cat class instances and matches filters
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
        </div>
        <div>
            <?php require 'ComponentsCode/footer.php'; ?>
        </div>
        <!--Checks if any cats were found-->
        <script>
            var container = document.querySelector("#petLayoutContainer");
            if (!container.querySelector(".petCard")) {
                document.querySelector("#noCatsFound").innerHTML = "No matching cats found, change filters!";
            }
        </script>
    </div>
</body>