<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multiple Related Dropdowns with Ajax</title>
</head>
<body style="text-align: center;">

    <br><br><br><br><br><br>

<form method="post" action="">
    <?php
    include 'db_config.php';

    $category_query = "SELECT id, name FROM categories";
    $category_result = mysqli_query($conn, $category_query);
    ?>
    <label for="category">Category:</label>
    <select name="category" id="category">
        <option value="">Select Category</option>
        <?php
        if ($category_result && mysqli_num_rows($category_result) > 0) {
            while ($category = mysqli_fetch_assoc($category_result)) {
                echo "<option value='" . $category['id'] . "'>" . $category['name'] . "</option>";
            }
        }
        ?>
    </select>

    <br><br>

    <label for="subcategory">Subcategory:</label>
    <select name="subcategory" id="subcategory">
        <option value="">Select Subcategory</option>
    </select>

    <script>
        document.getElementById('category').addEventListener('change', function () {
            var categoryId = this.value;

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var subcategories = JSON.parse(xhr.responseText);
                    var subcategoryDropdown = document.getElementById('subcategory');

                    subcategoryDropdown.innerHTML = '<option value="">Select Subcategory</option>';

                    subcategories.forEach(function (subcategory) {
                        var option = document.createElement('option');
                        option.value = subcategory.id;
                        option.text = subcategory.name;
                        subcategoryDropdown.add(option);
                    });
                }
            };

            xhr.open('POST', 'ajax.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('category_id=' + categoryId);
        });
    </script>

    <br><br>

    <label for="item">Item:</label>
    <select name="item" id="item">
        <option value="">Select Item</option>
        <!--  will be populated dynamically using JavaScript -->
    </select>
    <script>
        document.getElementById('subcategory').addEventListener('change', function () {
            var subcategoryId = this.value;

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var item = JSON.parse(xhr.responseText);
                    var itemDropdown = document.getElementById('item');

                    itemDropdown.innerHTML = '<option value="">Select Item</option>';

                    item.forEach(function (item) {
                        var option = document.createElement('option');
                        option.value = item.id;
                        option.text = item.name;
                        itemDropdown.add(option);
                    });
                }
            };

            xhr.open('POST', 'ajax2.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('subcategory_id=' + subcategoryId);
        });
    </script>

    <br><br>


    <label for="price">Price <b>KSH</b>:</label>
    <select name="price" id="price">
        <option value="">View Price</option>
        <!-- Items will be populated dynamically using JavaScript -->
    </select>
    <script>
        document.getElementById('item').addEventListener('change', function () {
            var itemId = this.value;

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var price = JSON.parse(xhr.responseText);
                    var priceDropdown = document.getElementById('price');

                    priceDropdown.innerHTML = '<option value="">Select Price</option>';

                    price.forEach(function (price) {
                        var option = document.createElement('option');
                        option.value = price.id;
                        option.text = price.name;
                        priceDropdown.add(option);
                    });
                }
            };

            xhr.open('POST', 'ajax3.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('item_id=' + itemId);
        });
    </script>

    <br><br>

    <input type="submit" value="Submit">
</form>

</body>
</html>

<?php
mysqli_close($conn);
?>
