<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Category Management</title>
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
            <h1 class="h1">View Product Categories</h1>
            <a href="#" class="add-btn" onclick="setSection('add')">Add Category</a>
            <table>
                <thead>
                    <tr>
                        <th>Category Name width= 50px</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Beds</td>
                        <td>Various types of beds including single, double, and bunk beds.</td>
                        <td class="actions">
                            <button class="edit-btn" onclick="setSection('update')">Edit</button>
                            <button class="delete-btn" onclick="setSection('delete')">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Sofas</td>
                        <td>Comfortable and stylish sofas for your living room.</td>
                        <td class="actions">
                            <button class="edit-btn" onclick="setSection('update')">Edit</button>
                            <button class="delete-btn" onclick="setSection('delete')">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Tables</td>
                        <td>Dining tables, coffee tables, and more.</td>
                        <td class="actions">
                            <button class="edit-btn" onclick="setSection('update')">Edit</button>
                            <button class="delete-btn" onclick="setSection('delete')">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Chairs</td>
                        <td>Various types of chairs including office chairs and dining chairs.</td>
                        <td class="actions">
                            <button class="edit-btn" onclick="setSection('update')">Edit</button>
                            <button class="delete-btn" onclick="setSection('delete')">Delete</button>
                        </td>
                    </tr>
                    <!-- Repeat for other categories -->
                </tbody>
            </table>
        </div>

        <div class="main-content" id="add" style="display: none;">
            <h1 class="h1">Add Product Category</h1>
            <form>
                <label class="label" for="category-name">Category Name</label>
                <input type="text" class="member-form-input" id="category-name" name="category-name">
                <label class="label" for="category-description">Category Description</label>
                <textarea id="category-description" class="member-form-input" name="category-description" rows="4"></textarea>
                <button class="member-form-button" type="submit">Add Category</button>
            </form>
        </div>

        <div class="main-content" id="update" style="display: none;">
            <h1 class="h1">Update Product Category</h1>
            <form action="updatecategory.php" method="post">
                <label class="label" for="category-select">Select Category to Update</label>
                <select id="category-select" name="categoryname" required>
                    <option value="" disabled selected>Select category</option>
                    <option value="Beds">Beds</option>
                    <option value="Sofas">Sofas</option>
                    <option value="Tables">Tables</option>
                    <option value="Chairs">Chairs</option>
                    <!-- Add more options as needed -->
                </select>
                <label class="label" for="category-name">Category Name</label>
                <input type="text" class="member-form-input" id="category-name" name="category-name" required>
                <label class="label" for="category-description">Category Description</label>
                <textarea id="category-description" class="member-form-input" name="category-description" rows="4" required></textarea>
                <button class="member-form-button" type="submit">Update Category</button>
            </form>
        </div>

        <div class="main-content" id="delete" style="display: none;">
            <h1 class="h1">Delete Product Category</h1>
            <form action="deletecategory.php" method="post">
                <label class="label" for="category-select">Select Category to Delete</label>
                <select id="category-select" name="categoryname">
                    <option value="" disabled selected>Select category</option>
                    <option value="Beds">Beds</option>
                    <option value="Sofas">Sofas</option>
                    <option value="Tables">Tables</option>
                    <option value="Chairs">Chairs</option>
                    <!-- Add more options as needed -->
                </select>
                <button class="member-form-button" type="submit">Delete Category</button>
            </form>
        </div>
    </div>

    <?php include 'partials/js.html'; ?>
</body>
</html>