<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Product Management</title>
    <?php include 'partials/style.html'; ?>
</head>
<body x-data ="{ page: 'settings', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
    x-init="
      darkMode = JSON.parse(localStorage.getItem('darkMode'));
      $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
    :class="{'dark text-bodydark bg-boxdark-2': darkMode === true}">
    <!-- Layout Container -->
    <div class="dashboard-container">
        <!-- Sidebar Start -->
        <?php include 'partials/sidebar.html'; ?>
        <!-- Sidebar Finish -->

        <!-- Navbar Start -->
        <?php include 'partials/header.html'; ?>
        <!-- Navbar Finish -->

        <!-- Main Content Start -->
        <div class="main-content" id="view">
            <h1 class="h1">View Products</h1>
            <a href="#" class="add-btn" onclick="setSection('add')">Add Product</a>
            <table>
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Bed 3351</td>
                        <td>$426.80</td>
                        <td>Single Bunk Bed</td>
                        <td class="actions">
                            <button class="edit-btn" onclick="setSection('update')">Edit</button>
                            <button class="delete-btn" onclick="setSection('delete')">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Bed 3352</td>
                        <td>$352.00</td>
                        <td>Single Bunk Bed</td>
                        <td class="actions">
                            <button class="edit-btn" onclick="setSection('update')">Edit</button>
                            <button class="delete-btn" onclick="setSection('delete')">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>AL013-A/B</td>
                        <td>$165.00</td>
                        <td>Single Bed</td>
                        <td class="actions">
                            <button class="edit-btn" onclick="setSection('update')">Edit</button>
                            <button class="delete-btn" onclick="setSection('delete')">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>DV17809-M</td>
                        <td>$280.00</td>
                        <td>5ft Bed</td>
                        <td class="actions">
                            <button class="edit-btn" onclick="setSection('update')">Edit</button>
                            <button class="delete-btn" onclick="setSection('delete')">Delete</button>
                        </td>
                    </tr>
                    <!-- Repeat for other products -->
                </tbody>
            </table>
        </div>

        <div class="main-content" id="add" style="display: none;">
            <h1 class="h1">Add Product</h1>
            <form>
                <label class="label" for="product-name">Product Name</label>
                <input type="text" class="member-form-input" id="product-name" name="product-name">
                <label class="label" for="product-price">Product Price</label>
                <input type="number" class="member-form-input" id="product-price" name="product-price">
                <label class="label" for="product-quantity">Quantity</label>
                <input type="number" class="member-form-input" id="product-quantity" name="product-quantity" min="1" max="40">
                <label class="label" for="product-description">Product Description</label>
                <textarea id="product-description" class="member-form-input" name="product-description" rows="4"></textarea>
                <input type="file" name="product-image" id="product-image">
                <button class="member-form-button" type="submit">Add Product</button>
            </form>
        </div>

        <div class="main-content" id="update" style="display: none;">
            <h1 class="h1">Update Product</h1>
            <form action="updateproduct.php" method="post">
                <label class="label" for="product-select">Select Product to Update</label>
                <select id="product-select" name="productname" required>
                    <option value="" disabled selected>Select product</option>
                    <option value="Bed 3351">Bed 3351</option>
                    <option value="Bed 3352">Bed 3352</option>
                    <option value="AL013-A/B">AL013-A/B</option>
                    <!-- Add more options as needed -->
                </select>
                <label class="label" for="product-quantity">Product Quantity</label>
                <input type="number" class="member-form-input" id="product-quantity" name="product-quantity" required min="1" max="99">
                <label class="label" for="product-price">Product Price</label>
                <input type="number" class="member-form-input" id="product-price" name="product-price" required min="1" max="9999">
                <label class="label" for="product-description">Product Description</label>
                <textarea id="product-description" class="member-form-input" name="product-description" rows="4" required></textarea>
                <button class="member-form-button" type="submit">Update Product</button>
            </form>
        </div>

        <div class="main-content" id="delete" style="display: none;">
            <h1 class="h1">Delete Product</h1>
            <form action="deleteproduct.php" method="post">
                <label class="label" for="product-select">Select Product to Delete</label>
                <select id="product-select" name="productname">
                    <option value="" disabled selected>Select product</option>
                    <option value="Bed 3351">Bed 3351</option>
                    <option value="Bed 3352">Bed 3352</option>
                    <option value="AL013-A/B">AL013-A/B</option>
                    <!-- Add more options as needed -->
                </select>
                <button class="member-form-button" type="submit">Delete Product</button>
            </form>
        </div>
    </div>

    <?php include 'partials/js.html'; ?>
</body>
</html>