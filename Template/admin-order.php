<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Order Management</title>
    <?php include 'partials/style.html'; ?>
</head>
<body class="bg-body-secondary">
    <!-- Layout Container -->
    <div class="dashboard-container">
        <!-- Sidebar Start -->
        <?php include 'partials/sidebar.html'; ?>
        <!-- Sidebar Finish -->

        <!-- Navbar Start -->
        <?php include 'partials/header.html'; ?>
        <!-- Navbar Finish -->

        <!-- Main Content Start -->
        <div class="main-content" id="view-orders">
            <h1>View Orders</h1>
            <a href="#" class="add-btn" onclick="showSection('add-order')">Add Order</a>
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>John Doe</td>
                        <td>$100.00</td>
                        <td>Pending</td>
                        <td class="actions">
                            <button class="edit-btn" onclick="showSection('update-order')">Edit</button>
                            <button class="delete-btn" onclick="showSection('delete-order')">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Jane Smith</td>
                        <td>$200.00</td>
                        <td>Completed</td>
                        <td class="actions">
                            <button class="edit-btn" onclick="showSection('update-order')">Edit</button>
                            <button class="delete-btn" onclick="showSection('delete-order')">Delete</button>
                        </td>
                    </tr>
                    <!-- Repeat for other orders -->
                </tbody>
            </table>
        </div>

        <div class="main-content" id="add-order" style="display: none;">
            <h1>Add Order</h1>
            <form>
                <label for="order-id">Order ID</label>
                <input type="number" id="order-id" name="order-id">
                <label for="customer-name">Customer Name</label>
                <input type="text" id="customer-name" name="customer-name">
                <label for="total-amount">Total Amount</label>
                <input type="number" id="total-amount" name="total-amount">
                <label for="status">Status</label>
                <select id="status" name="status">
                    <option value="Pending">Pending</option>
                    <option value="Completed">Completed</option>
                    <option value="Cancelled">Cancelled</option>
                </select>
                <button type="submit">Add Order</button>
            </form>
        </div>

        <div class="main-content" id="update-order" style="display: none;">
            <h1>Update Order</h1>
            <form action="updateorder.php" method="post">
                <label for="order-select">Select Order to Update</label>
                <select id="order-select" name="orderid" required>
                    <option value="" disabled selected>Select order</option>
                    <option value="1">Order 1</option>
                    <option value="2">Order 2</option>
                    <option value="3">Order 3</option>
                    <!-- Add more options as needed -->
                </select>
                <label for="customer-name">Customer Name</label>
                <input type="text" id="customer-name" name="customer-name" required>
                <label for="total-amount">Total Amount</label>
                <input type="number" id="total-amount" name="total-amount" required>
                <label for="status">Status</label>
                <select id="status" name="status" required>
                    <option value="Pending">Pending</option>
                    <option value="Completed">Completed</option>
                    <option value="Cancelled">Cancelled</option>
                </select>
                <button type="submit">Update Order</button>
            </form>
        </div>

        <div class="main-content" id="delete-order" style="display: none;">
            <h1>Delete Order</h1>
            <form action="deleteorder.php" method="post">
                <label for="order-select">Select Order to Delete</label>
                <select id="order-select" name="orderid">
                    <option value="" disabled selected>Select order</option>
                    <option value="1">Order 1</option>
                    <option value="2">Order 2</option>
                    <option value="3">Order 3</option>
                    <!-- Add more options as needed -->
                </select>
                <button type="submit">Delete Order</button>
            </form>
        </div>
    </div>
    <?php include 'partials/js.html'; ?>
</body>
</html>