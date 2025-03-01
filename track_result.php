<?php
$page_title = "Tracking Results - Swift Ship";
include 'includes/header.php';
include 'config/db_connect.php';

// Get tracking number from URL
$tracking_number = isset($_GET['tracking_number']) ? $_GET['tracking_number'] : '';
$shipment = null;
$tracking_updates = [];
$sender = null;
$recipient = null;
$error = '';

if (!empty($tracking_number)) {
    try {
        // Get shipment details
        $stmt = $pdo->prepare("SELECT * FROM shipments WHERE tracking_number = :tracking_number");
        $stmt->execute(['tracking_number' => $tracking_number]);
        $shipment = $stmt->fetch();
        
        if ($shipment) {
            // Get tracking updates
            $stmt = $pdo->prepare("SELECT * FROM tracking_updates WHERE shipment_id = :shipment_id ORDER BY created_at DESC");
            $stmt->execute(['shipment_id' => $shipment['id']]);
            $tracking_updates = $stmt->fetchAll();
            
            // Get sender details
            $stmt = $pdo->prepare("SELECT * FROM senders WHERE shipment_id = :shipment_id");
            $stmt->execute(['shipment_id' => $shipment['id']]);
            $sender = $stmt->fetch();
            
            // Get recipient details
            $stmt = $pdo->prepare("SELECT * FROM recipients WHERE shipment_id = :shipment_id");
            $stmt->execute(['shipment_id' => $shipment['id']]);
            $recipient = $stmt->fetch();
        } else {
            $error = 'No shipment found with the provided tracking number.';
        }
    } catch (PDOException $e) {
        $error = 'Database error: ' . $e->getMessage();
    }
} else {
    $error = 'Please provide a tracking number.';
}
?>

<main>
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-primary to-accent text-white py-12">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-3xl font-bold mb-2">Tracking Results</h1>
            <?php if ($shipment): ?>
                <p class="text-xl mb-0">Tracking Number: <span class="font-bold"><?php echo htmlspecialchars($tracking_number); ?></span></p>
            <?php else: ?>
                <p class="text-xl mb-0">Tracking Information</p>
            <?php endif; ?>
        </div>
    </section>
    
    <!-- Results Section -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <?php if ($error): ?>
                <div class="max-w-3xl mx-auto bg-red-50 border border-red-200 text-red-800 p-6 rounded-lg mb-8">
                    <h2 class="text-xl font-bold mb-2">Error</h2>
                    <p><?php echo $error; ?></p>
                    <div class="mt-4">
                        <a href="track.php" class="inline-block bg-primary hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                            Try Again
                        </a>
                    </div>
                </div>
            <?php elseif ($shipment): ?>
                <!-- Shipment Status -->
                <div class="max-w-4xl mx-auto mb-8">
                    <div class="bg-light border border-gray-200 rounded-lg overflow-hidden shadow-lg">
                        <div class="p-6 border-b border-gray-200">
                            <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                                <div>
                                    <h2 class="text-2xl font-bold text-dark">Shipment Status: 
                                        <span class="<?php 
                                            if ($shipment['status'] == 'Delivered') echo 'text-green-600';
                                            elseif ($shipment['status'] == 'In Transit') echo 'text-blue-600';
                                            elseif ($shipment['status'] == 'Delayed') echo 'text-orange-600';
                                            else echo 'text-gray-600';
                                        ?>">
                                            <?php echo htmlspecialchars($shipment['status']); ?>
                                        </span>
                                    </h2>
                                    <p class="text-gray-600">Item: <?php echo htmlspecialchars($shipment['item_name']); ?></p>
                                </div>
                                <div class="mt-4 md:mt-0">
                                    <p class="text-sm text-gray-500">Shipped on: <?php echo date('F j, Y', strtotime($shipment['created_at'])); ?></p>
                                    <p class="text-sm text-gray-500">Last Updated: <?php echo date('F j, Y g:i A', strtotime($shipment['updated_at'])); ?></p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Progress Bar -->
                        <div class="px-6 py-4 bg-gray-50">
                            <div class="relative">
                                <?php
                                $progress = 0;
                                if ($shipment['status'] == 'Pending') $progress = 0;
                                elseif ($shipment['status'] == 'In Transit') $progress = 50;
                                elseif ($shipment['status'] == 'Delivered') $progress = 100;
                                elseif ($shipment['status'] == 'Delayed') $progress = 25;
                                elseif ($shipment['status'] == 'Returned') $progress = 75;
                                ?>
                                <div class="overflow-hidden h-2 text-xs flex rounded bg-gray-200">
                                    <div style="width: <?php echo $progress; ?>%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-secondary"></div>
                                </div>
                                <div class="flex justify-between text-xs text-gray-600 mt-2">
                                    <span>Order Placed</span>
                                    <span>Processing</span>
                                    <span>In Transit</span>
                                    <span>Delivered</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Tracking Timeline -->
                <div class="max-w-4xl mx-auto mb-8">
                    <h3 class="text-xl font-bold mb-4 text-dark">Tracking Updates</h3>
                    
                    <div class="bg-light border border-gray-200 rounded-lg overflow-hidden shadow-lg">
                        <div class="p-6">
                            <?php if (count($tracking_updates) > 0): ?>
                                <div class="space-y-6">
                                    <?php foreach ($tracking_updates as $update): ?>
                                        <div class="flex">
                                            <div class="flex flex-col items-center mr-4">
                                                <div class="w-3 h-3 bg-primary rounded-full"></div>
                                                <?php if (!$loop->last): ?>
                                                    <div class="w-0.5 h-full bg-gray-300"></div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="flex-1 pb-6 border-b border-gray-200">
                                                <div class="flex justify-between items-start">
                                                    <div>
                                                        <h4 class="text-lg font-semibold text-dark"><?php echo htmlspecialchars($update['status']); ?></h4>
                                                        <?php if (!empty($update['location'])): ?>
                                                            <p class="text-gray-600"><?php echo htmlspecialchars($update['location']); ?></p>
                                                        <?php endif; ?>
                                                        <?php if (!empty($update['notes'])): ?>
                                                            <p class="text-gray-600 mt-2"><?php echo htmlspecialchars($update['notes']); ?></p>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                        <?php echo date('M j, Y g:i A', strtotime($update['created_at'])); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <p class="text-gray-600">No tracking updates available yet.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <!-- Shipment Details -->
                <div class="max-w-4xl mx-auto mb-8">
                    <h3 class="text-xl font-bold mb-4 text-dark">Shipment Details</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Sender Information -->
                        <?php if ($sender): ?>
                            <div class="bg-light border border-gray-200 rounded-lg overflow-hidden shadow-lg">
                                <div class="p-6">
                                    <h4 class="text-lg font-semibold mb-4 text-dark">Sender Information</h4>
                                    <div class="space-y-2">
                                        <p><span class="font-medium">Name:</span> <?php echo htmlspecialchars($sender['full_name']); ?></p>
                                        <p><span class="font-medium">Address:</span> <?php echo htmlspecialchars($sender['address']); ?></p>
                                        <p><span class="font-medium">City:</span> <?php echo htmlspecialchars($sender['city']); ?></p>
                                        <p><span class="font-medium">State/Province:</span> <?php echo htmlspecialchars($sender['state']); ?></p>
                                        <p><span class="font-medium">Zip/Postal Code:</span> <?php echo htmlspecialchars($sender['zip_code']); ?></p>
                                        <p><span class="font-medium">Country:</span> <?php echo htmlspecialchars($sender['country']); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Recipient Information -->
                        <?php if ($recipient): ?>
                            <div class="bg-light border border-gray-200 rounded-lg overflow-hidden shadow-lg">
                                <div class="p-6">
                                    <h4 class="text-lg font-semibold mb-4 text-dark">Recipient Information</h4>
                                    <div class="space-y-2">
                                        <p><span class="font-medium">Name:</span> <?php echo htmlspecialchars($recipient['full_name']); ?></p>
                                        <p><span class="font-medium">Address:</span> <?php echo htmlspecialchars($recipient['address']); ?></p>
                                        <p><span class="font-medium">City:</span> <?php echo htmlspecialchars($recipient['city']); ?></p>
                                        <p><span class="font-medium">State/Province:</span> <?php echo htmlspecialchars($recipient['state']); ?></p>
                                        <p><span class="font-medium">Zip/Postal Code:</span> <?php echo htmlspecialchars($recipient['zip_code']); ?></p>
                                        <p><span class="font-medium">Country:</span> <?php echo htmlspecialchars($recipient['country']); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>

