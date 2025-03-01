<?php
$page_title = "Create Shipment - Swift Ship";
include 'includes/header.php';
include 'config/db_connect.php';

$success = false;
$error = '';
$tracking_number = '';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Start transaction
        $pdo->beginTransaction();
        
        // Generate tracking number
        $tracking_number = 'SS' . date('Ymd') . rand(1000, 9999);
        
        // Insert shipment
        $stmt = $pdo->prepare("
            INSERT INTO shipments (tracking_number, item_name, item_description, weight, status) 
            VALUES (:tracking_number, :item_name, :item_description, :weight, 'Pending')
        ");
        
        $stmt->execute([
            'tracking_number' => $tracking_number,
            'item_name' => $_POST['item_name'],
            'item_description' => $_POST['item_description'],
            'weight' => $_POST['weight']
        ]);
        
        $shipment_id = $pdo->lastInsertId();
        
        // Insert sender information
        $stmt = $pdo->prepare("
            INSERT INTO senders (shipment_id, full_name, address, city, state, zip_code, country, email, phone) 
            VALUES (:shipment_id, :full_name, :address, :city, :state, :zip_code, :country, :email, :phone)
        ");
        
        $stmt->execute([
            'shipment_id' => $shipment_id,
            'full_name' => $_POST['sender_name'],
            'address' => $_POST['sender_address'],
            'city' => $_POST['sender_city'],
            'state' => $_POST['sender_state'],
            'zip_code' => $_POST['sender_zip'],
            'country' => $_POST['sender_country'],
            'email' => $_POST['sender_email'],
            'phone' => $_POST['sender_phone']
        ]);
        
        // Insert recipient information
        $stmt = $pdo->prepare("
            INSERT INTO recipients (shipment_id, full_name, address, city, state, zip_code, country, email, phone) 
            VALUES (:shipment_id, :full_name, :address, :city, :state, :zip_code, :country, :email, :phone)
        ");
        
        $stmt->execute([
            'shipment_id' => $shipment_id,
            'full_name' => $_POST['recipient_name'],
            'address' => $_POST['recipient_address'],
            'city' => $_POST['recipient_city'],
            'state' => $_POST['recipient_state'],
            'zip_code' => $_POST['recipient_zip'],
            'country' => $_POST['recipient_country'],
            'email' => $_POST['recipient_email'],
            'phone' => $_POST['recipient_phone']
        ]);
        
        // Insert initial tracking update
        $stmt = $pdo->prepare("
            INSERT INTO tracking_updates (shipment_id, status, location, notes) 
            VALUES (:shipment_id, 'Order Placed', :location, 'Shipment has been created and is pending processing.')
        ");
        
        $stmt->execute([
            'shipment_id' => $shipment_id,
            'location' => $_POST['sender_city'] . ', ' . $_POST['sender_country']
        ]);
        
        // Handle image upload if provided
        if (isset($_FILES['item_image']) && $_FILES['item_image']['error'] === UPLOAD_ERR_OK) {
            $upload_dir = 'uploads/';
            
            // Create directory if it doesn't exist
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            
            $file_name = $tracking_number . '_' . basename($_FILES['item_image']['name']);
            $upload_path = $upload_dir . $file_name;
            
            if (move_uploaded_file($_FILES['item_image']['tmp_name'], $upload_path)) {
                // Insert image path into database
                $stmt = $pdo->prepare("
                    INSERT INTO shipment_images (shipment_id, image_path) 
                    VALUES (:shipment_id, :image_path)
                ");
                
                $stmt->execute([
                    'shipment_id' => $shipment_id,
                    'image_path' => $upload_path
                ]);
            }
        }
        
        // Commit transaction
        $pdo->commit();
        $success = true;
        
    } catch (PDOException $e) {
        // Rollback transaction on error
        $pdo->rollBack();
        $error = 'Database error: ' . $e->getMessage();
    } catch (Exception $e) {
        $error = 'Error: ' . $e->getMessage();
    }
}
?>

<main>
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-primary to-accent text-white py-12">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-3xl font-bold mb-2">Create a New Shipment</h1>
            <p class="text-xl mb-0">Fill out the form below to create a new shipment and get a tracking number.</p>
        </div>
    </section>
    
    <!-- Form Section -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <?php if ($success): ?>
                <div class="max-w-3xl mx-auto bg-green-50 border border-green-200 text-green-800 p-6 rounded-lg mb-8">
                    <h2 class="text-xl font-bold mb-2">Shipment Created Successfully!</h2>
                    <p>Your shipment has been created and is now being processed.</p>
                    <p class="font-bold mt-4">Your tracking number is: <?php echo $tracking_number; ?></p>
                    <div class="mt-4 flex gap-4">
                        <a href="track_result.php?tracking_number=<?php echo $tracking_number; ?>" class="inline-block bg-primary hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                            Track Shipment
                        </a>
                        <a href="create_shipment.php" class="inline-block bg-secondary hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                            Create Another Shipment
                        </a>
                    </div>
                </div>
            <?php elseif ($error): ?>
                <div class="max-w-3xl mx-auto bg-red-50 border border-red-200 text-red-800 p-6 rounded-lg mb-8">
                    <h2 class="text-xl font-bold mb-2">Error</h2>
                    <p><?php echo $error; ?></p>
                </div>
            <?php endif; ?>
            
            <?php if (!$success): ?>
                <form method="POST" action="create_shipment.php" enctype="multipart/form-data" class="max-w-4xl mx-auto bg-light p-8 rounded-lg shadow-lg">
                    <h2 class="text-2xl font-bold mb-6 text-dark">Shipment Information</h2>
                    
                    <!-- Item Information -->
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold mb-4 text-dark border-b pb-2">Item Details</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="item_name" class="block text-gray-700 font-medium mb-2">Item Name *</label>
                                <input type="text" id="item_name" name="item_name" required
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                            </div>
                            <div>
                                <label for="weight" class="block text-gray-700 font-medium mb-2">Weight (kg) *</label>
                                <input type="number" id="weight" name="weight" step="0.01" required
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                            </div>
                            <div class="md:col-span-2">
                                <label for="item_description" class="block text-gray-700 font-medium mb-2">Item Description</label>
                                <textarea id="item_description" name="item_description" rows="3"
                                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"></textarea>
                            </div>
                            <div class="md:col-span-2">
                                <label for="item_image" class="block text-gray-700 font-medium mb-2">Item Image (optional)</label>
                                <input type="file" id="item_image" name="item_image" accept="image/*"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Sender Information -->
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold mb-4 text-dark border-b pb-2">Sender Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="sender_name" class="block text-gray-700 font-medium mb-2">Full Name *</label>
                                <input type="text" id="sender_name" name="sender_name" required
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                            </div>
                            <div>
                                <label for="sender_email" class="block text-gray-700 font-medium mb-2">Email *</label>
                                <input type="email" id="sender_email" name="sender_email" required
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                            </div>
                            <div>
                                <label for="sender_phone" class="block text-gray-700 font-medium mb-2">Phone *</label>
                                <input type="tel" id="sender_phone" name="sender_phone" required
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                            </div>
                            <div class="md:col-span-2">
                                <label for="sender_address" class="block text-gray-700 font-medium mb-2">Address *</label>
                                <input type="text" id="sender_address" name="sender_address" required
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                            </div>
                            <div>
                                <label for="sender_city" class="block text-gray-700 font-medium mb-2">City *</label>
                                <input type="text" id="sender_city" name="sender_city" required
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                            </div>
                            <div>
                                <label for="sender_state" class="block text-gray-700 font-medium mb-2">State/Province *</label>
                                <input type="text" id="sender_state" name="sender_state" required
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                            </div>
                            <div>
                                <label for="sender_zip" class="block text-gray-700 font-medium mb-2">Zip/Postal Code *</label>
                                <input type="text" id="sender_zip" name="sender_zip" required
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                            </div>
                            <div>
                                <label for="sender_country" class="block text-gray-700 font-medium mb-2">Country *</label>
                                <input type="text" id="sender_country" name="sender_country" required
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Recipient Information -->
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold mb-4 text-dark border-b pb-2">Recipient Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="recipient_name" class="block text-gray-700 font-medium mb-2">Full Name *</label>
                                <input type="text" id="recipient_name" name="recipient_name" required
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                            </div>
                            <div>
                                <label for="recipient_email" class="block text-gray-700 font-medium mb-2">Email *</label>
                                <input type="email" id="recipient_email" name="recipient_email" required
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                            </div>
                            <div>
                                <label for="recipient_phone" class="block text-gray-700 font-medium mb-2">Phone *</label>
                                <input type="tel" id="recipient_phone" name="recipient_phone" required
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                            </div>
                            <div class="md:col-span-2">
                                <label for="recipient_address" class="block text-gray-700 font-medium mb-2">Address *</label>
                                <input type="text" id="recipient_address" name="recipient_address" required
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                            </div>
                            <div>
                                <label for="recipient_city" class="block text-gray-700 font-medium mb-2">City *</label>
                                <input type="text" id="recipient_city" name="recipient_city" required
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                            </div>
                            <div>
                                <label for="recipient_state" class="block text-gray-700 font-medium mb-2">State/Province *</label>
                                <input type="text" id="recipient_state" name="recipient_state" required
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                            </div>
                            <div>
                                <label for="recipient_zip" class="block text-gray-700 font-medium mb-2">Zip/Postal Code *</label>
                                <input type="text" id="recipient_zip" name="recipient_zip" required
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                            </div>
                            <div>
                                <label for="recipient_country" class="block text-gray-700 font-medium mb-2">Country *</label>
                                <input type="text" id="recipient_country" name="recipient_country" required
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-center">
                        <button type="submit" class="bg-primary hover:bg-blue-600 text-white font-bold py-3 px-8 rounded-lg transition duration-300 shadow-lg">
                            Create Shipment
                        </button>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>

