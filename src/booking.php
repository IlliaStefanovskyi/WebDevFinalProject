<body>
    <?php require 'ComponentsCode/header.php'; ?>
    </div>
    <div class = "ourServicesContainer">
        <div class = "ourServices">
            <div class = "left">
                <form id="cat-form" action="#" method="POST">
                    <label for="owner-name">Full Name:</label>
                    <input type="text" id="owner-name" name="owner-name" required>

                    <label for="owner-age">Age:</label>
                    <input type="text" id="owner-age" name="owner-age" required>

                    <label for="cat-id">Please input the cat's reference ID:</label>
                    <input type="text" id="cat-id" name="cat-id">

                    <label for="cat-past">Reason for adopting?:</label>
                    <textarea id="cat-past" name="cat-past" rows="3"></textarea>

                    <label for="donation-date">Preferred Booking Date:</label>
                    <input type="date" id="donation-date" name="donation-date" required>

                    <label for="owner-contact">Contact Information:</label>
                    <input type="text" id="owner-contact" name="owner-contact" required>

                    <button type="submit">Submit Booking Form</button>
                </form>
            </div>
        </div>
    </div>
    <?php require 'ComponentsCode/footer.php'; ?>
</body>